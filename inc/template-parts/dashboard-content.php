<?php
/**
 * Dashboard Content
 * Contenido de ejemplo para el dashboard neo-brutalista
 *
 * @package NovaUI
 */

// No permitir el acceso directo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}
?>

<div class="dashboard-page-header">
    <h1 class="dashboard-page-title"><?php esc_html_e( 'Dashboard', 'nova-ui' ); ?></h1>
    <div class="dashboard-page-actions">
        <button class="button button-secondary">
            <?php echo nova_ui_get_svg_icon( 'download', 'sm' ); ?>
            <?php esc_html_e( 'Export', 'nova-ui' ); ?>
        </button>
        <button class="button button-primary">
            <?php echo nova_ui_get_svg_icon( 'plus', 'sm' ); ?>
            <?php esc_html_e( 'New Report', 'nova-ui' ); ?>
        </button>
    </div>
</div>

<!-- Tarjetas de Estadísticas -->
<div class="stats-cards">
    <!-- Tarjeta de Ingresos -->
    <div class="stats-card">
        <div class="stats-card-header">
            <div>
                <p class="stats-card-title"><?php esc_html_e( 'Total Revenue', 'nova-ui' ); ?></p>
                <h3 class="stats-card-value">$124,592.40</h3>
            </div>
            <div class="stats-card-icon primary">
                <?php echo nova_ui_get_svg_icon( 'dollar-sign', 'md' ); ?>
            </div>
        </div>
        <div class="stats-card-change">
            <span class="stats-card-badge positive">+12.4%</span>
            <span class="stats-card-period"><?php esc_html_e( 'vs last month', 'nova-ui' ); ?></span>
        </div>
    </div>
    
    <!-- Tarjeta de Usuarios Activos -->
    <div class="stats-card">
        <div class="stats-card-header">
            <div>
                <p class="stats-card-title"><?php esc_html_e( 'Active Users', 'nova-ui' ); ?></p>
                <h3 class="stats-card-value">4,893</h3>
            </div>
            <div class="stats-card-icon success">
                <?php echo nova_ui_get_svg_icon( 'users', 'md' ); ?>
            </div>
        </div>
        <div class="stats-card-change">
            <span class="stats-card-badge positive">+17.2%</span>
            <span class="stats-card-period"><?php esc_html_e( 'vs last month', 'nova-ui' ); ?></span>
        </div>
    </div>
    
    <!-- Tarjeta de Tasa de Conversión -->
    <div class="stats-card">
        <div class="stats-card-header">
            <div>
                <p class="stats-card-title"><?php esc_html_e( 'Conversion Rate', 'nova-ui' ); ?></p>
                <h3 class="stats-card-value">3.42%</h3>
            </div>
            <div class="stats-card-icon error">
                <?php echo nova_ui_get_svg_icon( 'activity', 'md' ); ?>
            </div>
        </div>
        <div class="stats-card-change">
            <span class="stats-card-badge negative">-2.1%</span>
            <span class="stats-card-period"><?php esc_html_e( 'vs last month', 'nova-ui' ); ?></span>
        </div>
    </div>
</div>

<!-- Widgets principales -->
<div class="main-widgets">
    <!-- Widget de Chat IA -->
    <div class="widget-chat">
        <div class="widget-header">
            <h2 class="widget-title">
                <?php echo nova_ui_get_svg_icon( 'message-square', 'md' ); ?>
                <?php esc_html_e( 'Chat AI', 'nova-ui' ); ?>
            </h2>
            <span class="widget-badge"><?php esc_html_e( 'ACTIVE', 'nova-ui' ); ?></span>
        </div>
        <div class="widget-content">
            <div class="chat-container">
                <!-- Mensaje de IA -->
                <div class="chat-message">
                    <div class="chat-avatar ai">
                        <?php esc_html_e( 'AI', 'nova-ui' ); ?>
                    </div>
                    <div class="chat-bubble ai">
                        <p class="chat-text"><?php esc_html_e( 'I can analyze your recent sales data and provide insights on trends. Your revenue has increased 12.4% compared to last month. Would you like a detailed breakdown?', 'nova-ui' ); ?></p>
                    </div>
                </div>
                
                <!-- Mensaje de Usuario -->
                <div class="chat-message chat-user">
                    <div class="chat-avatar user">
                        <?php 
                        $current_user = wp_get_current_user();
                        if ( $current_user->exists() ) {
                            echo esc_html( substr($current_user->display_name, 0, 1) );
                        } else {
                            echo 'M';
                        }
                        ?>
                    </div>
                    <div class="chat-bubble user">
                        <p class="chat-text"><?php esc_html_e( 'Yes, show me the breakdown by product category and highlight the best performers.', 'nova-ui' ); ?></p>
                    </div>
                </div>
            </div>
            
            <form class="chat-form">
                <input type="text" class="chat-input" placeholder="<?php esc_attr_e( 'Ask AI assistant...', 'nova-ui' ); ?>">
                <button type="submit" class="chat-submit">
                    <?php echo nova_ui_get_svg_icon( 'send', 'sm' ); ?>
                    <?php esc_html_e( 'Send', 'nova-ui' ); ?>
                </button>
            </form>
            
            <div class="chat-footer">
                <span class="chat-tokens">
                    <span class="chat-tokens-value">500</span> <?php esc_html_e( 'tokens remaining', 'nova-ui' ); ?>
                </span>
                <a href="#" class="chat-view-all"><?php esc_html_e( 'View all conversations →', 'nova-ui' ); ?></a>
            </div>
        </div>
    </div>
    
    <!-- Widget de Quick Links -->
    <div class="widget-quicklinks">
        <div class="widget-header">
            <h2 class="widget-title">
                <?php echo nova_ui_get_svg_icon( 'link', 'md' ); ?>
                <?php esc_html_e( 'Quick Links', 'nova-ui' ); ?>
            </h2>
            <button class="widget-badge" style="background-color: var(--color-accent); color: var(--color-text); border-color: var(--color-accent);">
                <?php echo nova_ui_get_svg_icon( 'plus', 'xs' ); ?>
                <?php esc_html_e( 'New', 'nova-ui' ); ?>
            </button>
        </div>
        <div class="widget-content">
            <div class="quicklink-list">
                <div class="quicklink-item">
                    <div class="quicklink-info">
                        <h3>Product Portfolio</h3>
                        <div class="quicklink-views">1243 views</div>
                    </div>
                    <button class="quicklink-action"><?php esc_html_e( 'Edit', 'nova-ui' ); ?></button>
                </div>
                
                <div class="quicklink-item">
                    <div class="quicklink-info">
                        <h3>Company Dashboard</h3>
                        <div class="quicklink-views">842 views</div>
                    </div>
                    <button class="quicklink-action"><?php esc_html_e( 'Edit', 'nova-ui' ); ?></button>
                </div>
                
                <div class="quicklink-item">
                    <div class="quicklink-info">
                        <h3>Support Resources</h3>
                        <div class="quicklink-views">568 views</div>
                    </div>
                    <button class="quicklink-action"><?php esc_html_e( 'Edit', 'nova-ui' ); ?></button>
                </div>
            </div>
            
            <a href="#" class="view-all-links"><?php esc_html_e( 'View All Links', 'nova-ui' ); ?></a>
        </div>
    </div>
</div>

<!-- Widgets secundarios -->
<div class="secondary-widgets">
    <!-- Widget de Tareas -->
    <div class="widget-tasks">
        <div class="widget-header">
            <h2 class="widget-title">
                <?php echo nova_ui_get_svg_icon( 'clock', 'md' ); ?>
                <?php esc_html_e( 'Upcoming Tasks', 'nova-ui' ); ?>
            </h2>
            <select class="widget-header-actions">
                <option><?php esc_html_e( 'Today', 'nova-ui' ); ?></option>
                <option><?php esc_html_e( 'This Week', 'nova-ui' ); ?></option>
                <option><?php esc_html_e( 'This Month', 'nova-ui' ); ?></option>
            </select>
        </div>
        <div class="widget-content">
            <div class="task-list">
                <div class="task-item">
                    <div class="task-check">
                        <div class="task-checkbox"></div>
                        <div class="task-info">
                            <p class="task-title"><?php esc_html_e( 'Update Quick Links interface', 'nova-ui' ); ?></p>
                            <p class="task-time">10:00 AM</p>
                        </div>
                    </div>
                    <span class="task-priority high"><?php esc_html_e( 'High', 'nova-ui' ); ?></span>
                </div>
                
                <div class="task-item">
                    <div class="task-check">
                        <div class="task-checkbox"></div>
                        <div class="task-info">
                            <p class="task-title"><?php esc_html_e( 'Review Chat IA performance', 'nova-ui' ); ?></p>
                            <p class="task-time">1:30 PM</p>
                        </div>
                    </div>
                    <span class="task-priority medium"><?php esc_html_e( 'Medium', 'nova-ui' ); ?></span>
                </div>
                
                <div class="task-item">
                    <div class="task-check">
                        <div class="task-checkbox"></div>
                        <div class="task-info">
                            <p class="task-title"><?php esc_html_e( 'Team meeting - Sprint planning', 'nova-ui' ); ?></p>
                            <p class="task-time">3:00 PM</p>
                        </div>
                    </div>
                    <span class="task-priority high"><?php esc_html_e( 'High', 'nova-ui' ); ?></span>
                </div>
                
                <div class="task-item">
                    <div class="task-check">
                        <div class="task-checkbox"></div>
                        <div class="task-info">
                            <p class="task-title"><?php esc_html_e( 'Prepare monthly report', 'nova-ui' ); ?></p>
                            <p class="task-time">5:00 PM</p>
                        </div>
                    </div>
                    <span class="task-priority low"><?php esc_html_e( 'Low', 'nova-ui' ); ?></span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Widget de Membresía tipo Game UI -->
    <div class="widget-membership">
        <div class="membership-progress-bar"></div>
        <div class="widget-content">
            <div class="membership-header">
                <div class="membership-icon">
                    <?php echo nova_ui_get_svg_icon( 'play', 'md' ); ?>
                </div>
                <div class="membership-info">
                    <h2 class="membership-plan"><?php esc_html_e( 'Professional Plan', 'nova-ui' ); ?></h2>
                    <p class="membership-expires"><?php esc_html_e( 'Active until May 26, 2025', 'nova-ui' ); ?></p>
                </div>
            </div>
            
            <div class="membership-resources">
                <div class="resource-header">
                    <span class="resource-name"><?php esc_html_e( 'IA Tokens', 'nova-ui' ); ?></span>
                    <span class="resource-value">500/2000</span>
                </div>
                <div class="resource-progress">
                    <div class="resource-bar" style="width: 25%;"></div>
                </div>
                <p class="resource-info"><?php esc_html_e( 'Tokens reset in 16 days', 'nova-ui' ); ?></p>
            </div>
            
            <div class="membership-stats">
                <div class="stat-card">
                    <p class="stat-label"><?php esc_html_e( 'Quick Links', 'nova-ui' ); ?></p>
                    <p class="stat-value">3<span class="stat-max">/10</span></p>
                </div>
                
                <div class="stat-card">
                    <p class="stat-label"><?php esc_html_e( 'Users', 'nova-ui' ); ?></p>
                    <p class="stat-value">2<span class="stat-max">/5</span></p>
                </div>
            </div>
            
            <button class="upgrade-button"><?php esc_html_e( 'Upgrade Plan', 'nova-ui' ); ?></button>
        </div>
        
        <div class="membership-decorative">
            <div class="membership-heart">
                <?php echo nova_ui_get_svg_icon( 'heart', 'sm', ['style' => 'fill: currentColor;'] ); ?>
            </div>
            <div class="membership-heart">
                <?php echo nova_ui_get_svg_icon( 'heart', 'sm', ['style' => 'fill: currentColor;'] ); ?>
            </div>
            <div class="membership-heart">
                <?php echo nova_ui_get_svg_icon( 'heart', 'sm', ['style' => 'fill: currentColor;'] ); ?>
            </div>
        </div>
    </div>
</div>
