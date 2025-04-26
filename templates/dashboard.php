<?php
/**
 * Template Name: Dashboard
 *
 * Template para páginas de dashboard de usuario. Incluye layout especializado
 * con sidebar lateral colapsable y estructura de panel de control.
 *
 * @package NovaUI
 */

// Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
if ( ! is_user_logged_in() ) {
    wp_redirect( wp_login_url( get_permalink() ) );
    exit;
}

// Obtener información del usuario actual
$current_user = wp_get_current_user();
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class('saas-dashboard-template'); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'nova-ui' ); ?></a>

    <div class="dashboard-layout">
        <!-- Sidebar del Dashboard -->
        <div class="dashboard-sidebar <?php echo get_theme_mod( 'nova_ui_collapse_sidebar', false ) ? 'collapsed' : ''; ?>">
            <div class="dashboard-sidebar-header">
                <div class="dashboard-logo">
                    <?php
                    if ( has_custom_logo() ) {
                        // Si hay un logo personalizado, lo mostramos
                        $custom_logo_id = get_theme_mod( 'custom_logo' );
                        $logo = wp_get_attachment_image_src( $custom_logo_id, 'full' );
                        ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="dashboard-logo-full">
                            <img src="<?php echo esc_url( $logo[0] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                        </a>
                        <?php
                    } else {
                        // Si no hay logo personalizado, mostramos el nombre del sitio con el ícono
                        ?>
                        <div class="dashboard-logo-icon">
                            <?php echo nova_ui_get_svg_icon( 'gamepad-2', 'md' ); ?>
                        </div>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="dashboard-logo-full">
                            Nova<span style="color: var(--color-primary);">UI</span>
                        </a>
                        <?php
                    }
                    ?>
                </div>
                <button class="sidebar-toggle" aria-expanded="<?php echo get_theme_mod( 'nova_ui_collapse_sidebar', false ) ? 'false' : 'true'; ?>" aria-label="<?php esc_attr_e( 'Toggle Sidebar', 'nova-ui' ); ?>">
                    <?php echo nova_ui_get_svg_icon( 'menu', 'sm' ); ?>
                </button>
            </div>

            <div class="dashboard-sidebar-content">
                <?php
                // Si existe un menú en la ubicación 'menu-sidebar', lo mostramos
                if ( has_nav_menu( 'menu-sidebar' ) ) :
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-sidebar',
                            'menu_id'        => 'sidebar-menu',
                            'container'      => 'nav',
                            'container_class' => 'dashboard-navigation',
                            'menu_class'     => 'dashboard-menu',
                            'depth'          => 2,
                        )
                    );
                else :
                    // Menú de ejemplo si no hay uno definido
                    ?>
                    <nav class="dashboard-navigation">
                        <ul class="dashboard-menu">
                            <li class="dashboard-menu-item active">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <span class="dashboard-menu-icon"><?php echo nova_ui_get_svg_icon( 'home', 'md' ); ?></span>
                                    <span class="dashboard-menu-text"><?php esc_html_e( 'Dashboard', 'nova-ui' ); ?></span>
                                </a>
                            </li>
                            <li class="dashboard-menu-item">
                                <a href="#">
                                    <span class="dashboard-menu-icon"><?php echo nova_ui_get_svg_icon( 'bar-chart-2', 'md' ); ?></span>
                                    <span class="dashboard-menu-text"><?php esc_html_e( 'Analytics', 'nova-ui' ); ?></span>
                                </a>
                            </li>
                            <li class="dashboard-menu-item">
                                <a href="#">
                                    <span class="dashboard-menu-icon"><?php echo nova_ui_get_svg_icon( 'message-square', 'md' ); ?></span>
                                    <span class="dashboard-menu-text"><?php esc_html_e( 'Chat AI', 'nova-ui' ); ?></span>
                                </a>
                            </li>
                            <li class="dashboard-menu-item">
                                <a href="#">
                                    <span class="dashboard-menu-icon"><?php echo nova_ui_get_svg_icon( 'link', 'md' ); ?></span>
                                    <span class="dashboard-menu-text"><?php esc_html_e( 'Quick Links', 'nova-ui' ); ?></span>
                                </a>
                            </li>
                            <li class="dashboard-menu-item">
                                <a href="#">
                                    <span class="dashboard-menu-icon"><?php echo nova_ui_get_svg_icon( 'file-text', 'md' ); ?></span>
                                    <span class="dashboard-menu-text"><?php esc_html_e( 'Documents', 'nova-ui' ); ?></span>
                                </a>
                            </li>
                            <li class="dashboard-menu-item">
                                <a href="#">
                                    <span class="dashboard-menu-icon"><?php echo nova_ui_get_svg_icon( 'calendar', 'md' ); ?></span>
                                    <span class="dashboard-menu-text"><?php esc_html_e( 'Calendar', 'nova-ui' ); ?></span>
                                </a>
                            </li>
                            <li class="dashboard-menu-item">
                                <a href="#">
                                    <span class="dashboard-menu-icon"><?php echo nova_ui_get_svg_icon( 'briefcase', 'md' ); ?></span>
                                    <span class="dashboard-menu-text"><?php esc_html_e( 'Projects', 'nova-ui' ); ?></span>
                                </a>
                            </li>
                            <li class="dashboard-menu-item">
                                <a href="#">
                                    <span class="dashboard-menu-icon"><?php echo nova_ui_get_svg_icon( 'settings', 'md' ); ?></span>
                                    <span class="dashboard-menu-text"><?php esc_html_e( 'Settings', 'nova-ui' ); ?></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <?php
                endif;
                ?>
            </div>

            <!-- Ayuda en el Sidebar -->
            <div class="dashboard-help">
                <div class="help-icon">
                    <?php echo nova_ui_get_svg_icon( 'help-circle', 'md' ); ?>
                </div>
                <div class="help-text">
                    <p class="help-title"><?php esc_html_e( 'Need help?', 'nova-ui' ); ?></p>
                    <p class="help-subtitle"><?php esc_html_e( 'Check out the docs', 'nova-ui' ); ?></p>
                </div>
            </div>

            <div class="dashboard-sidebar-footer">
                <?php if ( get_theme_mod( 'nova_ui_show_dark_mode_toggle', true ) ) : ?>
                    <button id="dark-mode-toggle" class="saas-dark-mode-toggle" aria-label="<?php esc_attr_e( 'Toggle Dark Mode', 'nova-ui' ); ?>">
                        <span class="saas-dark-mode-toggle__icon icon-moon"><?php echo nova_ui_get_svg_icon( 'moon', 'md' ); ?></span>
                        <span class="saas-dark-mode-toggle__icon icon-sun"><?php echo nova_ui_get_svg_icon( 'sun', 'md' ); ?></span>
                    </button>
                <?php endif; ?>
            </div>
        </div>

        <!-- Contenido principal del Dashboard -->
        <div class="dashboard-main">
            <!-- Header del Dashboard -->
            <header class="dashboard-header">
                <div class="dashboard-header-start">
                    <button class="dashboard-mobile-menu-toggle" aria-label="<?php esc_attr_e( 'Toggle Mobile Menu', 'nova-ui' ); ?>">
                        <?php echo nova_ui_get_svg_icon( 'menu', 'md' ); ?>
                    </button>
                    
                    <div class="dashboard-search">
                        <form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <label class="screen-reader-text"><?php esc_html_e( 'Search for:', 'nova-ui' ); ?></label>
                            <div class="search-input-wrapper">
                                <?php echo nova_ui_get_svg_icon( 'search', 'sm' ); ?>
                                <input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search...', 'nova-ui' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
                                <div class="keyboard-shortcut">⌘K</div>
                            </div>
                            <button type="submit" class="search-submit"><?php esc_html_e( 'Search', 'nova-ui' ); ?></button>
                        </form>
                    </div>
                </div>

                <div class="dashboard-header-end">
                    <!-- Botón de notificaciones -->
                    <button class="dashboard-header-button">
                        <?php echo nova_ui_get_svg_icon( 'bell', 'md' ); ?>
                    </button>
                    
                    <!-- Toggle de tema oscuro/claro para pantallas grandes -->
                    <?php if ( get_theme_mod( 'nova_ui_show_dark_mode_toggle_header', true ) ) : ?>
                        <button class="dashboard-header-button dark-mode-toggle">
                            <span class="dark-mode-toggle moon"><?php echo nova_ui_get_svg_icon( 'moon', 'md' ); ?></span>
                            <span class="dark-mode-toggle sun"><?php echo nova_ui_get_svg_icon( 'sun', 'md' ); ?></span>
                        </button>
                    <?php endif; ?>
                    
                    <div class="dashboard-user-menu">
                        <button class="dashboard-user-toggle" aria-expanded="false">
                            <div class="dashboard-user-avatar">
                                <?php
                                if ( $current_user->exists() ) {
                                    echo get_avatar( $current_user->ID, 36 );
                                } else {
                                    echo 'M';
                                }
                                ?>
                            </div>
                            <span class="dashboard-user-name hidden-mobile">
                                <?php 
                                if ( $current_user->exists() ) {
                                    echo esc_html( $current_user->display_name );
                                } else {
                                    echo 'Miguel R.';
                                }
                                ?>
                            </span>
                            <?php echo nova_ui_get_svg_icon( 'chevron-down', 'sm' ); ?>
                        </button>

                        <div class="dashboard-user-dropdown">
                            <div class="dashboard-user-dropdown-header">
                                <div class="dashboard-user-avatar">
                                    <?php 
                                    if ( $current_user->exists() ) {
                                        echo get_avatar( $current_user->ID, 48 );
                                    } else {
                                        echo 'M';
                                    }
                                    ?>
                                </div>
                                <div class="dashboard-user-info">
                                    <div class="dashboard-user-name">
                                        <?php 
                                        if ( $current_user->exists() ) {
                                            echo esc_html( $current_user->display_name );
                                        } else {
                                            echo 'Miguel R.';
                                        }
                                        ?>
                                    </div>
                                    <div class="dashboard-user-email">
                                        <?php 
                                        if ( $current_user->exists() ) {
                                            echo esc_html( $current_user->user_email );
                                        } else {
                                            echo 'miguel.rodriguez@example.com';
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <ul class="dashboard-user-menu-list">
                                <li>
                                    <a href="<?php echo esc_url( get_edit_profile_url() ); ?>">
                                        <?php echo nova_ui_get_svg_icon( 'user', 'sm' ); ?>
                                        <?php esc_html_e( 'Profile', 'nova-ui' ); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <?php echo nova_ui_get_svg_icon( 'settings', 'sm' ); ?>
                                        <?php esc_html_e( 'Settings', 'nova-ui' ); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        <?php echo nova_ui_get_svg_icon( 'credit-card', 'sm' ); ?>
                                        <?php esc_html_e( 'Subscription', 'nova-ui' ); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">
                                        <?php echo nova_ui_get_svg_icon( 'log-out', 'sm' ); ?>
                                        <?php esc_html_e( 'Sign out', 'nova-ui' ); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Contenido del Dashboard -->
            <div class="dashboard-content">
                <div class="dashboard-content-inner">
                    <?php 
                    // Si estamos editando un contenido cargamos el post
                    if ( have_posts() ) :
                        while ( have_posts() ) :
                            the_post();
                            
                            // Si hay contenido en la página, lo mostramos
                            if ( '' !== get_the_content() ) :
                                ?>
                                <article id="post-<?php the_ID(); ?>" <?php post_class('saas-dashboard-page-content'); ?>>
                                    <?php if ( get_the_title() ) : ?>
                                        <header class="entry-header">
                                            <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                                        </header>
                                    <?php endif; ?>

                                    <div class="entry-content">
                                        <?php the_content(); ?>
                                    </div>
                                </article>
                                <?php
                            // Si no hay contenido, cargamos el contenido de ejemplo del dashboard
                            else :
                                // Incluir contenido de ejemplo de dashboard
                                include( get_template_directory() . '/inc/template-parts/dashboard-content.php' );
                            endif;
                            
                        endwhile;
                    else :
                        // Si no hay contenido, cargamos el contenido de ejemplo del dashboard
                        include( get_template_directory() . '/inc/template-parts/dashboard-content.php' );
                    endif;
                    ?>
                </div>
            </div>
        </div>
    </div><!-- .dashboard-layout -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
