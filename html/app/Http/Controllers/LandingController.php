<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class LandingController extends Controller
{

    public function index()
    {
        // Detectamos si hay algún usuario logueado por cualquier guard
        $isAdmin      = Auth::guard('admin')->check();
        $isCorporate  = Auth::guard('corporate')->check();
        $isTraveler   = Auth::guard('web')->check();

        // 👉 Traemos la flota
        $vehiculos = Vehiculo::all();

        // 👉 Metadatos para cada descripción (ajusta nombres si hace falta)
        $metaVehiculos = [
            'Sedán Demo' => [
                'image'     => 'images/sedan_demo.jpg',
                'tagline'   => 'Cómodo y elegante para traslados diarios.',
                'capacidad' => 'Hasta 3 pasajeros',
                'maletas'   => '2 maletas grandes',
            ],
            'Minivan VIP Deluxe' => [
                'image'     => 'images/minivan.jpg',
                'tagline'   => 'Perfecta para familias y grupos pequeños.',
                'capacidad' => 'Hasta 7 pasajeros',
                'maletas'   => '4–5 maletas',
            ],
            'Toyota Yaris' => [
                'image'     => 'images/yaris.jpg',
                'tagline'   => 'Compacto, ágil y muy eficiente.',
                'capacidad' => 'Hasta 3 pasajeros',
                'maletas'   => '2 maletas de cabina',
            ],
            'Mustang' => [
                'image'     => 'images/mustang.jpg',
                'tagline'   => 'Para llegar a tu hotel con mucho estilo.',
                'capacidad' => '2 pasajeros',
                'maletas'   => 'Equipaje ligero',
            ],
            'Milano Starship' => [
                'image'     => 'images/milano.jpg',
                'tagline'   => 'Experiencia premium para ocasiones especiales.',
                'capacidad' => 'Hasta 4 pasajeros',
                'maletas'   => '2–3 maletas',
            ],
        ];


        return view('home', compact('isAdmin', 'isCorporate', 'isTraveler', 'vehiculos', 'metaVehiculos'));
    }
}
