<?php
/**
 * Template Name: Dashboard
 *
 * Plantilla especializada para panel de usuario con sidebar lateral.
 *
 * @package NovaUI
 */

get_header();
?>

<div class="dashboard-layout">
    <?php get_template_part('template-parts/sidebar', 'dashboard'); ?>
    
    <div class="dashboard-main">
        <header class="dashboard-header">
            <div class="dashboard-header-left">
                <button class="dashboard-toggle-sidebar" aria-label="<?php esc_attr_e('Toggle sidebar', 'novaui'); ?>">
                    <span class="dashicon dashicons dashicons-menu-alt"></span>
                </button>
                
                <div class="dashboard-search">
                    <span class="dashboard-search-icon">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="8"></circle>
                            <path d="M21 21l-4.35-4.35"></path>
                        </svg>
                    </span>
                    <input type="text" placeholder="<?php esc_attr_e('Search...', 'novaui'); ?>" aria-label="<?php esc_attr_e('Search', 'novaui'); ?>">
                    <span class="dashboard-search-shortcut">⌘K</span>
                </div>
            </div>
            
            <div class="dashboard-header-right">
                <button class="dashboard-action-btn" aria-label="<?php esc_attr_e('Notifications', 'novaui'); ?>">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
                        <path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
                    </svg>
                </button>
                
                <button id="theme-toggle" class="dashboard-action-btn theme-toggle" aria-label="<?php esc_attr_e('Toggle dark mode', 'novaui'); ?>">
                    <span class="theme-toggle-light">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="5"></circle>
                            <line x1="12" y1="1" x2="12" y2="3"></line>
                            <line x1="12" y1="21" x2="12" y2="23"></line>
                            <line x1="4.22" y1="4.22" x2="5.64" y2="5.64"></line>
                            <line x1="18.36" y1="18.36" x2="19.78" y2="19.78"></line>
                            <line x1="1" y1="12" x2="3" y2="12"></line>
                            <line x1="21" y1="12" x2="23" y2="12"></line>
                            <line x1="4.22" y1="19.78" x2="5.64" y2="18.36"></line>
                            <line x1="18.36" y1="5.64" x2="19.78" y2="4.22"></line>
                        </svg>
                    </span>
                    <span class="theme-toggle-dark">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                    </span>
                </button>
                
                <div class="dashboard-user">
                    <div class="dashboard-user-avatar">
                        <?php 
                        $current_user = wp_get_current_user();
                        echo esc_html(substr($current_user->display_name, 0, 1));
                        ?>
                    </div>
                    
                    <div class="dashboard-user-info">
                        <div class="dashboard-user-name">
                            <?php echo esc_html($current_user->display_name); ?>
                            <span class="dashboard-user-dropdown">
                                <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <polyline points="6 9 12 15 18 9"></polyline>
                                </svg>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        
        <main class="dashboard-content">
            <?php
            // Page title and actions
            ?>
            <div class="dashboard-page-header">
                <h1 class="dashboard-page-title"><?php the_title(); ?></h1>
                
                <div class="dashboard-page-actions">
                    <?php 
                    // Hook para que los plugins puedan añadir acciones en la cabecera de página
                    do_action('novaui_dashboard_page_actions'); 
                    ?>
                    
                    <button class="button outline">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                            <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path>
                            <polyline points="7 10 12 15 17 10"></polyline>
                            <line x1="12" y1="15" x2="12" y2="3"></line>
                        </svg>
                        <?php esc_html_e('Export', 'novaui'); ?>
                    </button>
                    
                    <button class="button primary">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-2">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        <?php esc_html_e('New Report', 'novaui'); ?>
                    </button>
                </div>
            </div>
            
            <?php
            while (have_posts()) :
                the_post();
                
                // El contenido de la página
                the_content();
                
                // Si hay comentarios, mostrarlos
                if (comments_open() || get_comments_number()) :
                    comments_template();
                endif;
                
            endwhile;
            ?>
        </main>
    </div>
</div>

<?php
// No incluir footer normal en el dashboard
wp_footer();
?>
</body>
</html>
