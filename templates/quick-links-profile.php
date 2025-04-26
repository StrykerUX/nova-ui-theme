<?php
/**
 * Template Name: Quick Links Profile
 * Description: Template para mostrar perfiles públicos de Quick Links
 *
 * @package NovaUI
 * @subpackage Templates
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class('quick-links-profile'); ?>>
<?php wp_body_open(); ?>

<div class="quick-links-container">
	<div class="quick-links-header">
		<?php if ( function_exists( 'ql_get_profile_data' ) ) : 
			$profile_id = get_query_var( 'ql_profile_id', 0 );
			$profile_data = ql_get_profile_data( $profile_id );
			
			if ( ! empty( $profile_data ) ) :
				// Logo o icono del perfil
				if ( ! empty( $profile_data['avatar'] ) ) : ?>
					<div class="quick-links-logo">
						<img src="<?php echo esc_url( $profile_data['avatar'] ); ?>" alt="<?php echo esc_attr( $profile_data['title'] ); ?>" />
					</div>
				<?php else : ?>
					<div class="quick-links-logo quick-links-logo-default">
						<span><?php echo esc_html( substr( $profile_data['title'], 0, 1 ) ); ?></span>
					</div>
				<?php endif; ?>
				
				<h1 class="quick-links-title"><?php echo esc_html( $profile_data['title'] ); ?></h1>
				
				<?php if ( ! empty( $profile_data['description'] ) ) : ?>
					<div class="quick-links-description">
						<?php echo wp_kses_post( $profile_data['description'] ); ?>
					</div>
				<?php endif; ?>
			<?php else : ?>
				<h1 class="quick-links-title"><?php esc_html_e( 'Quick Links Profile', 'nova-ui' ); ?></h1>
			<?php endif; ?>
		<?php else : ?>
			<h1 class="quick-links-title"><?php the_title(); ?></h1>
		<?php endif; ?>
	</div>

	<div class="quick-links-content">
		<?php
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
		?>
	</div>

	<div class="quick-links-footer">
		<div class="quick-links-powered-by">
			<?php
			/* translators: %s: Theme name. */
			printf( esc_html__( 'Powered by %s', 'nova-ui' ), 'NovaUI' );
			?>
		</div>
	</div>
</div>

<?php wp_footer(); ?>
</body>
</html>
