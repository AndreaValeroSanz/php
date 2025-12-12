<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Reserva;
use App\Models\Hotel;
use App\Models\Vehiculo;

class MisReservasController extends Controller
{
    /**
     * Mostrar la lista de reservas según el rol del usuario.
     */
    public function index()
{
    // Usuario logueado
    // Detectar correctamente el rol y usuario ACTIVO
if (Auth::guard('admin')->check()) {
    $rol = 'admin';
    $user = Auth::guard('admin')->user();
}
elseif (Auth::guard('corporate')->check()) {
    $rol = 'hotel';
    $user = Auth::guard('corporate')->user();
}
elseif (Auth::guard('web')->check()) {
    $rol = 'user';
    $user = Auth::guard('web')->user();
} else {
    abort(403, 'No autenticado');
}

   // ADMIN
if ($rol == 'admin') {
    $reservas = Reserva::with(['hotel', 'owner', 'zona', 'vehiculo'])
    ->orderByRaw("
        CASE 
            WHEN id_tipo_reserva = 1 THEN fecha_entrada
            WHEN id_tipo_reserva = 2 THEN fecha_vuelo_salida
            WHEN id_tipo_reserva = 3 THEN fecha_entrada
        END DESC
    ")
    ->paginate(8);
}

// HOTEL
elseif ($rol == 'hotel') {
    $reservas = Reserva::with(['hotel', 'owner', 'zona', 'vehiculo'])
    ->where('id_hotel', $user->id_hotel)
    ->orderByRaw("
        CASE 
            WHEN id_tipo_reserva = 1 THEN fecha_entrada
            WHEN id_tipo_reserva = 2 THEN fecha_vuelo_salida
            WHEN id_tipo_reserva = 3 THEN fecha_entrada
        END DESC
    ")
    ->paginate(8);
}

// USER
else {
    $reservas = Reserva::with(['hotel', 'owner', 'zona', 'vehiculo'])
    ->where('tipo_owner', 'user')
    ->where('id_owner', $user->id_viajero)
    ->orderByRaw("
        CASE 
            WHEN id_tipo_reserva = 1 THEN fecha_entrada
            WHEN id_tipo_reserva = 2 THEN fecha_vuelo_salida
            WHEN id_tipo_reserva = 3 THEN fecha_entrada
        END DESC
    ")
    ->paginate(8);
}

    $now = Carbon::now();

    return view('mis_reservas.mis_reservas', compact('reservas', 'rol', 'now'));
}

    /**
     * Mostrar formulario para editar una reserva.
     */
   public function edit($id)
        {
            $reserva = Reserva::findOrFail($id);
$vehiculos = Vehiculo::where('activo', 1)->get();
            $user = Auth::guard('admin')->user()
                ?? Auth::guard('corporate')->user()
                ?? Auth::guard('web')->user();

            $rol = Auth::guard('admin')->check() ? 'admin' :
                (Auth::guard('corporate')->check() ? 'hotel' : 'user');

            if (!$reserva->puedeSerModificadaPor($rol)) {
    return redirect()->route('mis_reservas')
        ->with('error', 'No se puede modificar esta reserva.');
}

            $hotels = Hotel::all();

            $map = [
                1 => 'edit_airport_to_hotel',
                2 => 'edit_hotel_to_airport',
                3 => 'edit_round_trip'
            ];

            $tipo = (int)$reserva->id_tipo_reserva; // ← AQUÍ estaba el error
            $vista = $map[$tipo] ?? abort(404, "Tipo de reserva desconocido");

            return view("mis_reservas.$vista", compact('reserva', 'hotels', 'vehiculos'));
        }

/**
 * Actualizar los datos de una reserva.
 */
   public function update(Request $request, $id)
    {
        $reserva = Reserva::findOrFail($id);

        $user = Auth::guard('admin')->user()
            ?? Auth::guard('corporate')->user()
            ?? Auth::guard('web')->user();

        $rol = Auth::guard('admin')->check() ? 'admin' :
            (Auth::guard('corporate')->check() ? 'hotel' : 'user');

        if (!$reserva->puedeSerModificadaPor($rol)) {
    return redirect()->route('mis_reservas')
        ->with('error', 'No se puede modificar esta reserva.');
}

        // Mapear reservation_type de formulario a id_tipo_reserva
        $map = [
            'airport_to_hotel' => 1,
            'hotel_to_airport' => 2,
            'round_trip' => 3,
        ];

        $reserva->id_tipo_reserva = $map[$request->input('reservation_type')] ?? $reserva->id_tipo_reserva;

        // Actualizar
        $reserva->email_cliente        = $request->input('email_cliente', $reserva->email_cliente);
        $reserva->id_owner             = $request->input('id_owner', $reserva->id_owner);
        $reserva->fecha_entrada        = $request->input('fecha_entrada', $reserva->fecha_entrada);
        $reserva->hora_entrada         = $request->input('hora_entrada', $reserva->hora_entrada);
        $reserva->numero_vuelo_entrada = $request->input('numero_vuelo_entrada', $reserva->numero_vuelo_entrada);
        $reserva->origen_vuelo_entrada = $request->input('origen_vuelo_entrada', $reserva->origen_vuelo_entrada);
        $reserva->id_hotel             = $request->input('id_hotel', $reserva->id_hotel);
        $reserva->num_viajeros         = $request->input('num_viajeros', $reserva->num_viajeros);
        $reserva->fecha_vuelo_salida   = $request->input('fecha_vuelo_salida', $reserva->fecha_vuelo_salida);
        $reserva->hora_vuelo_salida    = $request->input('hora_vuelo_salida', $reserva->hora_vuelo_salida);
        $reserva->numero_vuelo_salida  = $request->input('numero_vuelo_salida', $reserva->numero_vuelo_salida);
        $reserva->origen_vuelo_salida  = $request->input('origen_vuelo_salida', $reserva->origen_vuelo_salida);
        $reserva->hora_recogida_hotel  = $request->input('hora_recogida_hotel', $reserva->hora_recogida_hotel);
$reserva->id_vehiculo = $request->input('id_vehiculo', $reserva->id_vehiculo);
        $reserva->save();


        return redirect()->route('mis_reservas')
                        ->with('success', 'Reserva actualizada correctamente.');
    }


    /**
     * Eliminar una reserva.
     */
    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);

        $user = Auth::guard('admin')->user()
              ?? Auth::guard('corporate')->user()
              ?? Auth::guard('web')->user();

        $rol = Auth::guard('admin')->check() ? 'admin' :
               (Auth::guard('corporate')->check() ? 'hotel' : 'user');

        if (!$reserva->puedeSerModificadaPor($rol)) {
    return redirect()->route('mis_reservas')
        ->with('error', 'No se puede eliminar esta reserva.');
}

        $reserva->estado = 'anulada';
$reserva->save();

        return redirect()->route('mis_reservas')
                         ->with('success', 'Reserva eliminada correctamente.');
    }
}
