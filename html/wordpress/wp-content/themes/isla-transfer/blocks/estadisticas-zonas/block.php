<?php
/**
 * Block Name: Estadisticas Zonas
 * Description: Muestra una tabla con datos traídos de la API de Laravel.
 */

// 1. URL de la API de Laravel.
// IMPORTANTE: Al estar en Docker Linux, "localhost" dentro de WordPress se refiere al propio contenedor de WordPress, no a tu PC.
// Para acceder a tu Laravel (que está en otro contenedor en el puerto 8080), usamos la IP del gateway de Docker (172.17.0.1) o tu IP local.
$api_url = 'http://172.17.0.1:8080/api/resumen-zonas'; 

// 2. Obtener datos
$response = wp_remote_get($api_url);

// 3. Verificar si hay error en la conexión
if (is_wp_error($response)) {
    // Si falla, mostramos un mensaje discreto (útil para depurar)
    echo '<div style="padding: 20px; border: 1px solid red; color: red;">';
    echo '<strong>Error de conexión con Laravel:</strong> ' . $response->get_error_message();
    echo '</div>';
    return;
}

// 4. Procesar el JSON
$body = wp_remote_retrieve_body($response);
$zonas = json_decode($body);

// Si no hay datos o el JSON está mal
if (empty($zonas) || !is_array($zonas)) {
    echo '<div style="padding: 20px; color: #666;">No hay datos estadísticos disponibles en este momento.</div>';
    return;
}
?>

<style>
    .isla-stats-widget {
        background: radial-gradient(circle at 50% -20%, #e0f2f1 0%, #f0fdfa 100%);
        border: 1px solid rgba(255, 255, 255, 0.6);
        border-radius: 1.25rem;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        padding: 2rem;
        max-width: 800px;
        margin: 2rem auto;
        font-family: sans-serif;
    }
    
    .isla-stats-header {
        text-align: center;
        margin-bottom: 1.5rem;
    }
    
    .isla-stats-header h3 {
        color: #0f766e; /* Teal corporativo */
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin: 0;
        font-size: 1.25rem;
    }

    .isla-table-wrapper {
        background: rgba(255, 255, 255, 0.95);
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0,0,0,0.03);
    }

    .isla-table {
        width: 100%;
        border-collapse: collapse;
        font-size: 0.95rem;
    }

    .isla-table th {
        background: linear-gradient(90deg, #0f9f9a, #0f766e);
        color: white;
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.75rem;
    }

    .isla-table td {
        padding: 1rem;
        border-bottom: 1px solid #f1f5f9;
        color: #334155;
    }

    .isla-table tr:last-child td {
        border-bottom: none;
    }

    .stat-number {
        font-weight: 700;
        color: #d97706; /* Gold corporativo */
    }
    
    .stat-percent {
        font-size: 0.85rem;
        color: #64748b;
        background: #f1f5f9;
        padding: 2px 8px;
        border-radius: 10px;
    }
</style>

<div class="isla-stats-widget">
    <div class="isla-stats-header">
        <h3>📊 Estadísticas de Operación</h3>
    </div>

    <div class="isla-table-wrapper">
        <table class="isla-table">
            <thead>
                <tr>
                    <th>Zona</th>
                    <th style="text-align: center;">Traslados</th>
                    <th style="text-align: right;">Cuota</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($zonas as $z): ?>
                    <tr>
                        <td>
                            <strong><?php echo esc_html($z->zona); ?></strong>
                        </td>
                        <td style="text-align: center;">
                            <span class="stat-number"><?php echo esc_html($z->num_traslados); ?></span>
                        </td>
                        <td style="text-align: right;">
                            <span class="stat-percent"><?php echo esc_html($z->porcentaje); ?>%</span>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    
    <div style="text-align: center; margin-top: 1rem; font-size: 0.75rem; color: #94a3b8;">
        Datos sincronizados en tiempo real con Isla Transfers API.
    </div>
</div>