<?php
/**
 * Template part para tareas próximas en el dashboard
 *
 * @package NovaUI
 */

/**
 * Variables esperadas (opcionales):
 * $limit - Número de tareas a mostrar
 * $period - Período de tiempo (today, week, month)
 */

// Valores por defecto
$limit = isset( $args['limit'] ) ? intval( $args['limit'] ) : 4;
$period = isset( $args['period'] ) ? $args['period'] : 'today';

// Esto es un template de ejemplo
// En una implementación real, se obtendrían las tareas de una fuente de datos

// Tareas de ejemplo
$tasks = array(
    array(
        'task' => esc_html__( 'Update Quick Links interface', 'nova-ui' ),
        'time' => '10:00 AM',
        'priority' => 'high',
    ),
    array(
        'task' => esc_html__( 'Review Chat IA performance', 'nova-ui' ),
        'time' => '1:30 PM',
        'priority' => 'medium',
    ),
    array(
        'task' => esc_html__( 'Team meeting - Sprint planning', 'nova-ui' ),
        'time' => '3:00 PM',
        'priority' => 'high',
    ),
    array(
        'task' => esc_html__( 'Prepare monthly report', 'nova-ui' ),
        'time' => '5:00 PM',
        'priority' => 'low',
    ),
);

// Limitar a la cantidad especificada
$tasks = array_slice( $tasks, 0, $limit );

// Mapeo de prioridades a clases CSS
$priority_classes = array(
    'high' => 'task-priority-high',
    'medium' => 'task-priority-medium',
    'low' => 'task-priority-low',
);

// Mapeo de prioridades a textos traducibles
$priority_labels = array(
    'high' => esc_html__( 'High', 'nova-ui' ),
    'medium' => esc_html__( 'Medium', 'nova-ui' ),
    'low' => esc_html__( 'Low', 'nova-ui' ),
);
?>

<div class="tasks-section">
    <div class="tasks-header">
        <h3 class="tasks-title">
            <i class="nova-icon-clock"></i>
            <?php esc_html_e( 'Upcoming Tasks', 'nova-ui' ); ?>
        </h3>
        <select class="tasks-period-selector">
            <option value="today" <?php selected( $period, 'today' ); ?>>
                <?php esc_html_e( 'Today', 'nova-ui' ); ?>
            </option>
            <option value="week" <?php selected( $period, 'week' ); ?>>
                <?php esc_html_e( 'This Week', 'nova-ui' ); ?>
            </option>
            <option value="month" <?php selected( $period, 'month' ); ?>>
                <?php esc_html_e( 'This Month', 'nova-ui' ); ?>
            </option>
        </select>
    </div>
    
    <div class="tasks-content">
        <?php if ( !empty( $tasks ) ) : ?>
            <div class="tasks-list">
                <?php foreach ( $tasks as $task ) : 
                    $priority_class = isset( $priority_classes[$task['priority']] ) ? $priority_classes[$task['priority']] : '';
                    $priority_label = isset( $priority_labels[$task['priority']] ) ? $priority_labels[$task['priority']] : $task['priority'];
                    ?>
                    <div class="task-item">
                        <div class="task-left">
                            <div class="task-checkbox"></div>
                            <div class="task-info">
                                <div class="task-title"><?php echo esc_html( $task['task'] ); ?></div>
                                <div class="task-time"><?php echo esc_html( $task['time'] ); ?></div>
                            </div>
                        </div>
                        <div class="task-priority <?php echo esc_attr( $priority_class ); ?>">
                            <?php echo esc_html( $priority_label ); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else : ?>
            <div class="tasks-empty">
                <p><?php esc_html_e( 'No upcoming tasks for this period.', 'nova-ui' ); ?></p>
            </div>
        <?php endif; ?>
    </div>
</div>
