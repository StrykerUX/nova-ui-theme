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
                        // Si no hay logo personalizado, mostramos el nombre del sitio
                        ?>
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="dashboard-logo-text">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                        <?php
                    }
                    ?>
                    <div class="dashboard-logo-icon">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                            <?php echo nova_ui_get_svg_icon( 'play', 'md' ); ?>
                        </a>
                    </div>
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
                                    <span class="dashboard-menu-icon"><?php echo nova_ui_get_svg_icon( 'user', 'md' ); ?></span>
                                    <span class="dashboard-menu-text"><?php esc_html_e( 'My Account', 'nova-ui' ); ?></span>
                                </a>
                            </li>
                            <li class="dashboard-menu-item">
                                <a href="#">
                                    <span class="dashboard-menu-icon"><?php echo nova_ui_get_svg_icon( 'message-square', 'md' ); ?></span>
                                    <span class="dashboard-menu-text"><?php esc_html_e( 'Chat IA', 'nova-ui' ); ?></span>
                                </a>
                            </li>
                            <li class="dashboard-menu-item">
                                <a href="#">
                                    <span class="dashboard-menu-icon"><?php echo nova_ui_get_svg_icon( 'link', 'md' ); ?></span>
                                    <span class="dashboard-menu-text"><?php esc_html_e( 'Quick Links', 'nova-ui' ); ?></span>
                                </a>
                            </li>
                            <li class="dashboard-menu-item">
                                <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">
                                    <span class="dashboard-menu-icon"><?php echo nova_ui_get_svg_icon( 'log-out', 'md' ); ?></span>
                                    <span class="dashboard-menu-text"><?php esc_html_e( 'Log Out', 'nova-ui' ); ?></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                    <?php
                endif;
                ?>
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
                            </div>
                            <button type="submit" class="search-submit"><?php esc_html_e( 'Search', 'nova-ui' ); ?></button>
                        </form>
                    </div>
                </div>

                <div class="dashboard-header-end">
                    <div class="dashboard-user-menu">
                        <button class="dashboard-user-toggle" aria-expanded="false">
                            <div class="dashboard-user-avatar">
                                <?php
                                $current_user = wp_get_current_user();
                                if ( $current_user->exists() ) {
                                    echo get_avatar( $current_user->ID, 32 );
                                }
                                ?>
                            </div>
                            <span class="dashboard-user-name"><?php echo esc_html( $current_user->display_name ); ?></span>
                            <?php echo nova_ui_get_svg_icon( 'chevron-down', 'sm' ); ?>
                        </button>

                        <div class="dashboard-user-dropdown">
                            <div class="dashboard-user-dropdown-header">
                                <div class="dashboard-user-avatar">
                                    <?php echo get_avatar( $current_user->ID, 48 ); ?>
                                </div>
                                <div class="dashboard-user-info">
                                    <div class="dashboard-user-name"><?php echo esc_html( $current_user->display_name ); ?></div>
                                    <div class="dashboard-user-email"><?php echo esc_html( $current_user->user_email ); ?></div>
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
                                    <a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>">
                                        <?php echo nova_ui_get_svg_icon( 'log-out', 'sm' ); ?>
                                        <?php esc_html_e( 'Log Out', 'nova-ui' ); ?>
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
                    <?php nova_ui_breadcrumbs(); ?>

                    <?php
                    while ( have_posts() ) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('saas-dashboard-page-content'); ?>>
                            <header class="entry-header">
                                <?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div><!-- .entry-content -->
                        </article>
                        <?php
                    endwhile;
                    ?>
                </div>
            </div>
        </div>
    </div><!-- .dashboard-layout -->
</div><!-- #page -->

<?php wp_footer(); ?>
</body>
</html>
