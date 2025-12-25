<?php
/**
 * Block Name: Footer Corporativo
 * Description: Pie de página oscuro con 3 columnas.
 */
?>

<style>
    .site-footer {
        background: linear-gradient(180deg, #1e293b 0%, #0f172a 100%); /* Fondo Oscuro Profundo */
        color: #94a3b8;
        padding-top: 4rem;
        font-family: 'Inter', system-ui, sans-serif;
        font-size: 0.95rem;
        margin-top: auto; /* Empuja el footer abajo si hay poco contenido */
    }

    .footer-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 2rem;
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 3rem;
        padding-bottom: 3rem;
        border-bottom: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* COLUMNA 1: MARCA */
    .footer-brand h3 {
        color: white;
        font-size: 1.5rem;
        font-weight: 800;
        margin-top: 0;
        margin-bottom: 1rem;
        text-transform: uppercase;
    }
    .footer-brand h3 span { color: #0f9f9a; }
    
    .footer-desc {
        line-height: 1.6;
        margin-bottom: 1.5rem;
        max-width: 300px;
    }

    /* COLUMNA 2: ENLACES */
    .footer-title {
        color: white;
        font-size: 1.1rem;
        font-weight: 700;
        margin-top: 0;
        margin-bottom: 1.5rem;
    }

    .footer-links {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    .footer-links li { margin-bottom: 0.8rem; }
    
    .footer-links a {
        color: #94a3b8;
        text-decoration: none;
        transition: color 0.2s;
    }
    .footer-links a:hover { color: #d97706; /* Dorado */ }

    /* COLUMNA 3: CONTACTO */
    .contact-item {
        display: flex;
        gap: 10px;
        align-items: flex-start;
        margin-bottom: 1rem;
    }
    .contact-icon { color: #0f9f9a; font-weight: bold; }

    /* COPYRIGHT BAR */
    .footer-bottom {
        padding: 1.5rem 2rem;
        text-align: center;
        font-size: 0.85rem;
        background: rgba(0, 0, 0, 0.2);
    }
    .footer-bottom p { margin: 0; }
</style>

<footer class="site-footer">
    <div class="footer-container">
        
        <div class="footer-brand">
            <h3>Isla<span>Transfers</span></h3>
            <p class="footer-desc">
                La empresa líder en transporte privado de la isla. Conectamos destinos con puntualidad, confort y seguridad.
            </p>
        </div>

        <div>
            <h4 class="footer-title">Enlaces Rápidos</h4>
            <ul class="footer-links">
                <li><a href="/wordpress/">Inicio</a></li>
                <li><a href="/wordpress/nuestra-flota/">Nuestra Flota</a></li>
                <li><a href="/wordpress/nuestros-servicios/">Servicios</a></li>
                <li><a href="/wordpress/noticias/">Blog & Noticias</a></li>
            </ul>
        </div>

        <div>
            <h4 class="footer-title">Contacto</h4>
            <div class="contact-item">
                <span class="contact-icon">📍</span>
                <span>Aeropuerto Principal, Oficina 24<br>Terminal de Llegadas</span>
            </div>
            <div class="contact-item">
                <span class="contact-icon">📞</span>
                <span>+34 900 123 456</span>
            </div>
            <div class="contact-item">
                <span class="contact-icon">✉️</span>
                <span>reservas@islatransfers.com</span>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <p>&copy; <?php echo date("Y"); ?> Isla Transfers Corp. Todos los derechos reservados.</p>
    </div>
</footer>