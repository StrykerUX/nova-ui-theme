<?php
/**
 * Plantilla principal del tema
 *
 * @package Nova_UI
 */

// Evitar acceso directo al archivo
if (!defined('ABSPATH')) {
    exit;
}

get_header();
get_sidebar();
?>

<main id="primary" class="content-area">
    <div class="container">
        <div class="page-header">
            <h1 class="page-title"><?php esc_html_e('Dashboard', 'nova-ui'); ?></h1>
            
            <div class="page-actions">
                <button class="btn btn-outline" aria-label="<?php esc_attr_e('Exportar', 'nova-ui'); ?>">
                    <i class="ti ti-download"></i>
                    <span><?php esc_html_e('Exportar', 'nova-ui'); ?></span>
                </button>
                
                <button class="btn btn-primary" aria-label="<?php esc_attr_e('Nuevo Reporte', 'nova-ui'); ?>">
                    <i class="ti ti-plus"></i>
                    <span><?php esc_html_e('Nuevo Reporte', 'nova-ui'); ?></span>
                </button>
            </div>
        </div>
        
        <!-- Estadísticas Dashboard -->
        <div class="stats-cards">
            <!-- Tarjeta de Ingresos Totales -->
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-info">
                        <h2 class="stats-title"><?php esc_html_e('Total Revenue', 'nova-ui'); ?></h2>
                        <div class="stats-value">$124,592.40</div>
                        <div class="stats-trend positive">
                            <i class="ti ti-trending-up"></i>
                            <span>+12.4%</span>
                            <span class="trend-period"><?php esc_html_e('vs last month', 'nova-ui'); ?></span>
                        </div>
                    </div>
                    <div class="stats-icon-container">
                        <div class="stats-icon" style="background-color: #FF6B6B;">
                            <i class="ti ti-currency-dollar"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tarjeta de Usuarios Activos -->
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-info">
                        <h2 class="stats-title"><?php esc_html_e('Active Users', 'nova-ui'); ?></h2>
                        <div class="stats-value">4,893</div>
                        <div class="stats-trend positive">
                            <i class="ti ti-trending-up"></i>
                            <span>+17.2%</span>
                            <span class="trend-period"><?php esc_html_e('vs last month', 'nova-ui'); ?></span>
                        </div>
                    </div>
                    <div class="stats-icon-container">
                        <div class="stats-icon" style="background-color: #4ECDC4;">
                            <i class="ti ti-users"></i>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tarjeta de Tasa de Conversión -->
            <div class="card stats-card">
                <div class="card-body">
                    <div class="stats-info">
                        <h2 class="stats-title"><?php esc_html_e('Conversion Rate', 'nova-ui'); ?></h2>
                        <div class="stats-value">3.42%</div>
                        <div class="stats-trend negative">
                            <i class="ti ti-trending-down"></i>
                            <span>-2.1%</span>
                            <span class="trend-period"><?php esc_html_e('vs last month', 'nova-ui'); ?></span>
                        </div>
                    </div>
                    <div class="stats-icon-container">
                        <div class="stats-icon" style="background-color: #FF8A5B;">
                            <i class="ti ti-chart-line"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Chat AI Widget -->
        <div class="card chat-ai-card">
            <div class="card-header">
                <div class="card-title">
                    <i class="ti ti-message-circle"></i>
                    <h2><?php esc_html_e('Chat AI', 'nova-ui'); ?></h2>
                </div>
                <div class="card-badge"><?php esc_html_e('ACTIVE', 'nova-ui'); ?></div>
            </div>
            
            <div class="card-body">
                <div class="chat-messages">
                    <div class="chat-message ai-message">
                        <div class="message-avatar">
                            <div class="avatar-icon" style="background-color: #4ECDC4;">
                                <span>AI</span>
                            </div>
                        </div>
                        <div class="message-content">
                            <p><?php esc_html_e('I can analyze your recent sales data and provide insights on trends. Your revenue has increased 12.4% compared to last month. Would you like a detailed breakdown?', 'nova-ui'); ?></p>
                        </div>
                    </div>
                    
                    <div class="chat-message user-message">
                        <div class="message-content">
                            <p><?php esc_html_e('Yes, show me the breakdown by product category and highlight the best performers.', 'nova-ui'); ?></p>
                        </div>
                        <div class="message-avatar">
                            <div class="avatar-icon" style="background-color: #FF6B6B;">
                                <span>M</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="chat-input-container">
                    <input type="text" class="chat-input" placeholder="<?php esc_attr_e('Ask AI assistant...', 'nova-ui'); ?>">
                    <button class="chat-send-btn" aria-label="<?php esc_attr_e('Enviar', 'nova-ui'); ?>">
                        <i class="ti ti-send"></i>
                        <span><?php esc_html_e('Send', 'nova-ui'); ?></span>
                    </button>
                </div>
                
                <div class="chat-footer">
                    <div class="chat-tokens">
                        <span>500</span> <?php esc_html_e('tokens remaining', 'nova-ui'); ?>
                    </div>
                    <a href="#" class="chat-view-all"><?php esc_html_e('View all conversations', 'nova-ui'); ?> →</a>
                </div>
            </div>
        </div>
        
        <!-- Quick Links Widget -->
        <div class="card quick-links-card">
            <div class="card-header">
                <div class="card-title">
                    <i class="ti ti-link"></i>
                    <h2><?php esc_html_e('Quick Links', 'nova-ui'); ?></h2>
                </div>
                <div class="card-actions">
                    <button class="btn btn-sm btn-primary">
                        <i class="ti ti-plus"></i>
                        <span><?php esc_html_e('New', 'nova-ui'); ?></span>
                    </button>
                </div>
            </div>
            
            <div class="card-body">
                <div class="quick-links-list">
                    <div class="quick-link-item">
                        <div class="quick-link-content">
                            <h3 class="quick-link-title"><?php esc_html_e('Product Portfolio', 'nova-ui'); ?></h3>
                            <div class="quick-link-views">1243 <?php esc_html_e('views', 'nova-ui'); ?></div>
                        </div>
                        <div class="quick-link-actions">
                            <button class="btn btn-sm btn-outline"><?php esc_html_e('Edit', 'nova-ui'); ?></button>
                        </div>
                    </div>
                    
                    <div class="quick-link-item">
                        <div class="quick-link-content">
                            <h3 class="quick-link-title"><?php esc_html_e('Company Dashboard', 'nova-ui'); ?></h3>
                            <div class="quick-link-views">842 <?php esc_html_e('views', 'nova-ui'); ?></div>
                        </div>
                        <div class="quick-link-actions">
                            <button class="btn btn-sm btn-outline"><?php esc_html_e('Edit', 'nova-ui'); ?></button>
                        </div>
                    </div>
                    
                    <div class="quick-link-item">
                        <div class="quick-link-content">
                            <h3 class="quick-link-title"><?php esc_html_e('Support Resources', 'nova-ui'); ?></h3>
                            <div class="quick-link-views">568 <?php esc_html_e('views', 'nova-ui'); ?></div>
                        </div>
                        <div class="quick-link-actions">
                            <button class="btn btn-sm btn-outline"><?php esc_html_e('Edit', 'nova-ui'); ?></button>
                        </div>
                    </div>
                </div>
                
                <div class="view-all-container">
                    <a href="#" class="view-all-link"><?php esc_html_e('View All Links', 'nova-ui'); ?></a>
                </div>
            </div>
        </div>
        
        <!-- Help Widget -->
        <div class="help-widget-floating">
            <div class="help-widget-icon">
                <i class="ti ti-help-circle"></i>
            </div>
            <div class="help-widget-text">
                <span><?php esc_html_e('Need help?', 'nova-ui'); ?></span>
                <span class="help-widget-subtext"><?php esc_html_e('Check out the docs', 'nova-ui'); ?></span>
            </div>
        </div>
    </div>
</main><!-- #primary -->

<?php
get_footer();
