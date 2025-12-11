@extends('layouts.app')

@section('content')
<style>
    /* =========================
       HERO & COLORES
    ========================== */
    .landing-hero-wrapper {
        background: linear-gradient(90deg, #0f9f9a, #f7d674);
        border-radius: 1.75rem;
        padding: 3rem 2.5rem;
        color: #ffffff;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.35);
        position: relative;
        overflow: hidden;
    }

    .landing-hero-wrapper::after {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        border-radius: 999px;
        background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.25), transparent 60%);
        top: -80px;
        right: -60px;
        opacity: .8;
    }

    .landing-pill {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .35rem .9rem;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.25);
        font-size: .8rem;
        letter-spacing: .04em;
        text-transform: uppercase;
    }

    .landing-pill span {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: #22c55e;
        box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.35);
    }

    .hero-badges .badge {
        border-radius: 999px;
        padding: .45rem .9rem;
        font-weight: 500;
        background: rgba(15, 23, 42, .15);
        backdrop-filter: blur(8px);
    }

    .badge-service {
        background: rgba(20, 184, 166, 0.15);
        color: #022c22;
    }

    .badge-panel {
        background: rgba(250, 204, 21, 0.15);
        color: #78350f;
    }

    .landing-section-title {
        font-weight: 700;
        color: #0f172a;
    }

    /* Botones principales */
    .btn-teal {
        background: #0f766e;
        border-color: #0f766e;
        color: #e5f9f7;
        font-weight: 600;
        border-radius: 999px;
        padding-inline: 1.6rem;
    }

    .btn-teal:hover {
        background: #115e59;
        border-color: #115e59;
        color: #ffffff;
    }

    .btn-soft-yellow {
        background: #facc6b;
        border-color: #facc6b;
        color: #1f2937;
        font-weight: 600;
        border-radius: 999px;
        padding-inline: 1.6rem;
    }

    .btn-soft-yellow:hover {
        background: #fbbf24;
        border-color: #fbbf24;
        color: #111827;
    }

     /* =========================
       HERO & COLORES
    ========================== */

    .landing-hero-wrapper {
        /* Foto + gradiente optimizado por zonas */
        background:
            linear-gradient(
                90deg,
                rgba(15,159,154,.65) 0%,
                rgba(15,159,154,.35) 35%,
                rgba(247,214,116,.30) 70%,
                rgba(247,214,116,.20) 100%
            ),
        url('/images/hero_avion_isla.jpg') center/cover no-repeat;
        border-radius: 1.75rem;
        padding: 3rem 2.5rem;
        color: #ffffff;
        box-shadow: 0 24px 60px rgba(15, 23, 42, 0.35);
        position: relative;
        overflow: hidden;
    }


    .landing-hero-wrapper::after {
        content: "";
        position: absolute;
        width: 280px;
        height: 280px;
        border-radius: 999px;
        background: radial-gradient(circle at 30% 30%, rgba(255,255,255,0.25), transparent 60%);
        top: -80px;
        right: -60px;
        opacity: .8;
    }

    .landing-pill {
        display: inline-flex;
        align-items: center;
        gap: .5rem;
        padding: .35rem .9rem;
        border-radius: 999px;
        background: rgba(15, 23, 42, 0.25);
        font-size: .8rem;
        letter-spacing: .04em;
        text-transform: uppercase;
    }

    .landing-pill span {
        display: inline-block;
        width: 8px;
        height: 8px;
        border-radius: 999px;
        background: #22c55e;
        box-shadow: 0 0 0 4px rgba(34, 197, 94, 0.35);
    }

    .hero-badges .badge {
        border-radius: 999px;
        padding: .45rem .9rem;
        font-weight: 500;
        background: rgba(15, 23, 42, .15);
        backdrop-filter: blur(8px);
    }

    .badge-service {
        background: rgba(20, 184, 166, 0.15);
        color: #022c22;
    }

    .badge-panel {
        background: rgba(15, 118, 110, 0.18); /* tono turquesa suave */
        color: #0f172a; /* azul oscuro elegante para contraste */
        border: 1px solid rgba(15, 118, 110, 0.35); /* borde sutil */
        backdrop-filter: blur(6px);
    }

    .landing-section-title {
        font-weight: 700;
        color: #0f172a;
    }

    /* Botones principales */
    .btn-teal {
        background: #0f766e;
        border-color: #0f766e;
        color: #e5f9f7;
        font-weight: 600;
        border-radius: 999px;
        padding-inline: 1.6rem;
    }

    .btn-teal:hover {
        background: #115e59;
        border-color: #115e59;
        color: #ffffff;
    }

    .btn-soft-yellow {
        background: #facc6b;
        border-color: #facc6b;
        color: #1f2937;
        font-weight: 600;
        border-radius: 999px;
        padding-inline: 1.6rem;
    }

    .btn-soft-yellow:hover {
        background: #fbbf24;
        border-color: #fbbf24;
        color: #111827;
    }


    /* =========================
        CARRUSEL HERO
    ========================== */
    .hero-right-col {
        display: flex;
        justify-content: flex-end;
    }

    .hero-carousel {
        background: rgba(255, 255, 255, 0.32); /* MENOS BLANCO */
        backdrop-filter: blur(10px); /* Más cristal */
        -webkit-backdrop-filter: blur(14px); /* Safari support */
        border-radius: 1.5rem;
        color: #0f172a;
        padding: 1.75rem 2.25rem 2rem;
        box-shadow: 0 28px 60px rgba(0,0,0,0.18); /* Mejor separación */
    }


    .hero-carousel .carousel-inner {
        width: 100%;
        height: 100%;
    }

    .hero-carousel .carousel-item {
        height: auto;
    }

    .hero-slide-content {
        padding: 2.4rem 2.25rem 1rem 2.25rem;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .hero-slide-content h3 {
        color: #0f766e;
        -webkit-text-fill-color: #0f766e; /* verde elegante */
        font-weight: 700;
    }

    .hero-slide-content p,
    .hero-slide-content ul {
        color: #334155 !important; /* gris azul legible */
    }

    /* Controles del carrusel */
    .hero-carousel .carousel-control-prev,
    .hero-carousel .carousel-control-next {
        width: 2.8rem;
        height: 2.8rem;
        top: 50%;
        transform: translateY(-50%);
        border-radius: 999px;
        background-color: rgba(15, 118, 110, .85);
        opacity: 1;
        box-shadow: 0 6px 18px rgba(0,0,0,0.20);
    }

    /* Separación del borde */
    .hero-carousel .carousel-control-prev {
        left: -1.25rem; /* MUY importante */
    }

    .hero-carousel .carousel-control-next {
        right: -1.25rem; /* MUY importante */
    }

    /* Iconos */
    .hero-carousel .carousel-control-prev-icon,
    .hero-carousel .carousel-control-next-icon {
        filter: invert(1) brightness(2);
        background-size: 70% 70%;
    }

    /* Hover */
    .hero-carousel .carousel-control-prev:hover,
    .hero-carousel .carousel-control-next:hover {
        background-color: #0d5c54;
    }

        /* Indicadores estilo rayitas premium */
    .hero-carousel .carousel-indicators {
        position: absolute;
        top: 0.75rem;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: .45rem;
        margin: 0;
        padding: 0;
        z-index: 2;
    }

    .hero-carousel .carousel-indicators [data-bs-target] {
        width: 38px;
        height: 4px;
        border-radius: 999px;
        background: linear-gradient(90deg, #0f766e, #0d9488);
        opacity: .35;
        transition: opacity .25s ease, transform .25s ease;
        border: none;
    }

    .hero-carousel .carousel-indicators .active {
        opacity: 1;
        transform: scale(1.12);
        background: linear-gradient(90deg, #facc6b, #eab308);
    }




    /* =========================
       SECCIÓN: ELIGE TU TRASLADO
    ========================== */
    .transfer-options {
        margin-bottom: 3.5rem;
    }

    .transfer-options-header {
        max-width: 640px;
        margin: 0 auto 2rem auto;
        text-align: center;
    }

    .transfer-options-header p {
        font-size: .95rem;
    }

    .transfer-card {
        background: rgba(255, 255, 255, 0.96);
        border-radius: 1.5rem;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
        padding: 1.6rem 1.4rem 1.5rem;
        display: flex;
        flex-direction: column;
        gap: .6rem;
        height: 100%;
        position: relative;
        overflow: hidden;
        text-decoration: none;
        color: #0f172a;
        transition: transform .18s ease, box-shadow .18s ease, background .18s ease;
    }

    .transfer-card::after {
        content: "";
        position: absolute;
        width: 120px;
        height: 120px;
        border-radius: 999px;
        background: radial-gradient(circle at 120% -10%, rgba(15, 118, 110, 0.08), transparent 70%);
        right: -40px;
        top: -40px;
        pointer-events: none;
    }

    .transfer-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 26px 60px rgba(15, 23, 42, 0.14);
        background: #ffffff;
    }

    .transfer-card-icon {
        width: 42px;
        height: 42px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin-bottom: .25rem;
        font-size: 1.15rem;
        background: rgba(15, 118, 110, 0.1);
        color: #0f766e;
    }

    .transfer-card h3 {
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: .1rem;
    }

    .transfer-card p {
        font-size: .9rem;
        color: #6b7280;
        margin-bottom: .2rem;
    }

    .transfer-card-meta {
        font-size: .8rem;
        color: #94a3b8;
    }

    .transfer-card-cta {
        margin-top: .6rem;
        font-size: .85rem;
        font-weight: 600;
        color: #0f766e;
        display: inline-flex;
        align-items: center;
        gap: .35rem;
    }

    /* =========================
       SECCIÓN: BENEFICIOS SIMPLE
    ========================== */
    .benefits-section {
        margin-bottom: 3.5rem;
    }

    .benefits-band {
        background: #f8fafc;
        border-radius: 1.5rem;
        padding: 2.5rem 2rem 2rem;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.06);
    }

    .benefits-header {
        max-width: 640px;
        margin: 0 auto 2rem auto;
        text-align: center;
    }

    .benefits-header p {
        font-size: .95rem;
        color: #6b7280;
    }

    .benefits-list {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 1.75rem 2.5rem;
    }

    .benefit-item {
        display: flex;
        align-items: flex-start;
        gap: .75rem;
    }

    .benefit-icon-round {
        width: 34px;
        height: 34px;
        border-radius: 999px;
        background: rgba(15, 118, 110, 0.08);
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.2rem;
        color: #0f766e;
        flex-shrink: 0;
    }

    .benefit-item-title {
        font-size: .95rem;
        font-weight: 600;
        margin-bottom: .1rem;
        color: #0f172a;
    }

    .benefit-item-text {
        font-size: .88rem;
        color: #6b7280;
        margin: 0;
    }

    /* =========================
        FLOTA DE VEHÍCULOS
    ========================= */
    .fleet-section {
        margin-bottom: 3.5rem;
    }

    .fleet-kicker {
        font-size: .78rem;
        text-transform: uppercase;
        letter-spacing: .18em;
        color: #0f766e;
        font-weight: 600;
    }

    .fleet-card {
        background: #ffffff;
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 18px 40px rgba(15,23,42,0.08);
        display: flex;
        flex-direction: column;
        height: 100%;
        transition: transform .18s ease, box-shadow .18s ease;
    }

    .fleet-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 26px 60px rgba(15,23,42,0.14);
    }

    .fleet-card-image-wrapper {
        position: relative;
        padding-top: 60%; /* 16:9 aprox */
        overflow: hidden;
    }

    .fleet-card-image {
        position: absolute;
        inset: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transform: scale(1.04);
        transition: transform .25s ease;
    }

    .fleet-card:hover .fleet-card-image {
        transform: scale(1.09);
    }

    .fleet-card-body {
        padding: 1.3rem 1.3rem 1.4rem;
    }

    .fleet-card-title {
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: .25rem;
        color: #0f172a;
    }

    .fleet-card-tagline {
        font-size: .9rem;
        color: #4b5563;
        margin-bottom: .75rem;
    }

    .fleet-card-meta li {
        font-size: .85rem;
        color: #6b7280;
        margin-bottom: .15rem;
    }

    .fleet-card-meta li span {
        font-weight: 600;
        color: #0f172a;
    }

    .fleet-card-footnote {
        font-size: .8rem;
        color: #9ca3af;
    }

    /* Responsive */
    @media (max-width: 767.98px) {
        .fleet-card-body {
            padding: 1.1rem 1.1rem 1.2rem;
        }
    }


    /* =========================
       SECCIÓN: TESTIMONIOS
    ========================== */
    .testimonials-section {
        margin-bottom: 3.5rem;
    }

    .testimonials-header {
        max-width: 640px;
        margin: 0 auto 2rem auto;
        text-align: center;
    }

    .testimonials-header p {
        font-size: .95rem;
        color: #6b7280;
    }

    .testimonial-card {
        background: rgba(255, 255, 255, 0.96);
        border-radius: 1.5rem;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.08);
        padding: 1.6rem 1.5rem 1.5rem;
        height: 100%;
        display: flex;
        flex-direction: column;
        gap: .7rem;
    }

    .testimonial-user {
        display: flex;
        align-items: center;
        gap: .75rem;
    }

    .testimonial-avatar {
        width: 44px;
        height: 44px;
        border-radius: 999px;
        background: linear-gradient(135deg, #0f9f9a, #facc6b);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ffffff;
        font-weight: 700;
        font-size: 1rem;
    }

    .testimonial-name {
        font-size: .95rem;
        font-weight: 600;
        color: #0f172a;
    }

    .testimonial-role {
        font-size: .8rem;
        color: #94a3b8;
    }

    .testimonial-text {
        font-size: .9rem;
        color: #6b7280;
        margin-bottom: 0;
    }

    /* -------- FOOTER FULL-WIDTH -------- */

    .site-footer {
        margin-top: 4rem;
        /* fondo degradado */
        background: radial-gradient(circle at 0% 0%, #0f9f9a 0%, #0f766e 35%, #0b5258 70%, #082f49 100%);
        color: #e5f9f7;
        padding: 2.5rem 0 1.8rem;

        /* TRUCO para romper cualquier .container padre y ocupar todo el viewport */
        width: 100vw;
        margin-left: calc(50% - 50vw);
    }

    .site-footer .container {
        max-width: 1140px;          /* ancho de contenido centrado */
        padding-left: 1.5rem;
        padding-right: 1.5rem;
    }

    /* Tipografías y enlaces */
    .site-footer-title {
        font-weight: 700;
        font-size: 1.05rem;
        letter-spacing: .06em;
        text-transform: uppercase;
        margin-bottom: .5rem;
    }

    .site-footer-text {
        font-size: .9rem;
        color: #cbd5f5;
        max-width: 320px;
    }

    .site-footer-heading {
        font-size: .9rem;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin-bottom: .5rem;
        color: #fefce8;
    }

    .site-footer-link {
        display: inline-flex;
        align-items: center;
        gap: .3rem;
        font-size: .9rem;
        margin-bottom: .25rem;
        color: #e5f9f7;
        text-decoration: none;
    }

    .site-footer-link span {
        font-size: .8rem;
        opacity: .8;
    }

    .site-footer-link:hover {
        color: #facc6b;
        text-decoration: none;
    }

    .site-footer-highlights {
        font-size: .9rem;
        color: #fef9c3;
        max-width: 360px;
    }

    /* Línea inferior */
    .site-footer-bottom {
        border-top: 1px solid rgba(148, 163, 184, 0.4);
        padding-top: 1rem;
        font-size: .8rem;
        color: #cbd5f5;
    }

    .site-footer-bottom a {
        color: #e5f9f7;
        text-decoration: none;
    }

    .site-footer-bottom a:hover {
        color: #facc6b;
        text-decoration: underline;
    }

    /* =========================
    FLOTA: ACORDEÓN HORIZONTAL
    ========================== */

    .fleet-section {
        margin-bottom: 3.5rem;
    }

    .fleet-accordion {
        display: flex;
        gap: 1.25rem;
        height: 320px;
    }

    .fleet-item {
        position: relative;
        flex: 1;
        border-radius: 1.5rem;
        overflow: hidden;
        cursor: pointer;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        transition:
            flex .35s ease,
            transform .35s ease,
            box-shadow .35s ease,
            filter .35s ease;
        box-shadow: 0 18px 40px rgba(15, 23, 42, 0.25);
        filter: saturate(0.8) brightness(0.9);
    }

    /* Estado al pasar el ratón: se expande */
    .fleet-item:hover {
        flex: 3;
        transform: translateY(-6px);
        box-shadow: 0 26px 60px rgba(15, 23, 42, 0.35);
        filter: saturate(1.1) brightness(1.02);
    }

    /* Fondo por defecto para que siempre se vea alguno más grande en desktop */
    .fleet-item:first-child {
        flex: 2.4;
    }

    /* Overlay de texto */
    .fleet-overlay {
        position: relative;
        z-index: 1;

        display: flex;
        flex-direction: column;
        justify-content: flex-end;   /* Texto hacia abajo */
        gap: .5rem;

        height: 100%;
        padding: 1rem 1rem 1rem;

        /* Degradado más oscuro para leer mejor */
        background: linear-gradient(
            to top,
            rgba(15, 23, 42, 0.92),
            rgba(15, 23, 42, 0.65) 25%,
            rgba(15, 23, 42, 0.25) 60%,
            transparent
        );

        color: #f9fafb;
        text-shadow: 0 1px 2px rgba(15, 23, 42, 0.8);
    }


    .fleet-item h3 {
        font-size: 1rem;
        font-weight: 700;
        margin: 0 0 .1rem;
        margin-bottom: .05rem;
        /* color: #0f766e; */
        color: #facc6b;
    }

    .fleet-overlay p {
        font-size: .75rem;
        margin: 0 0 .1rem;
        line-height: 1.25;
    }

    .fleet-overlay ul {
        list-style: none;
        padding: 0;
        margin: 0 0 .4rem;
        font-size: .85rem;
    }

    .fleet-overlay ul li {
        font-size: .65rem;
        line-height: 1.25;
        margin-bottom: .1rem;
    }



    /* Imágenes concretas de cada vehículo */
    .fleet-item-1 {
        background-image: url('/images/sedan_demo.jpg');
    }

    .fleet-item-2 {
        background-image: url('/images/minivan.jpg');
    }

    .fleet-item-3 {
        background-image: url('/images/yaris.jpg');
    }

    .fleet-item-4 {
        background-image: url('/images/mustang.jpg');
    }

    .fleet-item-5 {
        background-image: url('/images/milano.jpg');
    }

    /* Contenedor de iconos */
    .footer-socials {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-top: .5rem;
    }

    /* Enlaces de iconos */
    .footer-social {
        display: inline-flex;
        align-items: center;
        text-decoration: none !important;
        color: #ffffffd0;
        transition: all .25s ease;
    }

    /* Evitar subrayado en SVG */
    .footer-social svg {
        display: block;
        text-decoration: none !important;
    }

    /* Hover elegante */
    .footer-social:hover {
        color: #facc6b; /* Dorado */
        transform: translateY(-2px);
    }



/* ----- Responsive: en móvil que no sea acordeón sino tarjetas apiladas ----- */
    @media (max-width: 991.98px) {
        .fleet-accordion {
            flex-direction: column;
            height: auto;
        }

        .fleet-item,
        .fleet-item:first-child {
            flex: none;
            height: 260px;
        }

        .fleet-item:hover {
            transform: translateY(-3px);
            flex: none;
        }
}


/* Responsive */
    @media (max-width: 767.98px) {
        .site-footer {
            padding: 2.2rem 0 1.6rem;
        }

        .site-footer-bottom {
            flex-direction: column;
            align-items: flex-start !important;
            gap: .5rem;
        }

        .site-footer-text,
        .site-footer-highlights {
            max-width: 100%;
        }
}

    /* =========================
       MEDIA QUERIES
    ========================== */
    @media (max-width: 991.98px) {
        .landing-hero-wrapper {
            padding: 2.25rem 1.8rem;
        }

        .hero-right-col {
            margin-top: 1.75rem;
            justify-content: center;
        }

        .hero-carousel {
            min-height: 0;
            height: auto;
        }

        .benefits-list {
            grid-template-columns: repeat(2, minmax(0, 1fr));
        }
    }

    @media (max-width: 767.98px) {
        .transfer-card {
            padding: 1.4rem 1.25rem 1.3rem;
        }

        .benefits-band {
            padding: 2rem 1.4rem 1.7rem;
        }

        .benefits-list {
            grid-template-columns: 1fr;
        }

        .site-footer {
            padding: 2.2rem 0 1.6rem;
        }

        .site-footer-bottom {
            flex-direction: column;
            align-items: flex-start !important;
            gap: .5rem;
        }

        .site-footer-text,
        .site-footer-highlights {
            max-width: 100%;
        }
    }
</style>

<div class="container py-5">

    {{-- HERO CON CARRUSEL --}}
    <div id="" class="landing-hero-wrapper mb-5">
        <div class="row align-items-center g-4">
            {{-- Columna izquierda: texto principal --}}
            <div class="col-lg-6 position-relative">
                <div class="landing-pill mb-3">
                    <span></span>
                    <small>Traslados en isla · 24/7</small>
                </div>

                <h1 class="display-5 fw-bold mb-3">
                    Traslados en isla
                    <span class="d-block">sin colas ni sorpresas.</span>
                </h1>

                <p class="lead mb-4">
                    Reserva tu traslado aeropuerto ↔ hotel en segundos
                    y lleva todas tus reservas en un único panel.
                </p>

                <div class="d-flex flex-wrap gap-2 mb-4 hero-badges">
                    <span class="badge badge-service">
                        ✈️ Aeropuerto ↔ hotel
                    </span>
                    <span class="badge badge-service">
                        🚐 Flota seleccionada en la isla
                    </span>
                    <span class="badge badge-panel">
                        👥 Paneles para hoteles y viajeros
                    </span>
                </div>

                <div class="d-flex flex-wrap gap-2">
                    <a href="{{ route('login') }}" class="btn btn-teal">
                        Reservar traslado
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-soft-yellow">
                        Acceder al panel
                    </a>
                </div>
            </div>

            {{-- Columna derecha: carrusel --}}
            <div class="col-lg-6 hero-right-col">
                <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="0" class="active"
                                aria-current="true" aria-label="Traslados"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="1"
                                aria-label="Hoteles"></button>
                        <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="2"
                                aria-label="Viajeros"></button>
                    </div>

                    <div class="carousel-inner">
                        {{-- Slide 1: Traslados --}}
                        <div class="carousel-item active">
                            <div class="hero-slide-content">
                                <h3 class="h5 fw-bold mb-2">
                                    Traslados rápidos aeropuerto ↔ hotel
                                </h3>
                                <p class="mb-3 text-muted">
                                    Elige origen y destino, horario y tipo de vehículo. Nosotros conectamos tu reserva
                                    con la flota disponible en la isla.
                                </p>
                                <ul class="mb-3 small text-muted">
                                    <li>Confirmación inmediata y resumen por pantalla.</li>
                                    <li>Vehículos adaptados al número de viajeros.</li>
                                    <li>Sin llamadas ni correos: todo desde la web.</li>
                                </ul>
                                {{-- <a href="{{ route('transfer.select-type') }}" class="btn btn-teal btn-sm">
                                    Empezar reserva
                                </a> --}}
                            </div>
                        </div>

                        {{-- Slide 2: Panel hoteles --}}
                        <div class="carousel-item">
                            <div class="hero-slide-content">
                                <h3 class="h5 fw-bold mb-2">Panel para hoteles</h3>
                                <p class="mb-3 text-muted">
                                    Gestiona reservas de los huéspedes, visualiza comisiones y controla los traslados
                                    del alojamiento en un solo lugar.
                                </p>
                                <ul class="mb-3 small text-muted">
                                    <li>Reservas rápidas para huéspedes.</li>
                                    <li>Comisiones claras y mensuales.</li>
                                    <li>Acceso multiusuario del personal.</li>
                                </ul>
                                {{-- <a href="{{ route('register') }}" class="btn btn-soft-yellow btn-sm">
                                    Soy un hotel, quiero registrarme
                                </a> --}}
                            </div>
                        </div>

                        {{-- Slide 3: Panel viajeros --}}
                        <div class="carousel-item">
                            <div class="hero-slide-content">
                                <h3 class="h5 fw-bold mb-2">
                                    Viajeros con todo bajo control
                                </h3>
                                <p class="mb-3 text-muted">
                                    Desde tu área privada puedes revisar tus reservas, modificar datos y ver horarios
                                    sin depender de terceros.
                                </p>
                                <ul class="mb-3 small text-muted">
                                    <li>Histórico de reservas siempre disponible.</li>
                                    <li>Datos claros del punto de recogida y destino.</li>
                                    <li>Diseñada para usar desde móvil en pleno viaje.</li>
                                </ul>
                                {{-- <a href="{{ route('register') }}" class="btn btn-teal btn-sm">
                                    Crear cuenta viajero
                                </a> --}}
                            </div>
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel"
                            data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Anterior</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel"
                            data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Siguiente</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    {{-- SECCIÓN: ELIGE TU TRASLADO --}}
    <section class="transfer-options">
        <div class="transfer-options-header">
            <h2 class="landing-section-title h4 mb-2">
                Elige tu traslado en la isla
            </h2>
            <p class="text-muted mb-0">
                Tres formas de moverte entre aeropuerto y hotel. Reserva en segundos,
                sin llamadas ni correos.
            </p>
        </div>

        <div class="row g-4">
            {{-- Card 1: Aeropuerto → hotel --}}
            <div class="col-md-4">
                <a href="{{ route('login') }}" class="transfer-card">
                    <div class="transfer-card-icon">🛬</div>
                    <h3>Aeropuerto → hotel</h3>
                    <p>
                        Te recogemos a la llegada y te llevamos directo a tu alojamiento,
                        sin esperas en el aeropuerto.
                    </p>
                    <span class="transfer-card-meta">
                        Ideal para llegadas con equipaje o en grupo.
                    </span>
                    <span class="transfer-card-cta">
                        Reservar este trayecto →
                    </span>
                </a>
            </div>

            {{-- Card 2: Hotel → aeropuerto --}}
            <div class="col-md-4">
                <a href="{{ route('login') }}" class="transfer-card">
                    <div class="transfer-card-icon">🛫</div>
                    <h3>Hotel → aeropuerto</h3>
                    <p>
                        Marca la hora de salida y nos encargamos de que llegues con tiempo
                        a tu vuelo.
                    </p>
                    <span class="transfer-card-meta">
                        Sin prisas de última hora ni taxis improvisados.
                    </span>
                    <span class="transfer-card-cta">
                        Planificar salida →
                    </span>
                </a>
            </div>

            {{-- Card 3: Ida y vuelta --}}
            <div class="col-md-4">
                <a href="{{ route('login') }}" class="transfer-card">
                    <div class="transfer-card-icon">🔁</div>
                    <h3>Ida y vuelta</h3>
                    <p>
                        Deja cerrados los dos traslados: llegada y salida organizadas
                        desde el primer momento.
                    </p>
                    <span class="transfer-card-meta">
                        La opción más cómoda para estancias completas.
                    </span>
                    <span class="transfer-card-cta">
                        Reservar ida y vuelta →
                    </span>
                </a>
            </div>
        </div>
    </section>

    {{-- SECCIÓN: BENEFICIOS (LISTA SIMPLE) --}}
    <section class="benefits-section">
        <div class="benefits-band">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="benefits-header">
                        <h2 class="landing-section-title h4 mb-2">
                            ¿Por qué reservar con Isla Transfers?
                        </h2>
                        <p class="mb-0">
                            Una plataforma pensada para que tu llegada y salida de la isla
                            sean tan sencillas como tu reserva.
                        </p>
                    </div>

                    <div class="benefits-list">
                        <div class="benefit-item">
                            <div class="benefit-icon-round">⏱️</div>
                            <div>
                                <p class="benefit-item-title">Sin colas ni esperas</p>
                                <p class="benefit-item-text">
                                    Reserva antes de viajar y súbete directamente al vehículo al llegar.
                                </p>
                            </div>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon-round">💶</div>
                            <div>
                                <p class="benefit-item-title">Precio cerrado</p>
                                <p class="benefit-item-text">
                                    Conoce el importe antes de confirmar, sin sorpresas ni recargos ocultos.
                                </p>
                            </div>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon-round">🧑‍✈️</div>
                            <div>
                                <p class="benefit-item-title">Conductores verificados</p>
                                <p class="benefit-item-text">
                                    Flota seleccionada para que cada traslado sea seguro y cómodo.
                                </p>
                            </div>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon-round">📱</div>
                            <div>
                                <p class="benefit-item-title">Todo desde el móvil</p>
                                <p class="benefit-item-text">
                                    Consulta horarios, puntos de recogida y reservas desde tu área privada.
                                </p>
                            </div>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon-round">🏨</div>
                            <div>
                                <p class="benefit-item-title">Hoteles conectados</p>
                                <p class="benefit-item-text">
                                    Panel propio para que los alojamientos gestionen los traslados de sus huéspedes.
                                </p>
                            </div>
                        </div>

                        <div class="benefit-item">
                            <div class="benefit-icon-round">📊</div>
                            <div>
                                <p class="benefit-item-title">Visión global de la isla</p>
                                <p class="benefit-item-text">
                                    Reservas organizadas por zonas para analizar mejor la demanda de traslados.
                                </p>
                            </div>
                        </div>
                    </div> {{-- .benefits-list --}}
                </div>
            </div>
        </div>
    </section>


    {{-- SECCIÓN FLOTA: ACORDEÓN HORIZONTAL --}}
    <section id="fleet" class="fleet-section container py-5">
        <div class="text-center mb-4">
            <h2 class="landing-section-title h4 mb-2">
                Vehículos preparados para tus traslados
            </h2>
            <p class="text-muted mb-0">
                Desde sedanes cómodos hasta minivans VIP, elige el vehículo que mejor encaje
                con tu llegada o salida en la isla.
            </p>
        </div>

        <div class="fleet-accordion">
            {{-- 1. Sedán Demo --}}
            <article class="fleet-item fleet-item-1">
                <div class="fleet-overlay">
                    <h3>Sedán Demo</h3>
                    <p>Cómodo y elegante para traslados diarios.</p>
                    <ul>
                        <li>👥 Hasta 3 pasajeros</li>
                        <li>🧳 2 maletas grandes</li>
                    </ul>
                    {{-- <span class="fleet-tag">Ideal para traslados individuales o en pareja.</span> --}}
                </div>
            </article>

            {{-- 2. Minivan VIP Deluxe --}}
            <article class="fleet-item fleet-item-2">
                <div class="fleet-overlay">
                    <h3>Minivan VIP Deluxe</h3>
                    <p>Perfecta para familias y grupos pequeños.</p>
                    <ul>
                        <li>👥 Hasta 7 pasajeros</li>
                        <li>🧳 4-5 maletas</li>
                    </ul>
                    {{-- <span class="fleet-tag">Espacio y comodidad para todos.</span> --}}
                </div>
            </article>

            {{-- 3. Toyota Yaris --}}
            <article class="fleet-item fleet-item-3">
                <div class="fleet-overlay">
                    <h3>Toyota Yaris</h3>
                    <p>Compacto, ágil y muy eficiente.</p>
                    <ul>
                        <li>👥 Hasta 3 pasajeros</li>
                        <li>🧳 2 maletas de cabina</li>
                    </ul>
                    {{-- <span class="fleet-tag">Genial para moverse rápido por la isla.</span> --}}
                </div>
            </article>

            {{-- 4. Mustang --}}
            <article class="fleet-item fleet-item-4">
                <div class="fleet-overlay">
                    <h3>Mustang</h3>
                    <p>Estilo deportivo para una experiencia única.</p>
                    <ul>
                        <li>👥 Hasta 2 pasajeros</li>
                        <li>🧳 Equipaje ligero</li>
                    </ul>
                    {{-- <span class="fleet-tag">Para quienes quieren algo diferente.</span> --}}
                </div>
            </article>

            {{-- 5. Milano Starship --}}
            <article class="fleet-item fleet-item-5">
                <div class="fleet-overlay">
                    <h3>Milano Starship</h3>
                    <p>SUV premium para viajar con total confort.</p>
                    <ul>
                        <li>👥 Hasta 4 pasajeros</li>
                        <li>🧳 3-4 maletas</li>
                    </ul>
                    {{-- <span class="fleet-tag">La opción más exclusiva de la flota.</span> --}}
                </div>
            </article>
        </div>
    </section>



    {{-- SECCIÓN: TESTIMONIOS --}}
    <section class="testimonials-section">
        <div class="testimonials-header">
            <h2 class="landing-section-title h4 mb-2">
                Lo que dicen nuestros clientes
            </h2>
            <p class="mb-0">
                Hoteles y viajeros que ya usan Isla Transfers para organizar sus traslados en la isla.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="testimonial-user">
                        <div class="testimonial-avatar">CA</div>
                        <div>
                            <div class="testimonial-name">Hotel Cala Azul</div>
                            <div class="testimonial-role">Recepción</div>
                        </div>
                    </div>
                    <p class="testimonial-text">
                        “Antes gestionábamos los traslados con llamadas y correos. Ahora todo está en un solo panel
                        y sabemos las comisiones de cada mes al momento.”
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="testimonial-user">
                        <div class="testimonial-avatar">LM</div>
                        <div>
                            <div class="testimonial-name">Laura M.</div>
                            <div class="testimonial-role">Viajera</div>
                        </div>
                    </div>
                    <p class="testimonial-text">
                        “Reservé ida y vuelta en cinco minutos. Al llegar ya nos estaban esperando y no tuvimos que
                        buscar taxi después del vuelo.”
                    </p>
                </div>
            </div>

            <div class="col-md-4">
                <div class="testimonial-card">
                    <div class="testimonial-user">
                        <div class="testimonial-avatar">IT</div>
                        <div>
                            <div class="testimonial-name">Isla Transfers</div>
                            <div class="testimonial-role">Equipo de operaciones</div>
                        </div>
                    </div>
                    <p class="testimonial-text">
                        “Diseñamos la plataforma para que la coordinación entre hoteles, viajeros y administración
                        sea clara, rápida y sin sorpresas.”
                    </p>
                </div>
            </div>
        </div>
    </section>

</div> {{-- cierre del container principal --}}

    <footer class="site-footer">
        <div class="container">
            <div class="row gy-4">
                {{-- Columna 1 --}}
                <div class="col-md-4">
                    <div class="site-footer-title">
                        ISLA TRANSFERS
                    </div>
                    <p class="site-footer-text mb-0">
                        Traslados aeropuerto ↔ hotel en la isla,
                        con paneles para administradores, hoteles y viajeros.
                    </p>
                </div>

                {{-- Columna 2 --}}
                <div class="col-md-4">
                    <div class="site-footer-heading">
                        Navegación
                    </div>
                    <a href="{{ route('home') }}" class="site-footer-link">
                        <span>➜</span> Inicio
                    </a>
                    <a href="{{ route('login') }}" class="site-footer-link">
                        <span>➜</span> Reservar traslado
                    </a>
                    <a href="{{ route('login') }}" class="site-footer-link">
                        <span>➜</span> Acceder al panel
                    </a>
                </div>

                {{-- Columna 3 --}}
                <div class="col-md-4">
                    <div class="site-footer-heading">
                        En una frase
                    </div>
                    <p class="site-footer-highlights mb-0">
                        24/7 en la isla, precio cerrado y paneles
                        para hoteles y viajeros en una misma plataforma.
                    </p>
                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center site-footer-bottom mt-4">
                <span>© {{ date('Y') }} Isla Transfers. Todos los derechos reservados.</span>

            <div class="footer-socials">
                <a href="#" class="footer-social">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M22.675 0H1.325C.593 0 0 .593 0 1.325v21.351C0 23.406.593 24 1.325
                                24h11.495v-9.294H9.691V11.01h3.129V8.414c0-3.1 1.893-4.788
                                4.659-4.788 1.325 0 2.463.099 2.794.143v3.24l-1.918.001c-1.504
                                0-1.796.715-1.796 1.763v2.316h3.587l-.467 3.696h-3.12V24h6.116C23.406
                                24 24 23.406 24 22.676V1.325C24 .593 23.406 0 22.675 0z"/>
                    </svg>
                </a>

                <a href="#" class="footer-social">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M7.75 2h8.5A5.75 5.75 0 0 1 22 7.75v8.5A5.75 5.75 0 0 1 16.25
                                22h-8.5A5.75 5.75 0 0 1 2 16.25v-8.5A5.75 5.75 0 0 1 7.75
                                2zm0 1.5A4.25 4.25 0 0 0 3.5 7.75v8.5A4.25 4.25 0 0 0 7.75
                                20.5h8.5a4.25 4.25 0 0 0 4.25-4.25v-8.5A4.25 4.25 0 0 0 16.25
                                3.5h-8.5zM12 7a5 5 0 1 1 0 10a5 5 0 0 1 0-10zm0 1.5a3.5 3.5 0 1 0 0
                                7a3.5 3.5 0 0 0 0-7zm5.25-.25a1.25 1.25 0 1 1 0-2.5a1.25 1.25 0 0
                                1 0 2.5z"/>
                    </svg>
                </a>


               <a href="#" class="footer-social">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor"
                        viewBox="0 0 24 24">
                        <path d="M18.244 2H21L14.48 10.01L22 22h-6.56l-4.57-6.94L5.06
                                22H2l7.05-8.63L2 2h6.72l4.13 6.27L18.244 2zm-2.37
                                17.31h1.3L7.41 4.62H6.02l9.854 14.69z"/>
                    </svg>
                </a>

            </div>

            <div class="d-flex gap-3">
                <a href="#" class="small">Términos y condiciones</a>
                <a href="#" class="small">Política de privacidad</a>
            </div>
        </div>
    </footer>

@endsection
