<?php
/**
 * Template Name: Dashboard
 * Description: Template especializado para panel de usuario con sidebar lateral
 *
 * @package NovaUI
 */

// Restringir acceso a usuarios logueados
if ( !is_user_logged_in() ) {
    wp_redirect( wp_login_url( get_permalink() ) );
    exit;
}

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class('dashboard-template'); ?>>
<?php wp_body_open(); ?>

<div class="dashboard-layout">
	<!-- Sidebar / Menú lateral -->
	<aside class="sidebar">
		<div class="sidebar-header">
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="sidebar-brand">
				<div class="sidebar-brand-icon">
					<?php if ( has_custom_logo() ) : ?>
						<?php the_custom_logo(); ?>
					<?php else : ?>
						<span><?php echo esc_html( substr( get_bloginfo( 'name' ), 0, 1 ) ); ?></span>
					<?php endif; ?>
				</div>
				<span class="sidebar-brand-text"><?php bloginfo( 'name' ); ?></span>
			</a>
			<button class="sidebar-toggle" aria-label="<?php esc_attr_e( 'Toggle Sidebar', 'nova-ui' ); ?>">
				<span class="sidebar-toggle-icon"></span>
			</button>
		</div>

		<nav class="sidebar-navigation">
			<?php
			// Menu del dashboard
			if ( has_nav_menu( 'menu-2' ) ) :
				wp_nav_menu(
					array(
						'theme_location' => 'menu-2',
						'menu_id'        => 'dashboard-menu',
						'menu_class'     => 'sidebar-menu',
						'container'      => false,
						'depth'          => 2,
						'walker'         => new Nova_UI_Dashboard_Menu_Walker(), // Requiere clase personalizada
					)
				);
			else :
				// Menú por defecto
				?>
				<ul class="sidebar-menu">
					<li class="sidebar-menu-item">
						<a href="<?php echo esc_url( admin_url( 'index.php' ) ); ?>" class="sidebar-menu-link">
							<span class="sidebar-menu-icon"><i class="nova-icon-dashboard"></i></span>
							<span class="sidebar-menu-text"><?php esc_html_e( 'Dashboard', 'nova-ui' ); ?></span>
						</a>
					</li>
					<li class="sidebar-menu-item">
						<a href="<?php echo esc_url( admin_url( 'profile.php' ) ); ?>" class="sidebar-menu-link">
							<span class="sidebar-menu-icon"><i class="nova-icon-user"></i></span>
							<span class="sidebar-menu-text"><?php esc_html_e( 'Profile', 'nova-ui' ); ?></span>
						</a>
					</li>
					<li class="sidebar-menu-item">
						<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="sidebar-menu-link">
							<span class="sidebar-menu-icon"><i class="nova-icon-logout"></i></span>
							<span class="sidebar-menu-text"><?php esc_html_e( 'Logout', 'nova-ui' ); ?></span>
						</a>
					</li>
				</ul>
				<?php
			endif;
			?>
		</nav>

		<?php
		// Hook para añadir contenido adicional al sidebar
		do_action( 'nova_ui_after_sidebar_menu' );
		?>
	</aside>

	<!-- Contenido principal -->
	<div class="dashboard-content">
		<!-- Header del dashboard -->
		<header class="dashboard-header">
			<!-- Área de búsqueda -->
			<div class="dashboard-search">
				<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<div class="search-form-inner">
						<span class="search-icon"><i class="nova-icon-search"></i></span>
						<input type="search" class="search-field" placeholder="<?php esc_attr_e( 'Search...', 'nova-ui' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
						<span class="search-shortcut">⌘K</span>
					</div>
				</form>
			</div>

			<!-- Controles de la derecha -->
			<div class="dashboard-header-actions">
				<!-- Notificaciones -->
				<button class="header-icon-button" aria-label="<?php esc_attr_e( 'Notifications', 'nova-ui' ); ?>">
					<i class="nova-icon-bell"></i>
				</button>

				<!-- Toggle de tema claro/oscuro -->
				<button id="theme-toggle" class="header-icon-button theme-toggle" aria-label="<?php esc_attr_e( 'Toggle dark mode', 'nova-ui' ); ?>">
					<i class="nova-icon-moon"></i>
				</button>

				<!-- Menú de usuario -->
				<div class="user-dropdown">
					<button class="user-dropdown-toggle" aria-expanded="false">
						<div class="user-avatar">
							<?php 
							$current_user = wp_get_current_user(); 
							$display_name = $current_user->display_name;
							$first_letter = substr($display_name, 0, 1);
							?>
							<span><?php echo esc_html( $first_letter ); ?></span>
						</div>
						<span class="user-name"><?php echo esc_html( $display_name ); ?></span>
						<i class="nova-icon-chevron-down"></i>
					</button>
					<div class="user-dropdown-menu">
						<a href="<?php echo esc_url( admin_url( 'profile.php' ) ); ?>" class="dropdown-item">
							<?php esc_html_e( 'Profile', 'nova-ui' ); ?>
						</a>
						<a href="<?php echo esc_url( admin_url( 'profile.php' ) ); ?>" class="dropdown-item">
							<?php esc_html_e( 'Settings', 'nova-ui' ); ?>
						</a>
						<?php if ( class_exists( 'WooCommerce' ) ) : ?>
						<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'subscriptions' ) ); ?>" class="dropdown-item">
							<?php esc_html_e( 'Subscription', 'nova-ui' ); ?>
						</a>
						<?php endif; ?>
						<div class="dropdown-divider"></div>
						<a href="<?php echo esc_url( wp_logout_url( home_url() ) ); ?>" class="dropdown-item">
							<?php esc_html_e( 'Sign out', 'nova-ui' ); ?>
						</a>
					</div>
				</div>
			</div>
		</header>

		<!-- Contenido principal del dashboard -->
		<main class="dashboard-main">
			<?php
			while ( have_posts() ) :
				the_post();
				
				// Título y acciones de la página
				?>
				<div class="dashboard-title">
					<h1><?php the_title(); ?></h1>
					
					<?php 
					// Hook para añadir acciones personalizadas
					do_action( 'nova_ui_dashboard_title_actions' ); 
					?>
				</div>
				<?php

				// Contenido de la página
				the_content();

			endwhile;
			?>
		</main>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
