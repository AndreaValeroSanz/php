<?php
/**
 * Block Name: Header Corporativo
 * Description: Cabecera oscura, ancho completo y sin PHP complejo para evitar errores.
 */
?>

<style>
    /* Estilos del Header */
    .site-header-wrapper {
        background: linear-gradient(90deg, #0f172a 0%, #1e293b 100%);
        width: 100vw; /* Forzar ancho de pantalla completo */
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
        box-shadow: 0 4px 20px rgba(0,0,0,0.3);
        z-index: 999;
    }

    .header-inner {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1rem 2rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }

    /* LOGO */
    .header-brand {
        display: flex;
        align-items: center;
        text-decoration: none;
        gap: 10px;
    }
    
    .brand-text {
        font-family: 'Inter', system-ui, sans-serif;
        font-size: 1.5rem;
        font-weight: 800;
        color: white;
        text-transform: uppercase;
        letter-spacing: -0.02em;
        line-height: 1;
    }
    .brand-text span { color: #0f9f9a; }

    /* MENU */
    .header-nav ul {
        list-style: none;
        margin: 0;
        padding: 0;
        display: flex;
        gap: 2rem;
        align-items: center;
    }

    .header-nav a {
        text-decoration: none;
        color: #94a3b8;
        font-family: system-ui, sans-serif;
        font-weight: 600;
        font-size: 0.95rem;
        transition: color 0.3s ease;
    }

    .header-nav a:hover {
        color: #d97706; /* Dorado al pasar el ratón */
    }

    /* BOTÓN AREA CLIENTE */
    .btn-login {
        background: rgba(15, 159, 154, 0.1);
        color: #0f9f9a !important;
        padding: 0.6rem 1.4rem !important;
        border-radius: 50px;
        border: 1px solid rgba(15, 159, 154, 0.4);
        transition: all 0.3s ease;
    }
    .btn-login:hover {
        background: #0f9f9a;
        color: white !important;
        transform: translateY(-2px);
    }

    /* Móvil */
    @media (max-width: 768px) {
        .header-inner { flex-direction: column; gap: 1rem; text-align: center; }
        .header-nav ul { flex-direction: column; gap: 1rem; }
    }
</style>

<div class="site-header-wrapper">
    <div class="header-inner">
        <a href="/wordpress/" class="header-brand">
            <svg width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="#0f9f9a" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M12 2L2 7l10 5 10-5-10-5zM2 17l10 5 10-5M2 12l10 5 10-5"/>
            </svg>
            <div class="brand-text">Isla<span>Transfers</span></div>
        </a>

        <nav class="header-nav">
            <ul>
                <li><a href="/wordpress/">Inicio</a></li>
                <li><a href="/wordpress/nuestra-flota/">Flota</a></li>
                <li><a href="/wordpress/nuestros-servicios/">Servicios</a></li>
                <li><a href="/wordpress/noticias/">Noticias</a></li>
                
                <li><a href="http://localhost:8080" class="btn-login">Acceso Cliente</a></li>
            </ul>
        </nav>
    </div>
</div>