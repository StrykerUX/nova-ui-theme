<?php
/**
 * Template part para mostrar breadcrumbs
 *
 * @package NovaUI
 */

// No mostrar en la página de inicio
if (is_front_page()) {
    return;
}
?>

<div class="breadcrumbs">
    <div class="container">
        <ul class="breadcrumbs-list">
            <li>
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="mr-1">
                        <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                        <polyline points="9 22 9 12 15 12 15 22"></polyline>
                    </svg>
                    <?php esc_html_e('Home', 'novaui'); ?>
                </a>
            </li>
            
            <?php
            if (is_category() || is_single()) {
                if (is_category()) {
                    $category = get_queried_object();
                    echo '<li class="current">' . esc_html($category->name) . '</li>';
                } else {
                    $categories = get_the_category();
                    if ($categories) {
                        echo '<li><a href="' . esc_url(get_category_link($categories[0]->term_id)) . '">' . esc_html($categories[0]->name) . '</a></li>';
                    }
                    
                    if (is_single()) {
                        echo '<li class="current">' . get_the_title() . '</li>';
                    }
                }
            } elseif (is_page()) {
                if ($post->post_parent) {
                    $ancestors = get_post_ancestors($post->ID);
                    $ancestors = array_reverse($ancestors);
                    
                    foreach ($ancestors as $ancestor) {
                        echo '<li><a href="' . esc_url(get_permalink($ancestor)) . '">' . esc_html(get_the_title($ancestor)) . '</a></li>';
                    }
                }
                
                echo '<li class="current">' . get_the_title() . '</li>';
            } elseif (is_tag()) {
                echo '<li>' . esc_html__('Tag', 'novaui') . '</li>';
                echo '<li class="current">' . single_tag_title('', false) . '</li>';
            } elseif (is_author()) {
                echo '<li>' . esc_html__('Author', 'novaui') . '</li>';
                echo '<li class="current">' . get_the_author() . '</li>';
            } elseif (is_search()) {
                echo '<li class="current">' . esc_html__('Search Results', 'novaui') . '</li>';
            } elseif (is_404()) {
                echo '<li class="current">' . esc_html__('404 Not Found', 'novaui') . '</li>';
            } elseif (is_archive()) {
                if (is_day()) {
                    echo '<li>' . esc_html__('Archives', 'novaui') . '</li>';
                    echo '<li class="current">' . get_the_date() . '</li>';
                } elseif (is_month()) {
                    echo '<li>' . esc_html__('Archives', 'novaui') . '</li>';
                    echo '<li class="current">' . get_the_date('F Y') . '</li>';
                } elseif (is_year()) {
                    echo '<li>' . esc_html__('Archives', 'novaui') . '</li>';
                    echo '<li class="current">' . get_the_date('Y') . '</li>';
                } else {
                    echo '<li class="current">' . esc_html__('Archives', 'novaui') . '</li>';
                }
            }
            ?>
        </ul>
    </div>
</div>
