<?php
/**
 * Template part para listado de QuickLinks en el dashboard
 *
 * @package NovaUI
 */

/**
 * Variables esperadas (opcionales):
 * $limit - Número de enlaces a mostrar
 * $view_all_url - URL para ver todos los enlaces
 */

// Valores por defecto
$limit = isset( $args['limit'] ) ? intval( $args['limit'] ) : 5;
$view_all_url = isset( $args['view_all_url'] ) ? $args['view_all_url'] : '#';

// Comprobar si está instalado el plugin de QuickLinks
if ( function_exists( 'ql_get_user_profiles' ) ) :
    $profiles = ql_get_user_profiles( get_current_user_id(), $limit );
    ?>
    <div class="quick-links-section">
        <div class="quick-links-header">
            <h3 class="quick-links-title">
                <i class="nova-icon-link"></i>
                <?php esc_html_e( 'Quick Links', 'nova-ui' ); ?>
            </h3>
            <a href="<?php echo esc_url( admin_url( 'admin.php?page=quicklinks-new' ) ); ?>" class="quick-links-action">
                <i class="nova-icon-plus"></i>
                <?php esc_html_e( 'New', 'nova-ui' ); ?>
            </a>
        </div>
        
        <div class="quick-links-content">
            <?php if ( !empty( $profiles ) ) : ?>
                <div class="quick-links-list">
                    <?php foreach ( $profiles as $profile ) : ?>
                        <div class="quick-link-item">
                            <div class="quick-link-info">
                                <div class="quick-link-title"><?php echo esc_html( $profile->post_title ); ?></div>
                                <?php 
                                // Si hay alguna función para obtener estadísticas
                                if ( function_exists( 'ql_get_profile_stats' ) ) :
                                    $stats = ql_get_profile_stats( $profile->ID );
                                    ?>
                                    <div class="quick-link-stats">
                                        <?php echo esc_html( sprintf( _n( '%s view', '%s views', $stats['views'], 'nova-ui' ), number_format_i18n( $stats['views'] ) ) ); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <a href="<?php echo esc_url( get_edit_post_link( $profile->ID ) ); ?>" class="quick-link-edit">
                                <?php esc_html_e( 'Edit', 'nova-ui' ); ?>
                            </a>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php else : ?>
                <div class="quick-links-empty">
                    <p><?php esc_html_e( 'You haven\'t created any Quick Links profiles yet.', 'nova-ui' ); ?></p>
                    <a href="<?php echo esc_url( admin_url( 'admin.php?page=quicklinks-new' ) ); ?>" class="saas-button saas-button--primary">
                        <?php esc_html_e( 'Create Your First Profile', 'nova-ui' ); ?>
                    </a>
                </div>
            <?php endif; ?>
            
            <a href="<?php echo esc_url( $view_all_url ); ?>" class="quick-link-view-all">
                <?php esc_html_e( 'View All Links', 'nova-ui' ); ?>
            </a>
        </div>
    </div>
<?php else : ?>
    <div class="quick-links-section">
        <div class="quick-links-header">
            <h3 class="quick-links-title">
                <i class="nova-icon-link"></i>
                <?php esc_html_e( 'Quick Links', 'nova-ui' ); ?>
            </h3>
        </div>
        
        <div class="quick-links-content">
            <div class="quick-links-empty">
                <p><?php esc_html_e( 'Quick Links plugin is not activated.', 'nova-ui' ); ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>
