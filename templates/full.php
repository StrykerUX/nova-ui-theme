<?php
/**
 * Template Name: Full
 * Description: Template completo con header, footer, sidebar y contenido principal
 *
 * @package NovaUI
 */

get_header();
?>

<div class="page-layout has-sidebar">
	<main id="primary" class="content-area">
		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' );

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

		endwhile; // End of the loop.
		?>
	</main><!-- #primary -->

	<?php get_sidebar(); ?>
</div>

<?php
get_footer();
