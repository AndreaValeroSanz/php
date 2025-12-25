<?php
/**
 * Block Name: Grid Noticias
 * Description: Muestra las últimas 3 noticias del blog automáticamente.
 */

// Obtener los últimos 3 posts publicados
$latest_posts = get_posts([
    'numberposts' => 3,
    'post_status' => 'publish',
]);
?>

<style>
    .news-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 2rem;
        padding: 2rem 0;
        max-width: 1200px;
        margin: 0 auto;
        font-family: 'Inter', sans-serif;
    }

    .news-card {
        background: white;
        border: 1px solid #e2e8f0;
        border-radius: 1rem;
        overflow: hidden;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .news-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.08);
        border-color: #0f9f9a;
    }

    .news-image {
        height: 200px;
        width: 100%;
        object-fit: cover;
        background: #f1f5f9;
    }

    .news-content {
        padding: 1.5rem;
        flex-grow: 1;
        display: flex;
        flex-direction: column;
    }

    .news-date {
        font-size: 0.75rem;
        color: #d97706; /* Dorado */
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .news-title {
        font-size: 1.25rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 1rem 0;
        line-height: 1.4;
    }

    .news-excerpt {
        color: #64748b;
        font-size: 0.95rem;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .read-more {
        margin-top: auto;
        text-decoration: none;
        color: #0f9f9a;
        font-weight: 600;
        font-size: 0.9rem;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }
    .read-more:hover { text-decoration: underline; }

    /* Mensaje vacío */
    .no-posts {
        text-align: center;
        padding: 3rem;
        background: #f8fafc;
        border-radius: 1rem;
        color: #64748b;
        grid-column: 1 / -1;
    }
</style>

<div class="news-grid">
    <?php if (empty($latest_posts)) : ?>
        <div class="no-posts">
            <h3>Todavía no hay noticias</h3>
            <p>Vuelve pronto para leer nuestras novedades.</p>
        </div>
    <?php else : ?>
        
        <?php foreach ($latest_posts as $post) : setup_postdata($post); ?>
            <article class="news-card">
                <?php if (has_post_thumbnail($post->ID)) : ?>
                    <img src="<?php echo get_the_post_thumbnail_url($post->ID, 'medium_large'); ?>" alt="<?php echo esc_attr($post->post_title); ?>" class="news-image">
                <?php else : ?>
                    <img src="https://images.unsplash.com/photo-1449965408869-eaa3f722e40d?auto=format&fit=crop&q=80&w=600" class="news-image" alt="Noticia">
                <?php endif; ?>

                <div class="news-content">
                    <div class="news-date">
                        <?php echo get_the_date('d M Y', $post->ID); ?>
                    </div>
                    
                    <h3 class="news-title">
                        <a href="<?php echo get_permalink($post->ID); ?>" style="text-decoration:none; color:inherit;">
                            <?php echo esc_html($post->post_title); ?>
                        </a>
                    </h3>

                    <div class="news-excerpt">
                        <?php echo wp_trim_words(get_the_excerpt($post->ID), 20, '...'); ?>
                    </div>

                    <a href="<?php echo get_permalink($post->ID); ?>" class="read-more">
                        Leer artículo →
                    </a>
                </div>
            </article>
        <?php endforeach; wp_reset_postdata(); ?>

    <?php endif; ?>
</div>