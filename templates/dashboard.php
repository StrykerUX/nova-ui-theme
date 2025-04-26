<?php
/**
 * Template Name: Dashboard
 * 
 * Plantilla para mostrar la página de dashboard con estilo Soft Neobrutalism
 *
 * @package NovaUI
 */

// Forzar modo dashboard
$GLOBALS['novaui_is_dashboard'] = true;

get_header();
?>

<div class="dashboard-layout">
    <!-- Sidebar -->
    <aside class="dashboard-sidebar">
        <div class="dashboard-brand">
            <div class="dashboard-logo">
                <i class="fas fa-gamepad"></i>
            </div>
            <span class="dashboard-brand-text">Nova<span class="dashboard-brand-accent">UI</span></span>
            <button class="sidebar-toggle" aria-label="<?php esc_attr_e('Alternar sidebar', 'novaui'); ?>">
                <i class="fas fa-bars"></i>
            </button>
        </div>
        
        <nav class="dashboard-nav">
            <ul class="dashboard-nav-list">
                <li class="dashboard-nav-item">
                    <a href="#" class="dashboard-nav-link active">
                        <span class="dashboard-nav-icon"><i class="fas fa-home"></i></span>
                        <span class="dashboard-nav-text"><?php esc_html_e('Dashboard', 'novaui'); ?></span>
                    </a>
                </li>
                <li class="dashboard-nav-item">
                    <a href="#" class="dashboard-nav-link">
                        <span class="dashboard-nav-icon"><i class="fas fa-chart-bar"></i></span>
                        <span class="dashboard-nav-text"><?php esc_html_e('Analytics', 'novaui'); ?></span>
                    </a>
                </li>
                <li class="dashboard-nav-item">
                    <a href="#" class="dashboard-nav-link">
                        <span class="dashboard-nav-icon"><i class="fas fa-comment"></i></span>
                        <span class="dashboard-nav-text"><?php esc_html_e('Chat AI', 'novaui'); ?></span>
                    </a>
                </li>
                <li class="dashboard-nav-item">
                    <a href="#" class="dashboard-nav-link">
                        <span class="dashboard-nav-icon"><i class="fas fa-link"></i></span>
                        <span class="dashboard-nav-text"><?php esc_html_e('Quick Links', 'novaui'); ?></span>
                    </a>
                </li>
                <li class="dashboard-nav-item">
                    <a href="#" class="dashboard-nav-link">
                        <span class="dashboard-nav-icon"><i class="fas fa-file-alt"></i></span>
                        <span class="dashboard-nav-text"><?php esc_html_e('Documents', 'novaui'); ?></span>
                    </a>
                </li>
                <li class="dashboard-nav-item">
                    <a href="#" class="dashboard-nav-link">
                        <span class="dashboard-nav-icon"><i class="fas fa-calendar"></i></span>
                        <span class="dashboard-nav-text"><?php esc_html_e('Calendar', 'novaui'); ?></span>
                    </a>
                </li>
                <li class="dashboard-nav-item">
                    <a href="#" class="dashboard-nav-link">
                        <span class="dashboard-nav-icon"><i class="fas fa-briefcase"></i></span>
                        <span class="dashboard-nav-text"><?php esc_html_e('Projects', 'novaui'); ?></span>
                    </a>
                </li>
                <li class="dashboard-nav-item">
                    <a href="#" class="dashboard-nav-link">
                        <span class="dashboard-nav-icon"><i class="fas fa-cog"></i></span>
                        <span class="dashboard-nav-text"><?php esc_html_e('Settings', 'novaui'); ?></span>
                    </a>
                </li>
            </ul>
        </nav>
        
        <div class="dashboard-help">
            <div class="d-flex align-items-center">
                <div class="dashboard-help-icon">
                    <i class="fas fa-question-circle"></i>
                </div>
                <div class="dashboard-help-content">
                    <p class="dashboard-help-title"><?php esc_html_e('Need help?', 'novaui'); ?></p>
                    <p class="dashboard-help-text"><?php esc_html_e('Check out the docs', 'novaui'); ?></p>
                </div>
            </div>
        </div>
    </aside>
    
    <!-- Header -->
    <header class="dashboard-header">
        <div class="dashboard-search">
            <span class="dashboard-search-icon"><i class="fas fa-search"></i></span>
            <input type="text" class="dashboard-search-input" placeholder="<?php esc_attr_e('Search...', 'novaui'); ?>">
            <span class="dashboard-search-shortcut">⌘K</span>
        </div>
        
        <div class="dashboard-actions">
            <button class="dashboard-action-btn" aria-label="<?php esc_attr_e('Notificaciones', 'novaui'); ?>">
                <i class="fas fa-bell"></i>
            </button>
            
            <button class="theme-toggle-btn" aria-label="<?php esc_attr_e('Cambiar tema', 'novaui'); ?>">
                <span class="theme-toggle-dark"><i class="fas fa-moon"></i></span>
                <span class="theme-toggle-light"><i class="fas fa-sun"></i></span>
            </button>
            
            <div class="user-menu">
                <button class="user-btn">
                    <div class="user-avatar">M</div>
                    <span class="user-name">Miguel R.</span>
                    <i class="fas fa-chevron-down ml-1 text-gray-500"></i>
                </button>
                
                <div class="user-dropdown">
                    <a href="#" class="user-dropdown-item"><?php esc_html_e('Profile', 'novaui'); ?></a>
                    <a href="#" class="user-dropdown-item"><?php esc_html_e('Settings', 'novaui'); ?></a>
                    <a href="#" class="user-dropdown-item"><?php esc_html_e('Subscription', 'novaui'); ?></a>
                    <a href="#" class="user-dropdown-item"><?php esc_html_e('Sign out', 'novaui'); ?></a>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Contenido principal -->
    <main class="dashboard-content">
        <!-- Encabezado de página -->
        <div class="page-header">
            <h1 class="page-title"><?php esc_html_e('Dashboard', 'novaui'); ?></h1>
            
            <div class="page-actions">
                <button class="page-action-btn page-action-btn-secondary">
                    <span><?php esc_html_e('Export', 'novaui'); ?></span>
                    <i class="fas fa-download page-action-btn-icon"></i>
                </button>
                
                <button class="page-action-btn page-action-btn-primary">
                    <span><?php esc_html_e('New Report', 'novaui'); ?></span>
                    <i class="fas fa-plus page-action-btn-icon"></i>
                </button>
            </div>
        </div>
        
        <!-- Tarjetas de estadísticas -->
        <div class="stats-grid">
            <div class="stats-card">
                <div class="stats-card-header">
                    <div>
                        <p class="stats-card-title"><?php esc_html_e('Total Revenue', 'novaui'); ?></p>
                        <h3 class="stats-card-value">$124,592.40</h3>
                    </div>
                    <div class="stats-card-icon primary">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="stats-card-change positive">+12.4%</span>
                    <span class="stats-card-period"><?php esc_html_e('vs last month', 'novaui'); ?></span>
                </div>
            </div>
            
            <div class="stats-card">
                <div class="stats-card-header">
                    <div>
                        <p class="stats-card-title"><?php esc_html_e('Active Users', 'novaui'); ?></p>
                        <h3 class="stats-card-value">4,893</h3>
                    </div>
                    <div class="stats-card-icon success">
                        <i class="fas fa-users"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="stats-card-change positive">+17.2%</span>
                    <span class="stats-card-period"><?php esc_html_e('vs last month', 'novaui'); ?></span>
                </div>
            </div>
            
            <div class="stats-card">
                <div class="stats-card-header">
                    <div>
                        <p class="stats-card-title"><?php esc_html_e('Conversion Rate', 'novaui'); ?></p>
                        <h3 class="stats-card-value">3.42%</h3>
                    </div>
                    <div class="stats-card-icon error">
                        <i class="fas fa-chart-line"></i>
                    </div>
                </div>
                <div class="mt-4">
                    <span class="stats-card-change negative">-2.1%</span>
                    <span class="stats-card-period"><?php esc_html_e('vs last month', 'novaui'); ?></span>
                </div>
            </div>
        </div>
        
        <!-- Widgets principales -->
        <div class="widgets-grid">
            <!-- Widget de Chat AI -->
            <div class="widget">
                <div class="widget-header">
                    <h2 class="widget-title">
                        <i class="fas fa-comment widget-title-icon"></i>
                        <?php esc_html_e('Chat AI', 'novaui'); ?>
                    </h2>
                    <span class="widget-badge"><?php esc_html_e('ACTIVE', 'novaui'); ?></span>
                </div>
                
                <div class="widget-content">
                    <div class="chat-container">
                        <!-- Mensaje AI -->
                        <div class="chat-message">
                            <div class="chat-avatar ai">AI</div>
                            <div class="chat-bubble ai">
                                <p><?php esc_html_e('I can analyze your recent sales data and provide insights on trends. Your revenue has increased 12.4% compared to last month. Would you like a detailed breakdown?', 'novaui'); ?></p>
                            </div>
                        </div>
                        
                        <!-- Mensaje Usuario -->
                        <div class="chat-message user-message">
                            <div class="chat-bubble user">
                                <p><?php esc_html_e('Yes, show me the breakdown by product category and highlight the best performers.', 'novaui'); ?></p>
                            </div>
                            <div class="chat-avatar user">M</div>
                        </div>
                    </div>
                    
                    <div class="chat-form">
                        <input type="text" class="chat-input" placeholder="<?php esc_attr_e('Ask AI assistant...', 'novaui'); ?>">
                        <button class="chat-send">
                            <i class="fas fa-paper-plane chat-send-icon"></i>
                            <?php esc_html_e('Send', 'novaui'); ?>
                        </button>
                    </div>
                    
                    <div class="chat-footer">
                        <span class="chat-tokens">
                            <span class="chat-tokens-count">500</span> <?php esc_html_e('tokens remaining', 'novaui'); ?>
                        </span>
                        <a href="#" class="chat-view-all"><?php esc_html_e('View all conversations →', 'novaui'); ?></a>
                    </div>
                </div>
            </div>
            
            <!-- Widget de Quick Links -->
            <div class="widget">
                <div class="widget-header">
                    <h2 class="widget-title">
                        <i class="fas fa-link widget-title-icon"></i>
                        <?php esc_html_e('Quick Links', 'novaui'); ?>
                    </h2>
                    <button class="widget-badge" style="background-color: var(--color-accent); color: var(--color-dark); border-color: var(--color-accent);">+ <?php esc_html_e('New', 'novaui'); ?></button>
                </div>
                
                <div class="widget-content">
                    <div class="quick-links-list">
                        <div class="quick-link-item">
                            <div class="quick-link-info">
                                <p class="quick-link-title"><?php esc_html_e('Product Portfolio', 'novaui'); ?></p>
                                <span class="quick-link-views">1243 <?php esc_html_e('views', 'novaui'); ?></span>
                            </div>
                            <button class="quick-link-edit"><?php esc_html_e('Edit', 'novaui'); ?></button>
                        </div>
                        
                        <div class="quick-link-item">
                            <div class="quick-link-info">
                                <p class="quick-link-title"><?php esc_html_e('Company Dashboard', 'novaui'); ?></p>
                                <span class="quick-link-views">842 <?php esc_html_e('views', 'novaui'); ?></span>
                            </div>
                            <button class="quick-link-edit"><?php esc_html_e('Edit', 'novaui'); ?></button>
                        </div>
                        
                        <div class="quick-link-item">
                            <div class="quick-link-info">
                                <p class="quick-link-title"><?php esc_html_e('Support Resources', 'novaui'); ?></p>
                                <span class="quick-link-views">568 <?php esc_html_e('views', 'novaui'); ?></span>
                            </div>
                            <button class="quick-link-edit"><?php esc_html_e('Edit', 'novaui'); ?></button>
                        </div>
                    </div>
                    
                    <a href="#" class="quick-link-add"><?php esc_html_e('View All Links', 'novaui'); ?></a>
                </div>
            </div>
        </div>
        
        <!-- Widgets secundarios -->
        <div class="widgets-grid">
            <!-- Widget de Tareas Pendientes -->
            <div class="widget">
                <div class="widget-header">
                    <h2 class="widget-title">
                        <i class="fas fa-clock widget-title-icon" style="color: var(--color-warning);"></i>
                        <?php esc_html_e('Upcoming Tasks', 'novaui'); ?>
                    </h2>
                    <select class="form-select">
                        <option><?php esc_html_e('Today', 'novaui'); ?></option>
                        <option><?php esc_html_e('This Week', 'novaui'); ?></option>
                        <option><?php esc_html_e('This Month', 'novaui'); ?></option>
                    </select>
                </div>
                
                <div class="widget-content">
                    <div class="quick-links-list">
                        <div class="quick-link-item">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="task-checkbox">
                                <div class="quick-link-info ml-3">
                                    <p class="quick-link-title"><?php esc_html_e('Update Quick Links interface', 'novaui'); ?></p>
                                    <span class="quick-link-views">10:00 AM</span>
                                </div>
                            </div>
                            <span class="task-priority high"><?php esc_html_e('High', 'novaui'); ?></span>
                        </div>
                        
                        <div class="quick-link-item">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="task-checkbox">
                                <div class="quick-link-info ml-3">
                                    <p class="quick-link-title"><?php esc_html_e('Review Chat IA performance', 'novaui'); ?></p>
                                    <span class="quick-link-views">1:30 PM</span>
                                </div>
                            </div>
                            <span class="task-priority medium"><?php esc_html_e('Medium', 'novaui'); ?></span>
                        </div>
                        
                        <div class="quick-link-item">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="task-checkbox">
                                <div class="quick-link-info ml-3">
                                    <p class="quick-link-title"><?php esc_html_e('Team meeting - Sprint planning', 'novaui'); ?></p>
                                    <span class="quick-link-views">3:00 PM</span>
                                </div>
                            </div>
                            <span class="task-priority high"><?php esc_html_e('High', 'novaui'); ?></span>
                        </div>
                        
                        <div class="quick-link-item">
                            <div class="d-flex align-items-center">
                                <input type="checkbox" class="task-checkbox">
                                <div class="quick-link-info ml-3">
                                    <p class="quick-link-title"><?php esc_html_e('Prepare monthly report', 'novaui'); ?></p>
                                    <span class="quick-link-views">5:00 PM</span>
                                </div>
                            </div>
                            <span class="task-priority low"><?php esc_html_e('Low', 'novaui'); ?></span>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Widget de Plan de Membresía -->
            <div class="widget">
                <div class="widget-header">
                    <h2 class="widget-title">
                        <i class="fas fa-play widget-title-icon" style="color: var(--game-xp);"></i>
                        <?php esc_html_e('Professional Plan', 'novaui'); ?>
                    </h2>
                    <span class="widget-subtitle"><?php esc_html_e('Active until May 26, 2025', 'novaui'); ?></span>
                </div>
                
                <div class="widget-content">
                    <div class="membership-status">
                        <p class="membership-title"><?php esc_html_e('IA Tokens', 'novaui'); ?></p>
                        <div class="membership-status-header">
                            <span class="membership-count">500/2000</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-value" style="width: 25%;"></div>
                        </div>
                        <p class="membership-reset"><?php esc_html_e('Tokens reset in 16 days', 'novaui'); ?></p>
                    </div>
                    
                    <div class="membership-features">
                        <div class="feature-box">
                            <p class="feature-title"><?php esc_html_e('Quick Links', 'novaui'); ?></p>
                            <p class="feature-value">3<span class="feature-limit">/10</span></p>
                        </div>
                        
                        <div class="feature-box">
                            <p class="feature-title"><?php esc_html_e('Users', 'novaui'); ?></p>
                            <p class="feature-value">2<span class="feature-limit">/5</span></p>
                        </div>
                    </div>
                    
                    <button class="membership-upgrade">
                        <?php esc_html_e('Upgrade Plan', 'novaui'); ?>
                    </button>
                </div>
            </div>
        </div>
    </main>
</div>

<?php
// No incluir el footer estándar, ya que tenemos nuestra propia estructura para el dashboard
// get_footer();
?>

<!-- Scripts adicionales específicos para el dashboard -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Simular interacción con el Chat AI
        const chatInput = document.querySelector('.chat-input');
        const chatSend = document.querySelector('.chat-send');
        const chatContainer = document.querySelector('.chat-container');
        
        if (chatInput && chatSend && chatContainer) {
            chatSend.addEventListener('click', function() {
                if (chatInput.value.trim() !== '') {
                    // Añadir mensaje del usuario
                    const userMessage = document.createElement('div');
                    userMessage.className = 'chat-message user-message';
                    userMessage.innerHTML = `
                        <div class="chat-bubble user">
                            <p>${chatInput.value}</p>
                        </div>
                        <div class="chat-avatar user">M</div>
                    `;
                    chatContainer.appendChild(userMessage);
                    
                    // Simular respuesta del AI después de un breve retraso
                    setTimeout(function() {
                        const aiResponse = document.createElement('div');
                        aiResponse.className = 'chat-message';
                        aiResponse.innerHTML = `
                            <div class="chat-avatar ai">AI</div>
                            <div class="chat-bubble ai">
                                <p>Here's the breakdown of sales by category. The top performer is "Software Services" with a 28% increase compared to last month.</p>
                            </div>
                        `;
                        chatContainer.appendChild(aiResponse);
                        
                        // Scroll al fondo del chat
                        chatContainer.scrollTop = chatContainer.scrollHeight;
                        
                        // Actualizar contador de tokens
                        const tokensCount = document.querySelector('.chat-tokens-count');
                        if (tokensCount) {
                            tokensCount.textContent = '475';
                        }
                    }, 1000);
                    
                    // Limpiar input y hacer scroll
                    chatInput.value = '';
                    chatContainer.scrollTop = chatContainer.scrollHeight;
                }
            });
            
            // También permitir enviar presionando Enter
            chatInput.addEventListener('keypress', function(e) {
                if (e.key === 'Enter' && chatInput.value.trim() !== '') {
                    chatSend.click();
                }
            });
        }
    });
</script>

</body>
</html>
