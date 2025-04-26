<?php
/**
 * Dashboard Example - Con estilo Neo-Brutalista
 * Este archivo representa el diseño de dashboard que se ve en la imagen de referencia
 * 
 * @package NovaUI
 */
?>

<!-- Encabezado de página con acciones -->
<div class="dashboard-page-header">
    <h1 class="dashboard-page-title">Dashboard</h1>
    <div class="dashboard-page-actions">
        <a href="#" class="btn-dashboard btn-dashboard-secondary">
            <span>Export</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"></path><polyline points="7 10 12 15 17 10"></polyline><line x1="12" y1="15" x2="12" y2="3"></line></svg>
        </a>
        <a href="#" class="btn-dashboard btn-dashboard-primary">
            <span>New Report</span>
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="5" x2="12" y2="19"></line><line x1="5" y1="12" x2="19" y2="12"></line></svg>
        </a>
    </div>
</div>

<!-- Tarjetas de estadísticas -->
<div class="stats-cards">
    <!-- Tarjeta de ingresos -->
    <div class="stats-card">
        <div class="stats-card-content">
            <div class="stats-card-header">
                <div>
                    <p class="stats-card-title">Total Revenue</p>
                    <h3 class="stats-card-value">$124,592.40</h3>
                </div>
                <div class="stats-card-icon primary">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="12" y1="1" x2="12" y2="23"></line><path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path></svg>
                </div>
            </div>
            <div class="stats-card-change">
                <span class="stats-card-badge positive">+12.4%</span>
                <span class="stats-card-period">vs last month</span>
            </div>
        </div>
    </div>
    
    <!-- Tarjeta de usuarios activos -->
    <div class="stats-card">
        <div class="stats-card-content">
            <div class="stats-card-header">
                <div>
                    <p class="stats-card-title">Active Users</p>
                    <h3 class="stats-card-value">4,893</h3>
                </div>
                <div class="stats-card-icon success">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
            </div>
            <div class="stats-card-change">
                <span class="stats-card-badge positive">+17.2%</span>
                <span class="stats-card-period">vs last month</span>
            </div>
        </div>
    </div>
    
    <!-- Tarjeta de tasa de conversión -->
    <div class="stats-card">
        <div class="stats-card-content">
            <div class="stats-card-header">
                <div>
                    <p class="stats-card-title">Conversion Rate</p>
                    <h3 class="stats-card-value">3.42%</h3>
                </div>
                <div class="stats-card-icon error">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="22 12 18 12 15 21 9 3 6 12 2 12"></polyline></svg>
                </div>
            </div>
            <div class="stats-card-change">
                <span class="stats-card-badge negative">-2.1%</span>
                <span class="stats-card-period">vs last month</span>
            </div>
        </div>
    </div>
</div>

<!-- Widgets principales (2 columnas) -->
<div class="main-widgets">
    <!-- Widget de Chat IA (2/3 del ancho) -->
    <div class="widget-chat">
        <div class="widget-header">
            <h2 class="widget-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"></path></svg>
                Chat AI
            </h2>
            <span class="widget-badge">ACTIVE</span>
        </div>
        <div class="widget-content">
            <div class="chat-container">
                <!-- Mensaje del AI -->
                <div class="chat-message">
                    <div class="chat-avatar ai">AI</div>
                    <div class="chat-bubble ai">
                        <p class="chat-text">I can analyze your recent sales data and provide insights on trends. Your revenue has increased 12.4% compared to last month. Would you like a detailed breakdown?</p>
                    </div>
                </div>
                
                <!-- Mensaje del usuario -->
                <div class="chat-message chat-user">
                    <div class="chat-avatar user">M</div>
                    <div class="chat-bubble user">
                        <p class="chat-text">Yes, show me the breakdown by product category and highlight the best performers.</p>
                    </div>
                </div>
            </div>
            
            <!-- Formulario de chat -->
            <form class="chat-form">
                <input type="text" class="chat-input" placeholder="Ask AI assistant..." />
                <button type="submit" class="chat-submit">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="22" y1="2" x2="11" y2="13"></line><polygon points="22 2 15 22 11 13 2 9 22 2"></polygon></svg>
                    Send
                </button>
            </form>
            
            <!-- Footer del chat -->
            <div class="chat-footer">
                <span class="chat-tokens">
                    <span class="chat-tokens-value">500</span> tokens remaining
                </span>
                <a href="#" class="chat-view-all">View all conversations →</a>
            </div>
        </div>
    </div>
    
    <!-- Widget de Quick Links (1/3 del ancho) -->
    <div class="widget-quicklinks">
        <div class="widget-header">
            <h2 class="widget-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"></path><path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"></path></svg>
                Quick Links
            </h2>
            <button class="btn-dashboard btn-dashboard-small btn-dashboard-accent">+ New</button>
        </div>
        <div class="widget-content">
            <div class="quicklink-list">
                <!-- Enlaces rápidos -->
                <div class="quicklink-item">
                    <div class="quicklink-info">
                        <h3>Product Portfolio</h3>
                        <span class="quicklink-views">1243 views</span>
                    </div>
                    <button class="quicklink-action">Edit</button>
                </div>
                
                <div class="quicklink-item">
                    <div class="quicklink-info">
                        <h3>Company Dashboard</h3>
                        <span class="quicklink-views">842 views</span>
                    </div>
                    <button class="quicklink-action">Edit</button>
                </div>
                
                <div class="quicklink-item">
                    <div class="quicklink-info">
                        <h3>Support Resources</h3>
                        <span class="quicklink-views">568 views</span>
                    </div>
                    <button class="quicklink-action">Edit</button>
                </div>
                
                <a href="#" class="view-all-links">View All Links</a>
            </div>
        </div>
    </div>
</div>

<!-- Widgets secundarios (2 columnas) -->
<div class="secondary-widgets">
    <!-- Widget de Tareas -->
    <div class="widget-tasks">
        <div class="widget-header">
            <h2 class="widget-title">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                Upcoming Tasks
            </h2>
            <select class="widget-header-actions">
                <option>Today</option>
                <option>This Week</option>
                <option>This Month</option>
            </select>
        </div>
        <div class="widget-content">
            <div class="task-list">
                <!-- Tareas -->
                <div class="task-item">
                    <div class="task-check">
                        <div class="task-checkbox"></div>
                        <div class="task-info">
                            <h3 class="task-title">Update Quick Links interface</h3>
                            <span class="task-time">10:00 AM</span>
                        </div>
                    </div>
                    <span class="task-priority high">High</span>
                </div>
                
                <div class="task-item">
                    <div class="task-check">
                        <div class="task-checkbox"></div>
                        <div class="task-info">
                            <h3 class="task-title">Review Chat IA performance</h3>
                            <span class="task-time">1:30 PM</span>
                        </div>
                    </div>
                    <span class="task-priority medium">Medium</span>
                </div>
                
                <div class="task-item">
                    <div class="task-check">
                        <div class="task-checkbox"></div>
                        <div class="task-info">
                            <h3 class="task-title">Team meeting - Sprint planning</h3>
                            <span class="task-time">3:00 PM</span>
                        </div>
                    </div>
                    <span class="task-priority high">High</span>
                </div>
                
                <div class="task-item">
                    <div class="task-check">
                        <div class="task-checkbox"></div>
                        <div class="task-info">
                            <h3 class="task-title">Prepare monthly report</h3>
                            <span class="task-time">5:00 PM</span>
                        </div>
                    </div>
                    <span class="task-priority low">Low</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Widget de Membresía -->
    <div class="widget-membership">
        <div class="membership-progress-bar"></div>
        <div class="widget-content">
            <div class="membership-header">
                <div class="membership-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polygon points="5 3 19 12 5 21 5 3"></polygon></svg>
                </div>
                <div class="membership-info">
                    <h2 class="membership-plan">Professional Plan</h2>
                    <p class="membership-expires">Active until May 26, 2025</p>
                </div>
            </div>
            
            <div class="membership-resources">
                <div class="resource-header">
                    <span class="resource-name">IA Tokens</span>
                    <span class="resource-value">500/2000</span>
                </div>
                <div class="resource-progress">
                    <div class="resource-bar" style="width: 25%;"></div>
                </div>
                <p class="resource-info">Tokens reset in 16 days</p>
            </div>
            
            <div class="membership-stats">
                <div class="stat-card">
                    <p class="stat-label">Quick Links</p>
                    <p class="stat-value">3<span class="stat-max">/10</span></p>
                </div>
                <div class="stat-card">
                    <p class="stat-label">Users</p>
                    <p class="stat-value">2<span class="stat-max">/5</span></p>
                </div>
            </div>
            
            <button class="upgrade-button">Upgrade Plan</button>
            
            <!-- Elementos decorativos de UI de videojuego -->
            <div class="membership-decorative">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="membership-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="membership-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="currentColor" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="membership-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
            </div>
        </div>
    </div>
</div>
