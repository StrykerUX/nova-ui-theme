<?php
/**
 * Template part para mostrar el contenido en loop
 *
 * @package NovaUI
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('card'); ?>>
    <?php if (has_post_thumbnail()) : ?>
    <div class="post-thumbnail">
        <a href="<?php the_permalink(); ?>">
            <?php the_post_thumbnail('large', array('class' => 'card-img-top')); ?>
        </a>
    </div>
    <?php endif; ?>
    
    <div class="card-body">
        <header class="entry-header">
            <?php
            if (is_singular()) :
                the_title('<h1 class="entry-title">', '</h1>');
            else :
                the_title('<h2 class="entry-title"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
            endif;

            if ('post' === get_post_type()) :
            ?>
            <div class="entry-meta">
                <span class="posted-on">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="12" cy="12" r="10"></circle>
                        <polyline points="12 6 12 12 16 14"></polyline>
                    </svg>
                    <?php
                    echo '<time class="entry-date published" datetime="' . esc_attr(get_the_date('c')) . '">' . esc_html(get_the_date()) . '</time>';
                    ?>
                </span>
                
                <span class="byline">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                        <circle cx="12" cy="7" r="4"></circle>
                    </svg>
                    <?php
                    $author_id = get_the_author_meta('ID');
                    echo '<a href="' . esc_url(get_author_posts_url($author_id)) . '">' . esc_html(get_the_author()) . '</a>';
                    ?>
                </span>
                
                <?php if (has_category()) : ?>
                <span class="cat-links">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 9h16v10a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V9zm4-4h8l2 4H6z"></path>
                    </svg>
                    <?php the_category(', '); ?>
                </span>
                <?php endif; ?>
                
                <?php if (has_tag()) : ?>
                <span class="tags-links">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                    </svg>
                    <?php the_tags('', ', '); ?>
                </span>
                <?php endif; ?>
                
                <?php if (!post_password_required() && (comments_open() || get_comments_number())) : ?>
                <span class="comments-link">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                    </svg>
                    <?php comments_popup_link(
                        esc_html__('Leave a comment', 'novaui'),
                        esc_html__('1 Comment', 'novaui'),
                        esc_html__('% Comments', 'novaui')
                    ); ?>
                </span>
                <?php endif; ?>
            </div><!-- .entry-meta -->
            <?php endif; ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
            <?php
            if (is_singular()) :
                the_content(
                    sprintf(
                        wp_kses(
                            /* translators: %s: Name of current post. */
                            __('Continue reading %s <span class="meta-nav">&rarr;</span>', 'novaui'),
                            array(
                                'span' => array(
                                    'class' => array(),
                                ),
                            )
                        ),
                        get_the_title()
                    )
                );

                wp_link_pages(
                    array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'novaui'),
                        'after'  => '</div>',
                    )
                );
            else :
                the_excerpt();
            ?>
                <a href="<?php the_permalink(); ?>" class="button">
                    <?php esc_html_e('Read More', 'novaui'); ?>
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ml-1">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            <?php
            endif;
            ?>
        </div><!-- .entry-content -->
    </div><!-- .card-body -->
</article><!-- #post-<?php the_ID(); ?> -->
