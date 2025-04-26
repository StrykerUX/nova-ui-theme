/**
 * Nova UI - Scripts específicos para el Dashboard
 */

(function($) {
    'use strict';

    // Opciones para gráficos y visualizaciones
    const chartColors = {
        primary: '#FF6B6B',
        secondary: '#4ECDC4',
        accent: '#FF8A5B',
        success: '#9BC53D',
        warning: '#F9DC5C',
        danger: '#E84855',
        info: '#5BC0EB',
        light: '#f8f9fc',
        dark: '#333a45'
    };

    /**
     * Inicialización al cargar el documento
     */
    $(document).ready(function() {
        // Inicializar componentes específicos del dashboard
        initDashboardComponents();
        
        // Si existe ChartJS, inicializar gráficos
        if (typeof Chart !== 'undefined') {
            initCharts();
        }
        
        // Inicializar funcionalidades específicas
        initDashboardFunctions();
    });

    /**
     * Inicializar componentes del dashboard
     */
    function initDashboardComponents() {
        // Ejemplo: Actualizar contadores en tiempo real (simulado)
        initCounters();
        
        // Ejemplo: Tarjetas con animación al cargar
        animateCards();
        
        // Crear tooltip para widget de ayuda
        if (typeof $.fn.tooltip !== 'undefined') {
            $('.help-widget-floating').tooltip({
                title: 'Haz clic para ver documentación',
                placement: 'left'
            });
        }
    }

    /**
     * Inicializar contadores con animación
     */
    function initCounters() {
        // Si existe la biblioteca CountUp o similar, se podría usar aquí
        // Esta es una implementación simple para simular contadores
        
        $('.stats-value').each(function() {
            const $this = $(this);
            const finalValue = $this.text();
            const isNumber = !isNaN(parseFloat(finalValue.replace(/[$,]/g, '')));
            
            if (isNumber) {
                let startValue = '0';
                if (finalValue.includes('$')) {
                    startValue = '$0';
                }
                if (finalValue.includes('%')) {
                    startValue = '0%';
                }
                
                $this.text(startValue);
                
                // Simular animación simple
                setTimeout(function() {
                    $this.text(finalValue);
                }, 500);
            }
        });
    }

    /**
     * Animar tarjetas al cargar la página
     */
    function animateCards() {
        $('.card').each(function(index) {
            const $card = $(this);
            $card.css('opacity', 0);
            
            setTimeout(function() {
                $card.animate({
                    opacity: 1
                }, 300);
            }, index * 100);
        });
    }

    /**
     * Inicializar gráficos si existe ChartJS
     */
    function initCharts() {
        // Esta función solo se ejecuta si Chart.js está cargado
        
        // Ejemplo de gráfico de ingresos
        if ($('#revenueChart').length) {
            initRevenueChart();
        }
        
        // Ejemplo de gráfico de usuarios
        if ($('#usersChart').length) {
            initUsersChart();
        }
        
        // Ejemplo de gráfico de conversiones
        if ($('#conversionChart').length) {
            initConversionChart();
        }
    }

    /**
     * Inicializar gráfico de ingresos (ejemplo)
     */
    function initRevenueChart() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Ingresos',
                    data: [65000, 59000, 80000, 81000, 56000, 85000, 90000, 91000, 116000, 115000, 102000, 124000],
                    fill: false,
                    borderColor: chartColors.primary,
                    tension: 0.4,
                    pointBackgroundColor: chartColors.primary
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return '$ ' + context.raw.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return '$ ' + value.toLocaleString();
                            }
                        }
                    }
                }
            }
        });
    }

    /**
     * Inicializar gráfico de usuarios (ejemplo)
     */
    function initUsersChart() {
        const ctx = document.getElementById('usersChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Usuarios Activos',
                    data: [3100, 3300, 3500, 3800, 4000, 4100, 4300, 4500, 4600, 4700, 4800, 4893],
                    backgroundColor: chartColors.secondary,
                    borderRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    /**
     * Inicializar gráfico de conversiones (ejemplo)
     */
    function initConversionChart() {
        const ctx = document.getElementById('conversionChart').getContext('2d');
        
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
                datasets: [{
                    label: 'Tasa de Conversión (%)',
                    data: [3.8, 3.7, 3.6, 3.7, 3.5, 3.3, 3.4, 3.5, 3.6, 3.5, 3.4, 3.42],
                    fill: false,
                    borderColor: chartColors.accent,
                    tension: 0.4,
                    pointBackgroundColor: chartColors.accent
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        mode: 'index',
                        intersect: false,
                        callbacks: {
                            label: function(context) {
                                return context.raw.toFixed(2) + ' %';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: false,
                        ticks: {
                            callback: function(value) {
                                return value.toFixed(2) + ' %';
                            }
                        }
                    }
                }
            }
        });
    }

    /**
     * Inicializar funcionalidades específicas del dashboard
     */
    function initDashboardFunctions() {
        // Botón de exportar
        $('.page-actions .btn-outline').on('click', function(e) {
            e.preventDefault();
            alert('La funcionalidad de exportación no está implementada en esta versión de demostración.');
        });
        
        // Botón de nuevo reporte
        $('.page-actions .btn-primary').on('click', function(e) {
            e.preventDefault();
            alert('La funcionalidad de crear nuevo reporte no está implementada en esta versión de demostración.');
        });
        
        // Simular actualizaciones periódicas (para demo)
        setInterval(function() {
            updateRandomStat();
        }, 30000); // Cada 30 segundos
    }

    /**
     * Actualizar aleatoriamente una estadística (solo para demo)
     */
    function updateRandomStat() {
        const $stats = $('.stats-card');
        const randomIndex = Math.floor(Math.random() * $stats.length);
        const $selectedStat = $stats.eq(randomIndex);
        
        // Añadir clase de animación
        $selectedStat.addClass('card-pulse');
        
        // Quitar la clase después de la animación
        setTimeout(function() {
            $selectedStat.removeClass('card-pulse');
        }, 1000);
    }

})(jQuery);
