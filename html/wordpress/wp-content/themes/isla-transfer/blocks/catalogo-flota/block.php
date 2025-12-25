<?php
/**
 * Block Name: Catálogo Flota
 * Description: Muestra la flota de vehículos con iconos SVG y diseño corporativo.
 */
?>

<style>
    /* Contenedor Principal */
    .fleet-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        padding: 2rem 0;
        max-width: 1200px;
        margin: 0 auto;
        font-family: 'Inter', system-ui, sans-serif;
    }

    /* Tarjeta del Vehículo */
    .fleet-card {
        background: #ffffff;
        border: 1px solid rgba(15, 159, 154, 0.2);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .fleet-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(15, 159, 154, 0.15);
    }

    /* Imagen */
    .fleet-image {
        width: 100%;
        height: 240px;
        object-fit: cover;
        background-color: #f1f5f9;
        border-bottom: 4px solid #0f9f9a; /* Línea Teal */
    }

    /* Contenido */
    .fleet-content {
        padding: 1.75rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .fleet-title {
        color: #0f766e; /* Teal oscuro */
        font-size: 1.5rem;
        font-weight: 800;
        margin: 0 0 0.5rem 0;
        text-transform: uppercase;
        letter-spacing: -0.02em;
    }

    .fleet-category {
        display: inline-block;
        background-color: #f0fdfa;
        color: #0f9f9a;
        font-size: 0.75rem;
        font-weight: 700;
        padding: 0.35rem 0.85rem;
        border-radius: 20px;
        margin-bottom: 1rem;
        align-self: flex-start;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .fleet-desc {
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.6;
        margin-bottom: 2rem;
    }

    /* Iconos y Características (SVG) */
    .fleet-specs {
        display: flex;
        gap: 1.25rem;
        margin-top: auto;
        padding-top: 1.25rem;
        border-top: 1px solid #e2e8f0;
    }

    .spec-item {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: #475569;
        font-weight: 600;
    }

    .spec-icon-svg {
        width: 20px;
        height: 20px;
        color: #d97706; /* Dorado Corporativo */
    }
    
    .btn-reserve {
        display: block;
        width: 100%;
        text-align: center;
        background: linear-gradient(90deg, #0f9f9a, #0f766e);
        color: white;
        text-decoration: none;
        padding: 1rem;
        border-radius: 0.5rem;
        font-weight: 700;
        margin-top: 1.5rem;
        transition: opacity 0.2s;
        text-transform: uppercase;
        font-size: 0.9rem;
        letter-spacing: 0.05em;
    }
    .btn-reserve:hover {
        opacity: 0.9;
        color: white;
    }
</style>

<div class="fleet-grid">

    <div class="fleet-card">
        <img src="https://images.unsplash.com/photo-1550355291-bbee04a92027?auto=format&fit=crop&q=80&w=600" alt="Sedán Estándar" class="fleet-image">
        <div class="fleet-content">
            <span class="fleet-category">Económico / Estándar</span>
            <h3 class="fleet-title">Sedán Confort</h3>
            <p class="fleet-desc">
                Ideal para parejas o viajeros de negocios. Vehículo moderno, discreto y con el máximo confort para traslados rápidos por la isla.
            </p>
            <div class="fleet-specs">
                <div class="spec-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="spec-icon-svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                    4 Pax
                </div>
                <div class="spec-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="spec-icon-svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zm1 2h6V3H7v1zm9 11a1 1 0 01-1 1H4a1 1 0 01-1-1V6h14v9z" clip-rule="evenodd" />
                    </svg>
                    2 Maletas
                </div>
                <div class="spec-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="spec-icon-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    </svg>
                    A/C
                </div>
            </div>
            <a href="http://localhost:8080" class="btn-reserve">Reservar Ahora</a>
        </div>
    </div>

    <div class="fleet-card">
        <img src="https://images.unsplash.com/photo-1617788138017-80ad40651399?auto=format&fit=crop&q=80&w=600" alt="Minivan Familiar" class="fleet-image">
        <div class="fleet-content">
            <span class="fleet-category">Familia / Grupos</span>
            <h3 class="fleet-title">Minivan Premium</h3>
            <p class="fleet-desc">
                Espacio extra para toda la familia y su equipaje. Viaja con total comodidad sin preocuparte por el espacio.
            </p>
            <div class="fleet-specs">
                <div class="spec-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="spec-icon-svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                    </svg>
                    7 Pax
                </div>
                <div class="spec-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="spec-icon-svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zm1 2h6V3H7v1zm9 11a1 1 0 01-1 1H4a1 1 0 01-1-1V6h14v9z" clip-rule="evenodd" />
                    </svg>
                    5 Maletas
                </div>
                <div class="spec-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="spec-icon-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 3v2.25m6.364.386l-1.591 1.591M21 12h-2.25m-.386 6.364l-1.591-1.591M12 18.75V21m-4.773-4.227l-1.591 1.591M5.25 12H3m4.227-4.773L5.636 5.636M15.75 12a3.75 3.75 0 11-7.5 0 3.75 3.75 0 017.5 0z" />
                    </svg>
                    Clima
                </div>
            </div>
            <a href="http://localhost:8080" class="btn-reserve">Reservar Ahora</a>
        </div>
    </div>

    <div class="fleet-card">
        <img src="https://images.unsplash.com/photo-1544620347-c4fd4a3d5957?auto=format&fit=crop&q=80&w=600" alt="Minibús" class="fleet-image">
        <div class="fleet-content">
            <span class="fleet-category">Grandes Grupos</span>
            <h3 class="fleet-title">Minibús Ejecutivo</h3>
            <p class="fleet-desc">
                La solución perfecta para eventos, excursiones o grupos grandes. Asientos reclinables y amplio maletero.
            </p>
            <div class="fleet-specs">
                <div class="spec-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="spec-icon-svg" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                    </svg>
                    12-16 Pax
                </div>
                <div class="spec-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="spec-icon-svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 00-1-1H6zm1 2h6V3H7v1zm9 11a1 1 0 01-1 1H4a1 1 0 01-1-1V6h14v9z" clip-rule="evenodd" />
                    </svg>
                    10+ Maletas
                </div>
                <div class="spec-item">
                    <svg xmlns="http://www.w3.org/2000/svg" class="spec-icon-svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M17.778 8.222c-4.296-4.296-11.26-4.296-15.556 0A1 1 0 01.808 6.808c5.076-5.077 13.308-5.077 18.384 0a1 1 0 01-1.414 1.414zM14.95 11.05a7 7 0 00-9.9 0 1 1 0 01-1.414-1.414 9 9 0 0112.728 0 1 1 0 01-1.414 1.414zM12.12 13.88a3 3 0 00-4.242 0 1 1 0 01-1.415-1.415 5 5 0 017.072 0 1 1 0 01-1.415 1.415zM9 16a1 1 0 011-1h.01a1 1 0 110 2H10a1 1 0 01-1-1z" clip-rule="evenodd" />
                    </svg>
                    WiFi
                </div>
            </div>
            <a href="http://localhost:8080" class="btn-reserve">Reservar Ahora</a>
        </div>
    </div>

</div>