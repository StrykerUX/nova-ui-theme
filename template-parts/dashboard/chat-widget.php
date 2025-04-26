<?php
/**
 * Template part para el widget de Chat IA en el dashboard
 *
 * @package NovaUI
 */

/**
 * Variables esperadas (opcionales):
 * $title - Título del widget
 * $assistant_id - ID del asistente a utilizar
 * $tokens_remaining - Número de tokens restantes
 * $view_all_url - URL para ver todas las conversaciones
 */

// Valores por defecto
$title = isset( $args['title'] ) ? $args['title'] : esc_html__( 'Chat AI', 'nova-ui' );
$assistant_id = isset( $args['assistant_id'] ) ? $args['assistant_id'] : '';
$tokens_remaining = isset( $args['tokens_remaining'] ) ? $args['tokens_remaining'] : 0;
$view_all_url = isset( $args['view_all_url'] ) ? $args['view_all_url'] : '#';

// Comprobar si está instalado el plugin de ChatIA
if ( function_exists( 'imstryker_ia_is_active' ) && imstryker_ia_is_active() ) :
    ?>
    <div class="chat-ia-widget">
        <div class="chat-ia-widget-header">
            <h3 class="chat-ia-widget-title">
                <i class="nova-icon-message-square"></i>
                <?php echo esc_html( $title ); ?>
            </h3>
            <span class="chat-ia-widget-status active">
                <?php esc_html_e( 'ACTIVE', 'nova-ui' ); ?>
            </span>
        </div>
        
        <div class="chat-ia-widget-conversation">
            <?php 
            // Si hay alguna función para obtener mensajes recientes
            if ( function_exists( 'imstryker_ia_get_recent_messages' ) && !empty( $assistant_id ) ) :
                $messages = imstryker_ia_get_recent_messages( $assistant_id, 1 );
                
                if ( !empty( $messages ) ) :
                    foreach ( $messages as $message ) :
                        if ( $message['role'] == 'assistant' ) :
                            ?>
                            <div class="chat-ia-message chat-ia-message-ai">
                                <div class="chat-ia-avatar chat-ia-avatar-ai">AI</div>
                                <div class="chat-ia-bubble chat-ia-bubble-ai">
                                    <?php echo wp_kses_post( $message['content'] ); ?>
                                </div>
                            </div>
                            <?php
                        else:
                            ?>
                            <div class="chat-ia-message chat-ia-message-user">
                                <div class="chat-ia-bubble chat-ia-bubble-user">
                                    <?php echo wp_kses_post( $message['content'] ); ?>
                                </div>
                                <div class="chat-ia-avatar chat-ia-avatar-user">
                                    <?php echo substr( wp_get_current_user()->display_name, 0, 1 ); ?>
                                </div>
                            </div>
                            <?php
                        endif;
                    endforeach;
                else:
                    ?>
                    <div class="chat-ia-message chat-ia-message-ai">
                        <div class="chat-ia-avatar chat-ia-avatar-ai">AI</div>
                        <div class="chat-ia-bubble chat-ia-bubble-ai">
                            <?php esc_html_e( 'I can help you analyze data, answer questions, or assist with any other task. Just type your request below.', 'nova-ui' ); ?>
                        </div>
                    </div>
                    <?php
                endif;
            else:
                ?>
                <div class="chat-ia-message chat-ia-message-ai">
                    <div class="chat-ia-avatar chat-ia-avatar-ai">AI</div>
                    <div class="chat-ia-bubble chat-ia-bubble-ai">
                        <?php esc_html_e( 'I can help you analyze data, answer questions, or assist with any other task. Just type your request below.', 'nova-ui' ); ?>
                    </div>
                </div>
                <?php
            endif;
            ?>
        </div>
        
        <form class="chat-ia-input-container" action="" method="post">
            <?php if ( !empty( $assistant_id ) ) : ?>
                <input type="hidden" name="assistant_id" value="<?php echo esc_attr( $assistant_id ); ?>">
            <?php endif; ?>
            <input type="text" name="chat_message" class="chat-ia-input" placeholder="<?php esc_attr_e( 'Ask AI assistant...', 'nova-ui' ); ?>">
            <button type="submit" class="chat-ia-send-button">
                <i class="nova-icon-send chat-ia-send-icon"></i>
                <?php esc_html_e( 'Send', 'nova-ui' ); ?>
            </button>
        </form>
        
        <div class="chat-ia-info">
            <span class="chat-ia-tokens">
                <span class="chat-ia-tokens-value"><?php echo esc_html( number_format_i18n( $tokens_remaining ) ); ?></span> 
                <?php esc_html_e( 'tokens remaining', 'nova-ui' ); ?>
            </span>
            <a href="<?php echo esc_url( $view_all_url ); ?>" class="chat-ia-view-all">
                <?php esc_html_e( 'View all conversations', 'nova-ui' ); ?> →
            </a>
        </div>
    </div>
<?php else : ?>
    <div class="chat-ia-widget">
        <div class="chat-ia-widget-header">
            <h3 class="chat-ia-widget-title">
                <i class="nova-icon-message-square"></i>
                <?php echo esc_html( $title ); ?>
            </h3>
        </div>
        
        <div class="chat-ia-widget-content">
            <div class="chat-ia-widget-empty">
                <p><?php esc_html_e( 'Chat IA plugin is not activated.', 'nova-ui' ); ?></p>
            </div>
        </div>
    </div>
<?php endif; ?>
