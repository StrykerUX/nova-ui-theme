<?php
/**
 * Template part para mostrar el header del dashboard
 *
 * @package NovaUI
 */
?>

<header id="masthead" class="site-header dashboard-header">
    <div class="container">
        <div class="dashboard-logo">
            <?php
            if (has_custom_logo()) {
                the_custom_logo();
            } else {
                ?>
                <div class="site-title">
                    <a href="<?php echo esc_url(home_url('/')); ?>" rel="home">
                        <?php bloginfo('name'); ?>
                    </a>
                </div>
                <?php
            }
            ?>
        </div>
        
        <div class="dashboard-header-nav">
            <?php
            wp_nav_menu(
                array(
                    'theme_location' => 'menu-3',
                    'menu_id'        => 'dashboard-menu',
                    'container_class' => 'dashboard-navigation',
                    'fallback_cb'    => false,
                )
            );
            ?>
        </div>
        
        <div class="dashboard-header-actions">
            <button id="theme-toggle" class="theme-toggle" aria-label="<?php esc_attr_e('Toggle dark mode', 'novaui'); ?>">
                <span class="theme-toggle-dark"><?php esc_html_e('Dark', 'novaui'); ?></span>
                <span class="theme-toggle-light"><?php esc_html_e('Light', 'novaui'); ?></span>
            </button>
            
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
