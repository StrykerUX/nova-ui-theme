<?php
/**
 * Template part para mostrar el sidebar del dashboard
 *
 * @package NovaUI
 */
?>

<div class="dashboard-sidebar">
    <div class="dashboard-sidebar-header">
        <div class="dashboard-logo">
            <div class="dashboard-logo-icon">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M15 6v12a3 3 0 1 0 3-3H6a3 3 0 1 0 3 3V6a3 3 0 1 0-3 3h12a3 3 0 1 0-3-3"></path>
                </svg>
            </div>
            <div class="dashboard-logo-text">
                <?php 
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<strong>Nova<span style="color: var(--color-primary);">UI</span></strong>';
                }
                ?>
            </div>
        </div>
        
        <button class="dashboard-toggle-sidebar" aria-label="<?php esc_attr_e('Toggle sidebar', 'novaui'); ?>">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M19 12H5M12 19l-7-7 7-7"></path>
            </svg>
        </button>
    </div>
    
    <div class="dashboard-nav">
        <div class="dashboard-nav-title">
            <?php esc_html_e('Main Menu', 'novaui'); ?>
        </div>
        
        <ul class="dashboard-nav-items">
            <li class="dashboard-nav-item">
                <a href="<?php echo esc_url(home_url('/dashboard/')); ?>" class="dashboard-nav-link <?php echo (is_page('dashboard')) ? 'active' : ''; ?>">
                    <span class="dashboard-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                    </span>
                    <span class="dashboard-nav-text"><?php esc_html_e('Dashboard', 'novaui'); ?></span>
                </a>
            </li>
            
            <li class="dashboard-nav-item">
                <a href="<?php echo esc_url(home_url('/analytics/')); ?>" class="dashboard-nav-link <?php echo (is_page('analytics')) ? 'active' : ''; ?>">
                    <span class="dashboard-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="18" y1="20" x2="18" y2="10"></line>
                            <line x1="12" y1="20" x2="12" y2="4"></line>
                            <line x1="6" y1="20" x2="6" y2="14"></line>
                        </svg>
                    </span>
                    <span class="dashboard-nav-text"><?php esc_html_e('Analytics', 'novaui'); ?></span>
                </a>
            </li>
            
            <li class="dashboard-nav-item">
                <a href="<?php echo esc_url(home_url('/chat-ai/')); ?>" class="dashboard-nav-link <?php echo (is_page('chat-ai')) ? 'active' : ''; ?>">
                    <span class="dashboard-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path>
                        </svg>
                    </span>
                    <span class="dashboard-nav-text"><?php esc_html_e('Chat AI', 'novaui'); ?></span>
                </a>
            </li>
            
            <li class="dashboard-nav-item">
                <a href="<?php echo esc_url(home_url('/quick-links/')); ?>" class="dashboard-nav-link <?php echo (is_page('quick-links')) ? 'active' : ''; ?>">
                    <span class="dashboard-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path>
                            <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path>
                        </svg>
                    </span>
                    <span class="dashboard-nav-text"><?php esc_html_e('Quick Links', 'novaui'); ?></span>
                </a>
            </li>
            
            <li class="dashboard-nav-item">
                <a href="<?php echo esc_url(home_url('/documents/')); ?>" class="dashboard-nav-link <?php echo (is_page('documents')) ? 'active' : ''; ?>">
                    <span class="dashboard-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                            <polyline points="14 2 14 8 20 8"></polyline>
                            <line x1="16" y1="13" x2="8" y2="13"></line>
                            <line x1="16" y1="17" x2="8" y2="17"></line>
                            <polyline points="10 9 9 9 8 9"></polyline>
                        </svg>
                    </span>
                    <span class="dashboard-nav-text"><?php esc_html_e('Documents', 'novaui'); ?></span>
                </a>
            </li>
        </ul>
        
        <div class="dashboard-nav-title">
            <?php esc_html_e('Account', 'novaui'); ?>
        </div>
        
        <ul class="dashboard-nav-items">
            <li class="dashboard-nav-item">
                <a href="<?php echo esc_url(home_url('/settings/')); ?>" class="dashboard-nav-link <?php echo (is_page('settings')) ? 'active' : ''; ?>">
                    <span class="dashboard-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="3"></circle>
                            <path d="M19.4 15a1.65 1.65 0 0 0 .33 1.82l.06.06a2 2 0 0 1 0 2.83 2 2 0 0 1-2.83 0l-.06-.06a1.65 1.65 0 0 0-1.82-.33 1.65 1.65 0 0 0-1 1.51V21a2 2 0 0 1-2 2 2 2 0 0 1-2-2v-.09A1.65 1.65 0 0 0 9 19.4a1.65 1.65 0 0 0-1.82.33l-.06.06a2 2 0 0 1-2.83 0 2 2 0 0 1 0-2.83l.06-.06a1.65 1.65 0 0 0 .33-1.82 1.65 1.65 0 0 0-1.51-1H3a2 2 0 0 1-2-2 2 2 0 0 1 2-2h.09A1.65 1.65 0 0 0 4.6 9a1.65 1.65 0 0 0-.33-1.82l-.06-.06a2 2 0 0 1 0-2.83 2 2 0 0 1 2.83 0l.06.06a1.65 1.65 0 0 0 1.82.33H9a1.65 1.65 0 0 0 1-1.51V3a2 2 0 0 1 2-2 2 2 0 0 1 2 2v.09a1.65 1.65 0 0 0 1 1.51 1.65 1.65 0 0 0 1.82-.33l.06-.06a2 2 0 0 1 2.83 0 2 2 0 0 1 0 2.83l-.06.06a1.65 1.65 0 0 0-.33 1.82V9a1.65 1.65 0 0 0 1.51 1H21a2 2 0 0 1 2 2 2 2 0 0 1-2 2h-.09a1.65 1.65 0 0 0-1.51 1z"></path>
                        </svg>
                    </span>
                    <span class="dashboard-nav-text"><?php esc_html_e('Settings', 'novaui'); ?></span>
                </a>
            </li>
            
            <li class="dashboard-nav-item">
                <a href="<?php echo esc_url(home_url('/membership/')); ?>" class="dashboard-nav-link <?php echo (is_page('membership')) ? 'active' : ''; ?>">
                    <span class="dashboard-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M19 21V5a2 2 0 0 0-2-2H7a2 2 0 0 0-2 2v16"></path>
                            <path d="M9 21h10a2 2 0 0 0 2-2v-8a2 2 0 0 0-2-2h-6l-4-3v13z"></path>
                        </svg>
                    </span>
                    <span class="dashboard-nav-text"><?php esc_html_e('Membership', 'novaui'); ?></span>
                </a>
            </li>
            
            <li class="dashboard-nav-item">
                <a href="<?php echo esc_url(wp_logout_url(home_url())); ?>" class="dashboard-nav-link">
                    <span class="dashboard-nav-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                    </span>
                    <span class="dashboard-nav-text"><?php esc_html_e('Log Out', 'novaui'); ?></span>
                </a>
            </li>
        </ul>
    </div>
    
    <div class="dashboard-sidebar-footer">
        <div class="dashboard-help-card">
            <div class="dashboard-help-icon">
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <circle cx="12" cy="12" r="10"></circle>
                    <path d="M9.09 9a3 3 0 0 1 5.83 1c0 2-3 3-3 3"></path>
                    <line x1="12" y1="17" x2="12.01" y2="17"></line>
                </svg>
            </div>
            <div class="dashboard-help-text">
                <h3 class="dashboard-help-title"><?php esc_html_e('Need help?', 'novaui'); ?></h3>
                <p class="dashboard-help-desc"><?php esc_html_e('Check out the docs', 'novaui'); ?></p>
            </div>
        </div>
    </div>
</div>

<?php
// Añadir un overlay para cerrar el sidebar en móvil
?>
<div class="dashboard-overlay"></div>
