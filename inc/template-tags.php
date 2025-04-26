<?php
/**
 * Funciones de template personalizadas para este tema
 *
 * @package NovaUI
 */

if ( ! function_exists( 'novaui_posted_on' ) ) :
	/**
	 * Imprime la fecha de publicación del post
	 */
	function novaui_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( DATE_W3C ) ),
			esc_html( get_the_modified_date() )
		);

		echo '<span class="posted-on">';
		echo novaui_get_icon_svg('calendar');
		echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>';
		echo '</span>';
	}
endif;

if ( ! function_exists( 'novaui_posted_by' ) ) :
	/**
	 * Imprime el nombre del autor del post
	 */
	function novaui_posted_by() {
		echo '<span class="byline">';
		echo novaui_get_icon_svg('user');
		echo '<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>';
		echo '</span>';
	}
endif;

if ( ! function_exists( 'novaui_entry_footer' ) ) :
	/**
	 * Imprime el footer de las entradas
	 */
	function novaui_entry_footer() {
		// Ocultar categoría y etiqueta para páginas.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'novaui' ) );
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . novaui_get_icon_svg('tag') . esc_html__( '%1$s', 'novaui' ) . '</span>', $categories_list );
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'novaui' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . novaui_get_icon_svg('tag') . esc_html__( '%1$s', 'novaui' ) . '</span>', $tags_list );
			}
		}

		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			echo novaui_get_icon_svg('comment');
			comments_popup_link(
				sprintf(
					wp_kses(
						/* translators: %s: post title */
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'novaui' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					wp_kses_post( get_the_title() )
				)
			);
			echo '</span>';
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'novaui' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;

if ( ! function_exists( 'novaui_post_thumbnail' ) ) :
	/**
	 * Muestra la imagen destacada
	 *
	 * Prioriza la visualización de la imagen destacada.
	 *
	 * @return void
	 */
	function novaui_post_thumbnail() {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}

		if ( is_singular() ) :
			?>

			<div class="post-thumbnail">
				<?php the_post_thumbnail('full', array('class' => 'img-fluid')); ?>
			</div><!-- .post-thumbnail -->

		<?php else : ?>

			<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
				<?php
					the_post_thumbnail(
						'post-thumbnail',
						array(
							'alt' => the_title_attribute(
								array(
									'echo' => false,
								)
							),
							'class' => 'img-fluid',
						)
					);
				?>
			</a>

			<?php
		endif; // End is_singular().
	}
endif;

if ( ! function_exists( 'novaui_comment' ) ) :
	/**
	 * Template para comentarios y pingbacks.
	 *
	 * @param WP_Comment $comment Comment Object.
	 * @param array      $args Arguments.
	 * @param int        $depth Depth of comment.
	 */
	function novaui_comment( $comment, $args, $depth ) {
		if ( 'pingback' === $comment->comment_type || 'trackback' === $comment->comment_type ) {
			// Muestra los pingbacks o trackbacks de forma diferente.
			?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class( 'media' ); ?>>
				<div class="comment-body">
					<?php esc_html_e( 'Pingback:', 'novaui' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( 'Edit', 'novaui' ), '<span class="edit-link">', '</span>' ); ?>
				</div>
			</li>
			<?php
		} else {
			// Muestra los comentarios normales.
			?>
			<li id="comment-<?php comment_ID(); ?>" <?php comment_class( empty( $args['has_children'] ) ? 'media' : 'media parent' ); ?>>
				<article id="div-comment-<?php comment_ID(); ?>" class="comment-body media mb-4">
					<div class="comment-avatar mr-3">
						<?php
						if ( 0 !== $args['avatar_size'] ) {
							echo get_avatar( $comment, $args['avatar_size'], '', '', array('class' => 'rounded-circle') );
						}
						?>
					</div>

					<div class="comment-content media-body">
						<div class="comment-metadata mb-2">
							<h5 class="mt-0 comment-author">
								<?php comment_author_link(); ?>
							</h5>
							<div class="comment-date text-muted">
								<a href="<?php echo esc_url( get_comment_link( $comment->comment_ID ) ); ?>">
									<time datetime="<?php comment_time( 'c' ); ?>">
										<?php
											/* translators: 1: comment date, 2: comment time */
											printf( esc_html__( '%1$s at %2$s', 'novaui' ), esc_html( get_comment_date() ), esc_html( get_comment_time() ) );
										?>
									</time>
								</a>
								<?php edit_comment_link( __( 'Edit', 'novaui' ), '<span class="edit-link">', '</span>' ); ?>
							</div>
						</div><!-- .comment-metadata -->

						<?php if ( '0' === $comment->comment_approved ) : ?>
							<p class="comment-awaiting-moderation alert alert-warning"><?php esc_html_e( 'Your comment is awaiting moderation.', 'novaui' ); ?></p>
						<?php endif; ?>

						<div class="comment-text">
							<?php comment_text(); ?>
						</div><!-- .comment-text -->

						<?php
						comment_reply_link(
							array_merge(
								$args,
								array(
									'add_below' => 'div-comment',
									'depth'     => $depth,
									'max_depth' => $args['max_depth'],
									'before'    => '<div class="reply">',
									'after'     => '</div>',
								)
							)
						);
						?>
					</div><!-- .comment-content -->
				</article><!-- .comment-body -->
			</li>
			<?php
		}
	}
endif;

if ( ! function_exists( 'novaui_get_dashboard_widgets' ) ) :
	/**
	 * Muestra los widgets del dashboard
	 *
	 * @return void
	 */
	function novaui_get_dashboard_widgets() {
		// Estadísticas de resumen para el dashboard
		$stats = array(
			array(
				'title' => __('Total Revenue', 'novaui'),
				'value' => '$0.00',
				'change' => '+0%',
				'positive' => true,
				'color' => 'var(--color-primary)',
				'icon' => 'dollar-sign'
			),
			array(
				'title' => __('Active Users', 'novaui'),
				'value' => '0',
				'change' => '+0%',
				'positive' => true,
				'color' => 'var(--color-success)',
				'icon' => 'users'
			),
			array(
				'title' => __('Conversion Rate', 'novaui'),
				'value' => '0%',
				'change' => '0%',
				'positive' => false,
				'color' => 'var(--color-error)',
				'icon' => 'activity'
			)
		);
		
		// Hook para que otros plugins puedan modificar las estadísticas
		$stats = apply_filters('novaui_dashboard_stats', $stats);
		
		// Impresión de los widgets
		echo '<div class="dashboard-widgets">';
		
		foreach ($stats as $stat) {
			?>
			<div class="dashboard-widget">
				<div class="dashboard-widget-header">
					<div>
						<h2 class="dashboard-widget-title"><?php echo esc_html($stat['title']); ?></h2>
						<p class="dashboard-widget-value"><?php echo esc_html($stat['value']); ?></p>
					</div>
					<div class="dashboard-widget-icon" style="background-color: <?php echo esc_attr($stat['color']); ?>">
						<?php echo novaui_get_icon_svg($stat['icon']); ?>
					</div>
				</div>
				<div class="dashboard-widget-footer">
					<div class="dashboard-widget-change <?php echo $stat['positive'] ? 'positive' : 'negative'; ?>">
						<?php echo $stat['positive'] ? '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="18 15 12 9 6 15"></polyline></svg>' : '<svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>'; ?>
						<?php echo esc_html($stat['change']); ?>
					</div>
					<div class="dashboard-widget-period">
						<?php esc_html_e('vs last month', 'novaui'); ?>
					</div>
				</div>
			</div>
			<?php
		}
		
		echo '</div>';
	}
endif;

if ( ! function_exists( 'novaui_get_theme_mode_toggle' ) ) :
	/**
	 * Muestra el control para cambiar entre modo oscuro y claro
	 *
	 * @return void
	 */
	function novaui_get_theme_mode_toggle() {
		?>
		<button id="theme-toggle" class="theme-toggle" aria-label="<?php esc_attr_e('Toggle dark mode', 'novaui'); ?>">
			<span class="theme-toggle-dark">
				<?php echo novaui_get_icon_svg('moon'); ?>
			</span>
			<span class="theme-toggle-light">
				<?php echo novaui_get_icon_svg('sun'); ?>
			</span>
		</button>
		<?php
	}
endif;
