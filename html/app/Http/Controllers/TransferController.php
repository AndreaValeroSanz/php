<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon; 
use Illuminate\Validation\ValidationException;
use App\Models\Reserva;
use App\Models\Precio;
use App\Models\Hotel;
use App\Models\Viajero;

class TransferController extends Controller
{
    // ============================================================
    // 1) Selección del tipo de reserva
    // ============================================================
    public function showTypeSelection()
    {
        return view('transfers.type');
    }

    public function postTypeSelection(Request $request)
    {
        $request->validate([
            'reservation_type' => 'required|in:airport_to_hotel,hotel_to_airport,round_trip',
        ]);

        return redirect()->route('transfer.reserve.form', [
            'type' => $request->reservation_type
        ]);
    }

    // ============================================================
    // 2) Mostrar formulario de reserva
    // ============================================================
    public function showReservationForm($type)
    {
        if (!in_array($type, ['airport_to_hotel', 'hotel_to_airport', 'round_trip'])) {
            return redirect()->route('transfer.select-type')->with('error', 'Tipo no válido.');
        }

        $user = Auth::user();
        $minDate = Carbon::now()->addHours(48)->format('Y-m-d H:i');
        $hotels = Hotel::all();
        $vehiculos = collect([]);

        if ($hotels->count() > 0) {
            $vehiculos = Precio::where('transfer_precios.id_hotel', $hotels[0]->id_hotel)
    ->join('transfer_vehiculos', 'transfer_precios.id_vehiculo', '=', 'transfer_vehiculos.id_vehiculo')
    ->select([
    'transfer_vehiculos.id_vehiculo',
    'transfer_vehiculos.descripcion',
    'transfer_precios.Precio'
])
    ->get();
    // Si quien crea la reserva es un admin o un hotel,
// necesitamos lista de viajeros para asignar la reserva.
$viajeros = collect([]);

if (Auth::guard('admin')->check() || Auth::guard('corporate')->check()) {
    $viajeros = Viajero::orderBy('nombre')->get();
}

        }

        $viewMap = [
            'airport_to_hotel' => 'transfers.airport-to-hotel',
            'hotel_to_airport' => 'transfers.hotel-to-airport',
            'round_trip' => 'transfers.round-trip',
        ];

        return view($viewMap[$type], compact('user', 'minDate', 'hotels', 'vehiculos', 'viajeros'));
    }

    // ============================================================
    // 3) Confirmar reserva
    // ============================================================
    public function confirmReservation(Request $request)
    {
        // Validación básica
        $rules = [
            'reservation_type' => 'required|in:airport_to_hotel,hotel_to_airport,round_trip',
            'pax' => 'required|integer|min:1',
            'email_contacto' => 'required|email',
            'nombre_contacto' => 'required|string',
            'telefono' => 'required|string',
            'id_vehiculo' => 'required|integer',
        ];

        // Si la reserva la hace un hotel o un admin, debe seleccionar un viajero
if (Auth::guard('corporate')->check() || Auth::guard('admin')->check()) {
    $rules['id_viajero'] = 'required|exists:transfer_viajeros,id_viajero';
}


        // Restricción: 48 horas
        $minDate = Carbon::now()->addHours(48)->format('Y-m-d');

        // Validaciones específicas
        if ($request->reservation_type === 'airport_to_hotel') {
            $rules += [
                'fecha_llegada' => "required|date|after_or_equal:$minDate",
                'hora_llegada' => "required",
                'id_hotel_destino' => "required|integer",
                'num_vuelo' => "required|string",
                'aeropuerto_origen' => "required|string",
            ];
        }

        if ($request->reservation_type === 'hotel_to_airport') {
            $rules += [
                'fecha_vuelo_salida' => "required|date|after_or_equal:$minDate",
                'hora_vuelo_salida' => "required",
                'id_hotel_recogida' => "required|integer",
                'hora_recogida' => "required",
            ];
        }

        if ($request->reservation_type === 'round_trip') {
            $rules += [
                // IDA
                'fecha_llegada' => "required|date|after_or_equal:$minDate",
                'hora_llegada' => "required",
                'id_hotel_destino' => "required|integer",
                'num_vuelo_ida' => "required|string",

                // VUELTA
                'fecha_vuelo_salida' => "required|date|after_or_equal:$minDate",
                'hora_vuelo_salida' => "required",
                'id_hotel_recogida' => "required|integer",
                'hora_recogida_vuelta' => "required",
            ];
        }

        $request->validate($rules);

        // Crear la reserva
        $localizador = $this->createReservationRecord($request);

        return view('transfers.confirmation', compact('localizador'));
    }

    // ============================================================
    // 4) Crear registro en BD
    // ============================================================
    private function createReservationRecord(Request $request)
    {
        $type = $request->reservation_type;
        $now = Carbon::now();

        // --- DETERMINAR A QUIÉN PERTENECE LA RESERVA (OWNER) ---

// Si la reserva la hace un viajero logueado → él es el dueño
if (Auth::guard('web')->check()) {
    $idOwner = Auth::guard('web')->user()->id_viajero;
    $tipoOwner = 'user';
} else {
    // Si la hace un hotel o un admin → el dueño es el viajero seleccionado en el formulario
    $idOwner = (int) $request->id_viajero;

    if (!$idOwner) {
        throw ValidationException::withMessages([
            'id_viajero' => 'Debe seleccionar un viajero para asignar la reserva.',
        ]);
    }

    // IMPORTANTE: aunque la cree un hotel o admin, la reserva pertenece a un "user" (viajero)
    $tipoOwner = 'user';
}

        // Detectar hotel según tipo
        $hotelId = $request->id_hotel_destino ?? $request->id_hotel_recogida;

        // Selección real del vehículo
        $idVehiculo = $request->id_vehiculo;

        $transferPrice = Precio::where('id_hotel', $hotelId)
            ->where('id_vehiculo', $idVehiculo)
            ->first();

        if (!$transferPrice) {
            throw ValidationException::withMessages([
                'vehiculo' => 'No existe tarifa configurada para este vehículo en este hotel.',
            ]);
        }

        $precioBase = $transferPrice->Precio;
        $precioFinal = $precioBase * ($type === 'round_trip' ? 2 : 1);

        // Crear array de datos
        $data = [
            'localizador' => strtoupper(uniqid('TR-')),
            'id_tipo_reserva' => [
                'airport_to_hotel' => 1,
                'hotel_to_airport' => 2,
                'round_trip' => 3,
            ][$type],

            'email_cliente' => $request->email_contacto,
            'id_owner' => $idOwner,
            'tipo_owner' => $tipoOwner,

            'fecha_reserva' => $now,
            'fecha_modificacion' => $now,

            'id_hotel' => $hotelId,
            'id_destino' => $hotelId,

            'num_viajeros' => $request->pax,

            'id_vehiculo' => $idVehiculo,
            'precio_total' => $precioFinal,
            'comision_ganada' => round($precioFinal * 0.10, 2),
            'comision_liquidada' => 0,

            // Valores por defecto
            'fecha_entrada' => null,
            'hora_entrada' => null,
            'numero_vuelo_entrada' => null,
            'origen_vuelo_entrada' => null,
            'hora_vuelo_salida' => null,
            'fecha_vuelo_salida' => null,
            'numero_vuelo_salida' => null,
            'origen_vuelo_salida' => null,
            'hora_recogida_hotel' => null,
        ];

        // --- MAPEO DE CAMPOS SEGÚN EL TIPO ---
        if ($type === 'airport_to_hotel' || $type === 'round_trip') {
            $data['fecha_entrada'] = $request->fecha_llegada;
            $data['hora_entrada'] = $request->hora_llegada;
            $data['numero_vuelo_entrada'] = $request->num_vuelo ?? $request->num_vuelo_ida;
            $data['origen_vuelo_entrada'] = "Aeropuerto";
        }

        if ($type === 'hotel_to_airport' || $type === 'round_trip') {
            $data['fecha_vuelo_salida'] = $request->fecha_vuelo_salida;
            $data['numero_vuelo_salida'] = $request->num_vuelo_salida ?? $request->num_vuelo;
            $data['origen_vuelo_salida'] = "Hotel";

            $data['hora_vuelo_salida'] = Carbon::parse(
                $request->fecha_vuelo_salida . " " . $request->hora_vuelo_salida
            );

            $data['hora_recogida_hotel'] = $request->hora_recogida ?? $request->hora_recogida_vuelta;
        }

        // Guardar en BD
        $reserva = Reserva::create($data);

        return $reserva->localizador;
    }
}