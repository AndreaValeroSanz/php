<!doctype html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Producto 3 - Traslados Laravel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>

       /* =========================
        NAVBAR LANDING
        ========================== */
        .landing-navbar {
            background: rgba(34, 85, 91, 0.96);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.35);
        }

        /* Badge redondo del logo */
        .brand-badge {
            width: 32px;
            height: 32px;
            border-radius: 999px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: 700;
            font-size: .9rem;
            background: radial-gradient(circle at 0% 0%, #facc6b, #0f766e);
            color: #0b1120;
        }

        /* Links del navbar */
        .landing-navbar .nav-link {
            position: relative;
            padding-bottom: 4px;
            color: #e5f9f7;
            opacity: .85;
            transition: color .25s ease, opacity .25s ease;
        }

        /* Base del subrayado (oculto por defecto) */
        .landing-navbar .nav-link::after {
            content: "";
            position: absolute;
            left: 0.6rem;
            right: 0.6rem;
            bottom: -0.35rem;
            height: 3px;
            border-radius: 999px;
            background: linear-gradient(90deg, #0f766e, #facc6b);
            transform: scaleX(0);
            transform-origin: center;
            opacity: 0;
            transition: transform .25s ease-out, opacity .25s ease-out;
        }

        /* Hover */
        .landing-navbar .nav-link:hover {
            opacity: 1;
            color: #facc6b;
        }

        .landing-navbar .nav-link:hover::after {
            opacity: 1;
            transform: scaleX(1);
        }

        /* Activo */
        .landing-navbar .nav-link.active {
            opacity: 1;
            color: #facc6b;
        }

        .landing-navbar .nav-link.active::after {
            opacity: 1;
            transform: scaleX(1);
        }

        /* Móvil: centramos menú y opcionalmente quitamos subrayado si molesta */
        @media (max-width: 991.98px) {
            .landing-navbar .navbar-nav {
                margin-top: 1rem;
                text-align: center;
            }

            /* Si quieres quitar rayita en móvil, deja esto;
            si quieres que siga saliendo, elimina este bloque */
            .landing-navbar .nav-link::after {
                display: none;
            }
        }


    </style>
</head>
<body>

@php
    use Illuminate\Support\Facades\Auth;

    $isAdmin     = Auth::guard('admin')->check();
    $isCorporate = Auth::guard('corporate')->check();
    $isTraveler  = Auth::guard('web')->check();
@endphp

<nav class="navbar navbar-expand-lg"
     style="background:#0f766e; padding: .65rem 0;">
    <div class="container">

        {{-- Logo --}}
        <a class="navbar-brand d-flex align-items-center text-white"
           href="{{ route('home') }}#hero">
            <div class="rounded-circle me-2 d-flex justify-content-center align-items-center"
                 style="width:34px; height:34px; background:#facc6b; color:#0f766e; font-weight:700;">
                IT
            </div>
            <span class="fw-semibold">Isla Transfers P3</span>
        </a>

        {{-- Botón hamburguesa --}}
        <button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse"
                data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">

            {{-- Links centrados --}}
            <ul class="navbar-nav mx-auto gap-lg-3">

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('/') ? 'active' : '' }}"
                    href="{{ route('home') }}#hero" data-scroll="true">
                        Inicio
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->is('/') ? 'active' : '' }}"
                    href="{{ route('home') }}#fleet" data-scroll="true">
                        Vehículos
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-white {{ request()->routeIs('login') ? 'active' : '' }}"
                    href="{{ route('login') }}">
                        Traslados
                    </a>
                </li>

            </ul>

            {{-- Botones derecha --}}
            <div class="d-flex gap-2">

    {{-- Si NO estás logueado --}}
    @if (!$isAdmin && !$isCorporate && !$isTraveler)
        <a href="{{ route('login') }}" class="btn btn-sm btn-outline-light">
            Login
        </a>
        <a href="{{ route('register') }}" class="btn btn-sm"
           style="background:#facc6b; color:#0f766e; font-weight:600;">
            Registro
        </a>
    @endif

    {{-- Si eres ADMIN --}}
    @if ($isAdmin)
        <a href="{{ route('admin.dashboard') }}" class="btn btn-sm btn-light">
            Panel Admin
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm btn-danger">Salir</button>
        </form>
    @endif

    {{-- Si eres HOTEL --}}
    @if ($isCorporate)
        <a href="{{ route('corporate.dashboard') }}" class="btn btn-sm btn-light">
            Panel Hotel
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm btn-danger">Salir</button>
        </form>
    @endif

    {{-- Si eres VIAJERO --}}
    @if ($isTraveler)
        <a href="{{ route('user.dashboard') }}" class="btn btn-sm btn-light">
            Mi Cuenta
        </a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-sm btn-danger">Salir</button>
        </form>
    @endif

</div>

        </div>
    </div>
</nav>





<main class="container mt-4">
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const links = document.querySelectorAll('a[data-scroll="true"]');

    links.forEach(link => {
        link.addEventListener('click', function (e) {
            const href = this.getAttribute('href');
            const hashIndex = href.indexOf('#');
            if (hashIndex === -1) return; // no hay ancla

            const targetId = href.substring(hashIndex + 1);
            const targetEl = document.getElementById(targetId);

            if (targetEl) {
                e.preventDefault();
                window.scrollTo({
                    top: targetEl.offsetTop - 80, // margen por el navbar
                    behavior: 'smooth'
                });
            }
        });
    });
});
</script>

</body>
</html>
