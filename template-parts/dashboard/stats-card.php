<?php
/**
 * Template part para tarjetas de estadísticas en el dashboard
 *
 * @package NovaUI
 */

/**
 * Variables esperadas:
 * $icon - Clase de icono ej. 'nova-icon-dollar'
 * $title - Título de la tarjeta
 * $value - Valor principal a mostrar
 * $change - Porcentaje de cambio
 * $is_positive - Booleano que indica si el cambio es positivo
 * $color - Color del icono (opcional)
 */

// Valores por defecto
$icon = isset( $args['icon'] ) ? $args['icon'] : 'nova-icon-chart';
$title = isset( $args['title'] ) ? $args['title'] : esc_html__( 'Stats', 'nova-ui' );
$value = isset( $args['value'] ) ? $args['value'] : '0';
$change = isset( $args['change'] ) ? $args['change'] : '0%';
$is_positive = isset( $args['is_positive'] ) ? $args['is_positive'] : true;
$color = isset( $args['color'] ) ? $args['color'] : 'var(--color-primary)';
$period = isset( $args['period'] ) ? $args['period'] : esc_html__( 'vs last month', 'nova-ui' );

// Determinar clase para el badge de cambio
$change_class = $is_positive ? 'stats-card-badge--positive' : 'stats-card-badge--negative';

// Formatear cambio con signo
$change_formatted = $is_positive ? '+' . $change : $change;
?>

<div class="stats-card">
    <div class="stats-card-header">
        <h3 class="stats-card-title"><?php echo esc_html( $title ); ?></h3>
        <div class="stats-card-icon" style="background-color: <?php echo esc_attr( $color ); ?>">
            <i class="<?php echo esc_attr( $icon ); ?>"></i>
        </div>
    </div>
    <div class="stats-card-value"><?php echo esc_html( $value ); ?></div>
    <div class="stats-card-change">
        <span class="stats-card-badge <?php echo esc_attr( $change_class ); ?>">
            <?php echo esc_html( $change_formatted ); ?>
        </span>
        <span class="stats-card-period"><?php echo esc_html( $period ); ?></span>
    </div>
</div>
