<?php
/**
 * Block Name: Estadisticas Zonas + Servicios
 * Description: Página completa de servicios con iconos SVG y widget conectado a Laravel.
 */

// --- 1. LÓGICA PHP (TU API) ---
// Recuerda: Si estás en Docker, usamos la IP interna + /public
$api_url = 'https://fp064.techlab.uoc.edu/~uocx1/producto3/api/resumen-zonas';

$response = wp_remote_get($api_url);
$error_api = false;
$lista_zonas = [];
$total_traslados = 0;

if (is_wp_error($response)) {
    $error_api = true;
    $error_msg = $response->get_error_message();
} else {
    $body = wp_remote_retrieve_body($response);
    $data = json_decode($body);
    
    $total_traslados = isset($data->total_traslados) ? $data->total_traslados : 0;
    $lista_zonas     = isset($data->resumen_por_zona) ? $data->resumen_por_zona : [];
}
?>

<style>
    /* Contenedor General */
    .services-page-container {
        font-family: 'Inter', system-ui, sans-serif;
        color: #334155;
        max-width: 1200px;
        margin: 0 auto;
        padding: 2rem 1rem;
    }

    /* Sección Hero */
    .services-hero {
        text-align: center;
        margin-bottom: 4rem;
    }
    .services-hero h2 {
        color: #0f766e;
        font-size: 2.5rem;
        font-weight: 800;
        margin-bottom: 1rem;
        letter-spacing: -0.02em;
    }
    .services-hero p {
        font-size: 1.1rem;
        color: #64748b;
        max-width: 600px;
        margin: 0 auto;
        line-height: 1.6;
    }

    /* Grid de Tarjetas */
    .services-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        margin-bottom: 5rem;
    }

    .service-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 1.5rem;
        padding: 2.5rem 2rem;
        transition: all 0.3s ease;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    
    .service-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px rgba(15, 159, 154, 0.12);
        border-color: #0f9f9a;
    }

    /* ICONOS SVG */
    .service-icon-wrapper {
        width: 80px;
        height: 80px;
        margin: 0 auto 1.5rem auto;
        background: #f0fdfa; /* Fondo muy suave Teal */
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0f9f9a; /* Color del icono */
    }

    .service-icon-svg {
        width: 40px;
        height: 40px;
        stroke-width: 1.5;
    }

    .service-title {
        font-weight: 700;
        font-size: 1.35rem;
        margin-bottom: 0.75rem;
        color: #0f172a;
    }
    
    .service-desc {
        color: #64748b;
        font-size: 0.95rem;
        line-height: 1.6;
    }

    /* Widget de Estadísticas */
    .isla-widget {
        background: linear-gradient(135deg, #f0fdfa 0%, #e0f2f1 100%);
        border: 1px solid rgba(255,255,255,0.8);
        border-radius: 2rem;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        padding: 3rem 2rem;
        margin-top: 3rem;
        position: relative;
    }
    
    .isla-header { text-align: center; margin-bottom: 2rem; }
    .isla-header h3 { color: #0f766e; font-weight: 800; text-transform: uppercase; margin: 0; font-size: 1.25rem; letter-spacing: 0.05em; }
    .isla-header p { color: #64748b; margin-top: 0.5rem; font-size: 0.95rem; }
    
    .isla-total-badge {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: #0f9f9a;
        color: white;
        padding: 8px 20px;
        border-radius: 30px;
        font-size: 0.9rem;
        margin-top: 1.5rem;
        font-weight: 600;
        box-shadow: 0 4px 12px rgba(15, 159, 154, 0.3);
    }

    .isla-table-wrapper {
        background: white;
        border-radius: 1.25rem;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.03);
        max-width: 800px;
        margin: 0 auto;
        border: 1px solid #f1f5f9;
    }

    .isla-table { width: 100%; border-collapse: collapse; }
    .isla-table th { background: #0f766e; color: white; padding: 1.25rem; text-align: left; font-size: 0.85rem; text-transform: uppercase; letter-spacing: 0.05em; font-weight: 600; }
    .isla-table td { padding: 1.25rem; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .isla-table tr:last-child td { border-bottom: none; }
    .isla-table tr:hover td { background-color: #f8fafc; }
    
    .text-gold { color: #d97706; font-weight: 800; font-size: 1.1rem; }
    .text-center { text-align: center; }
    .text-right { text-align: right; }
    
    .live-dot { width: 8px; height: 8px; background: #22c55e; border-radius: 50%; display: inline-block; }
</style>

<div class="services-page-container">

    <div class="services-hero">
        <h2>Servicios de Clase Mundial</h2>
        <p>
            Conectamos cada rincón de la isla con una flota moderna y un servicio impecable. 
            Tu tranquilidad es nuestro destino.
        </p>
    </div>

    <div class="services-grid">
        
        <div class="service-card">
            <div class="service-icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" class="service-icon-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <h3 class="service-title">Conexión Global</h3>
            <p class="service-desc">
                Servicio puerta a puerta desde y hacia el aeropuerto. Monitorizamos tu vuelo para estar ahí cuando aterrices, sin esperas.
            </p>
        </div>

        <div class="service-card">
            <div class="service-icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" class="service-icon-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09zM18.259 8.715L18 9.75l-.259-1.035a3.375 3.375 0 00-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 002.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 002.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 00-2.456 2.456zM16.894 20.567L16.5 21.75l-.394-1.183a2.25 2.25 0 00-1.423-1.423L13.5 18.75l1.183-.394a2.25 2.25 0 001.423-1.423l.394-1.183.394 1.183a2.25 2.25 0 001.423 1.423l1.183.394-1.183.394a2.25 2.25 0 00-1.423 1.423z" />
                </svg>
            </div>
            <h3 class="service-title">Experiencia VIP</h3>
            <p class="service-desc">
                Viaja con la máxima discreción y lujo. Vehículos de alta gama, chóferes privados y atención personalizada 24/7.
            </p>
        </div>

        <div class="service-card">
            <div class="service-icon-wrapper">
                <svg xmlns="http://www.w3.org/2000/svg" class="service-icon-svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                </svg>
            </div>
            <h3 class="service-title">Flexibilidad Total</h3>
            <p class="service-desc">
                ¿Cambios de última hora? Nuestra plataforma permite gestionar tus reservas al instante. Tú decides el destino, nosotros el camino.
            </p>
        </div>
    </div>

    <div class="isla-widget">
        <div class="isla-header">
            <h3>Cobertura Operativa</h3>
            <p>Datos de traslados en tiempo real sincronizados con nuestro sistema central.</p>
            
            <?php if (!$error_api): ?>
                <span class="isla-total-badge">
                    <span class="live-dot"></span>
                    <?php echo $total_traslados; ?> Traslados Gestionados
                </span>
            <?php endif; ?>
        </div>

        <div class="isla-table-wrapper">
            <?php if ($error_api): ?>
                <div style="padding: 2rem; text-align: center; color: #ef4444; background: white;">
                    ⚠️ No se pudo conectar con el sistema de reservas. <br>
                    <small><?php echo esc_html($error_msg); ?></small>
                </div>
            <?php elseif (empty($lista_zonas)): ?>
                <div style="padding: 2rem; text-align: center; color: #64748b; background: white;">
                    No hay actividad reciente registrada.
                </div>
            <?php else: ?>
                <table class="isla-table">
                    <thead>
                        <tr>
                            <th>Zona</th>
                            <th class="text-center">Volumen</th>
                            <th class="text-right">Cuota (%)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista_zonas as $z): ?>
                            <tr>
                                <td><strong><?php echo esc_html($z->zona); ?></strong></td>
                                <td class="text-center text-gold"><?php echo esc_html($z->num_traslados); ?></td>
                                <td class="text-right"><?php echo esc_html($z->porcentaje); ?>%</td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php endif; ?>
        </div>
        
        <div style="text-align: center; font-size: 0.7rem; color: #64748b; margin-top: 1rem; opacity: 0.7;">
            Isla Transfers API v1.0 • Conexión segura
        </div>
    </div>
</div>