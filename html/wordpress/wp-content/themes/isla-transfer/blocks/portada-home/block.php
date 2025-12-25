<?php
/**
 * Block Name: Portada Home
 * Description: Hero section a pantalla completa sin etiqueta.
 */
?>

<style>
    /* --- ESTILOS GENERALES --- */
    body {
        margin: 0;
        padding: 0;
        overflow-x: hidden; /* Evita scroll horizontal si forzamos el ancho */
    }

    .home-container {
        font-family: 'Inter', system-ui, sans-serif;
        color: #334155;
        /* TRUCO PARA ANCHO COMPLETO: */
        width: 100vw; 
        position: relative;
        left: 50%;
        right: 50%;
        margin-left: -50vw;
        margin-right: -50vw;
    }

    /* --- HERO SECTION (FONDO) --- */
    .hero-section {
        position: relative;
        /* Imagen de fondo */
        background-image: url('https://images.unsplash.com/photo-1469854523086-cc02fe5d8800?q=80&w=2021&auto=format&fit=crop'); 
        background-size: cover; /* Esto hace que la imagen cubra todo */
        background-position: center;
        height: 90vh; /* Ocupa el 90% de la altura de la pantalla */
        min-height: 600px;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        padding: 0 1rem;
    }

    /* Capa oscura (Overlay) */
    .hero-overlay {
        position: absolute;
        top: 0; left: 0; right: 0; bottom: 0;
        background: linear-gradient(180deg, rgba(15, 23, 42, 0.3) 0%, rgba(15, 23, 42, 0.6) 100%);
        z-index: 1;
    }

    .hero-content {
        position: relative;
        z-index: 2;
        max-width: 900px;
        animation: fadeInUp 1s ease-out;
    }

    /* Título Grande */
    .hero-title {
        font-size: 4rem; /* Más grande e impactante */
        font-weight: 800;
        line-height: 1.1;
        margin-bottom: 1.5rem;
        text-shadow: 0 4px 15px rgba(0,0,0,0.4);
    }

    .hero-subtitle {
        font-size: 1.35rem;
        font-weight: 400;
        margin-bottom: 3rem;
        opacity: 0.95;
        max-width: 700px;
        margin-left: auto;
        margin-right: auto;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
    }

    /* Botón CTA Principal */
    .btn-hero {
        background: #d97706; /* Dorado */
        color: white;
        padding: 1.2rem 3.5rem;
        font-size: 1.1rem;
        font-weight: 700;
        text-decoration: none;
        border-radius: 50px; /* Botón redondeado moderno */
        transition: all 0.3s ease;
        display: inline-block;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        box-shadow: 0 10px 25px rgba(217, 119, 6, 0.4);
        border: 2px solid transparent;
    }

    .btn-hero:hover {
        background: transparent;
        border-color: #d97706;
        color: #d97706;
        background-color: rgba(255,255,255,0.1);
        transform: translateY(-3px);
    }

    /* --- FEATURES SECTION (BENEFICIOS) --- */
    /* Para que los beneficios no se peguen a los bordes de la pantalla, los centramos */
    .features-wrapper {
        background: white;
        width: 100%;
        display: flex;
        justify-content: center;
    }

    .features-section {
        padding: 5rem 1rem;
        max-width: 1200px; /* Contenido centrado */
        width: 100%;
    }

    .features-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 3rem;
    }

    .feature-item { text-align: left; padding: 1rem; }

    .feature-icon-box {
        width: 60px; height: 60px;
        background: #f0fdfa; border-radius: 12px;
        display: flex; align-items: center; justify-content: center;
        margin-bottom: 1.5rem; color: #0f9f9a;
    }

    .feature-svg { width: 30px; height: 30px; }
    .feature-title { font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem; color: #0f172a; }
    .feature-text { color: #64748b; line-height: 1.6; }

    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>

<div class="home-container">

    <div class="hero-section">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1 class="hero-title">Tu destino empieza<br>con el mejor viaje</h1>
            <p class="hero-subtitle">
                Servicio de transporte privado líder en la isla. Sin colas, sin sorpresas y con la máxima comodidad.
            </p>
            
            <a href="http://localhost:8080" class="btn-hero">Reservar Traslado</a>
        </div>
    </div>

    <div class="features-wrapper">
        <div class="features-section">
            <div class="features-grid">
                
                <div class="feature-item">
                    <div class="feature-icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" class="feature-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="feature-title">Puntualidad</h3>
                    <p class="feature-text">Monitorizamos tu vuelo. Si se retrasa, te esperamos sin coste.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" class="feature-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z" />
                        </svg>
                    </div>
                    <h3 class="feature-title">Precio Cerrado</h3>
                    <p class="feature-text">Tarifas claras. Sin taxímetros ni suplementos ocultos.</p>
                </div>

                <div class="feature-item">
                    <div class="feature-icon-box">
                        <svg xmlns="http://www.w3.org/2000/svg" class="feature-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <h3 class="feature-title">Atención 24/7</h3>
                    <p class="feature-text">Soporte disponible a cualquier hora para gestionar cambios.</p>
                </div>

            </div>
        </div>
    </div>

</div>