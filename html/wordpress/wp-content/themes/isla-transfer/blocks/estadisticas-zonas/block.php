<?php
/**
 * Block Name: Estadisticas Zonas
 * Description: Widget conectado a la API de Laravel (Isla Transfers).
 */

$api_url = 'http://172.17.0.1:8080/public/api/resumen-zonas'; 

$response = wp_remote_get($api_url);

if (is_wp_error($response)) {
    echo '<div style="color: red; padding: 20px; border: 1px solid red;">Error API: ' . $response->get_error_message() . '</div>';
    return;
}

$body = wp_remote_retrieve_body($response);
$data = json_decode($body);

$total_traslados = isset($data->total_traslados) ? $data->total_traslados : 0;
$lista_zonas     = isset($data->resumen_por_zona) ? $data->resumen_por_zona : [];

if (empty($lista_zonas)) {
    echo '<div style="padding: 20px;">No hay datos de zonas disponibles.</div>';
    return;
}
?>

<style>
    .isla-widget {
        background: radial-gradient(circle at 50% -20%, #e0f2f1 0%, #f0fdfa 100%);
        border: 1px solid rgba(255,255,255,0.6);
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(15, 23, 42, 0.05);
        padding: 2rem;
        font-family: sans-serif;
        max-width: 800px;
        margin: 2rem auto;
    }
    .isla-header { text-align: center; margin-bottom: 1.5rem; }
    .isla-header h3 { color: #0f766e; font-weight: 700; text-transform: uppercase; margin: 0; }
    .isla-total-badge {
        display: inline-block;
        background: #0f9f9a;
        color: white;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.8rem;
        margin-top: 0.5rem;
    }
    .isla-table { width: 100%; border-collapse: collapse; background: white; border-radius: 1rem; overflow: hidden; }
    .isla-table th { background: linear-gradient(90deg, #0f9f9a, #0f766e); color: white; padding: 1rem; text-align: left; }
    .isla-table td { padding: 1rem; border-bottom: 1px solid #f1f5f9; color: #334155; }
    .text-gold { color: #d97706; font-weight: 700; }
    .text-center { text-align: center; }
    .text-right { text-align: right; }
</style>

<div class="isla-widget">
    <div class="isla-header">
        <h3>Actividad por Zonas</h3>
        <span class="isla-total-badge">Total Global: <?php echo $total_traslados; ?> traslados</span>
    </div>

    <table class="isla-table">
        <thead>
            <tr>
                <th>Zona</th>
                <th class="text-center">Traslados</th>
                <th class="text-right">% Cuota</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lista_zonas as $z): ?>
                <tr>
                    <td><strong><?php echo esc_html($z->zona); ?></strong></td>
                    <td class="text-center text-gold">
                        <?php echo esc_html($z->num_traslados); ?>
                    </td>
                    <td class="text-right">
                        <?php echo esc_html($z->porcentaje); ?>%
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
    <div style="text-align: center; font-size: 0.7rem; color: #999; margin-top: 10px;">
        Datos en tiempo real API Laravel
    </div>
</div>