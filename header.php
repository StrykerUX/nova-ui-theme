<?php
/**
 * La cabecera para nuestro tema
 *
 * Este es el template que muestra toda la sección <head> y el inicio de <body>
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package NovaUI
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'novaui' ); ?></a>

    <?php
    // Determinar el tipo de header a mostrar según el template
    if (is_page_template('page-templates/dashboard.php')) {
        get_template_part('template-parts/header', 'dashboard');
    } elseif (is_page_template('page-templates/canvas.php')) {
        // Para el template Canvas, no mostramos header
    } else {
        // Header estándar para el resto de páginas
        ?>
        <header id="masthead" class="site-header">
            <div class="container">
                <div class="site-branding">
                    <?php
                    if (has_custom_logo()) :
                        the_custom_logo();
                    else :
                        ?>
                        <h1 class="site-title"><a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a></h1>
                        <?php
                        $novaui_description = get_bloginfo('description', 'display');
                        if ($novaui_description || is_customize_preview()) :
                            ?>
                            <p class="site-description"><?php echo $novaui_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
                        <?php endif; ?>
                    <?php endif; ?>
                </div><!-- .site-branding -->

                <nav id="site-navigation" class="main-navigation">
                    <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
                        <span class="menu-toggle-icon"></span>
                        <?php esc_html_e('Menu', 'novaui'); ?>
                    </button>
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'menu-1',
                            'menu_id' => 'primary-menu',
                            'container_class' => 'primary-menu-container',
                        )
                    );
                    ?>
                </nav><!-- #site-navigation -->

                <div class="header-actions">
                    <button id="theme-toggle" class="theme-toggle" aria-label="<?php esc_attr_e('Toggle dark mode', 'novaui'); ?>">
                        <span class="theme-toggle-dark"><?php esc_html_e('Dark', 'novaui'); ?></span>
                        <span class="theme-toggle-light"><?php esc_html_e('Light', 'novaui'); ?></span>
                    </button>
                    
                    <?php if (class_exists('WooCommerce')) : ?>
                    <div class="header-cart">
                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-link">
                            <span class="cart-icon"></span>
                            <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                        </a>
                    </div>
                    <?php endif; ?>
                    
                    <?php if (is_user_logged_in()) : ?>
                    <div class="user-actions">
                        <button class="user-menu-toggle">
                            <?php echo get_avatar(get_current_user_id(), 32); ?>
                            <span class="username"><?php echo wp_get_current_user()->display_name; ?></span>
                        </button>
                        <div class="user-dropdown">
                            <ul>
                                <li><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>"><?php esc_html_e('My Account', 'novaui'); ?></a></li>
                                <?php if (current_user_can('edit_posts')) : ?>
                                <li><a href="<?php echo esc_url(admin_url()); ?>"><?php esc_html_e('Dashboard', 'novaui'); ?></a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo esc_url(wp_logout_url(home_url())); ?>"><?php esc_html_e('Log Out', 'novaui'); ?></a></li>
                            </ul>
                        </div>
                    </div>
                    <?php else : ?>
                    <div class="auth-actions">
                        <a href="<?php echo esc_url(wp_login_url()); ?>" class="login-link"><?php esc_html_e('Log In', 'novaui'); ?></a>
                        <a href="<?php echo esc_url(wp_registration_url()); ?>" class="register-link"><?php esc_html_e('Sign Up', 'novaui'); ?></a>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </header><!-- #masthead -->
        <?php
    }
    ?>

    <?php 
    // Breadcrumbs (excepto en template Canvas)
    if (!is_page_template('page-templates/canvas.php') && !is_front_page()) : 
        get_template_part('template-parts/breadcrumbs'); 
    endif; 
    ?>
