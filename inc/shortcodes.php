<?php
/**
 * Shortcodes para el tema NovaUI
 *
 * @package NovaUI
 */

/**
 * Shortcode para crear secciones
 * Uso: [saas_section layout="hero" padding="xl" background="#f5f8ff"]Contenido[/saas_section]
 */
function novaui_section_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts(
        array(
            'layout'     => 'default',
            'padding'    => 'md',
            'margin'     => '',
            'background' => '',
            'color'      => '',
            'class'      => '',
            'id'         => '',
        ),
        $atts,
        'saas_section'
    );
    
    // Estilos en línea basados en los atributos
    $style = '';
    
    if ( ! empty( $atts['background'] ) ) {
        $style .= 'background-color:' . $atts['background'] . ';';
    }
    
    if ( ! empty( $atts['color'] ) ) {
        $style .= 'color:' . $atts['color'] . ';';
    }
    
    // Clases basadas en los atributos
    $classes = array( 'saas-section' );
    
    if ( ! empty( $atts['layout'] ) ) {
        $classes[] = 'saas-section-' . $atts['layout'];
    }
    
    if ( ! empty( $atts['padding'] ) ) {
        $classes[] = 'saas-padding-' . $atts['padding'];
    }
    
    if ( ! empty( $atts['margin'] ) ) {
        $classes[] = 'saas-margin-' . $atts['margin'];
    }
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = $atts['class'];
    }
    
    $class_attr = implode( ' ', $classes );
    
    // Generar el ID si está presente
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Generar el estilo en línea si hay alguno
    $style_attr = ! empty( $style ) ? ' style="' . esc_attr( $style ) . '"' : '';
    
    // Construir el HTML
    $html = '<section class="' . esc_attr( $class_attr ) . '"' . $id_attr . $style_attr . '>';
    $html .= '<div class="container">';
    $html .= do_shortcode( $content );
    $html .= '</div>';
    $html .= '</section>';
    
    return $html;
}
add_shortcode( 'saas_section', 'novaui_section_shortcode' );

/**
 * Shortcode para crear filas
 * Uso: [saas_row align="center"]Contenido[/saas_row]
 */
function novaui_row_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts(
        array(
            'align'     => '',
            'justify'   => '',
            'class'     => '',
            'id'        => '',
        ),
        $atts,
        'saas_row'
    );
    
    // Clases basadas en los atributos
    $classes = array( 'row' );
    
    if ( ! empty( $atts['align'] ) ) {
        $classes[] = 'align-items-' . $atts['align'];
    }
    
    if ( ! empty( $atts['justify'] ) ) {
        $classes[] = 'justify-content-' . $atts['justify'];
    }
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = $atts['class'];
    }
    
    $class_attr = implode( ' ', $classes );
    
    // Generar el ID si está presente
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Construir el HTML
    $html = '<div class="' . esc_attr( $class_attr ) . '"' . $id_attr . '>';
    $html .= do_shortcode( $content );
    $html .= '</div>';
    
    return $html;
}
add_shortcode( 'saas_row', 'novaui_row_shortcode' );

/**
 * Shortcode para crear columnas
 * Uso: [saas_column width="50%"]Contenido[/saas_column]
 */
function novaui_column_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts(
        array(
            'width'     => '',
            'offset'    => '',
            'class'     => '',
            'id'        => '',
        ),
        $atts,
        'saas_column'
    );
    
    // Clases basadas en los atributos
    $classes = array();
    
    // Manejar el ancho
    if ( ! empty( $atts['width'] ) ) {
        if ( strpos( $atts['width'], '%' ) !== false ) {
            // Convertir porcentaje a columnas del sistema de grid
            $width_value = intval( $atts['width'] );
            $col_size = round( $width_value / 8.33 ); // 100% / 12 = 8.33%
            $classes[] = 'col-' . $col_size;
        } elseif ( $atts['width'] == 'auto' ) {
            $classes[] = 'col-auto';
        } else {
            $classes[] = 'col-' . $atts['width'];
        }
    } else {
        $classes[] = 'col'; // Columna flexible
    }
    
    // Manejo del offset
    if ( ! empty( $atts['offset'] ) ) {
        if ( strpos( $atts['offset'], '%' ) !== false ) {
            // Convertir porcentaje a columnas del sistema de grid
            $offset_value = intval( $atts['offset'] );
            $offset_size = round( $offset_value / 8.33 );
            $classes[] = 'offset-' . $offset_size;
        } else {
            $classes[] = 'offset-' . $atts['offset'];
        }
    }
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = $atts['class'];
    }
    
    $class_attr = implode( ' ', $classes );
    
    // Generar el ID si está presente
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Construir el HTML
    $html = '<div class="' . esc_attr( $class_attr ) . '"' . $id_attr . '>';
    $html .= do_shortcode( $content );
    $html .= '</div>';
    
    return $html;
}
add_shortcode( 'saas_column', 'novaui_column_shortcode' );

/**
 * Shortcode para crear encabezados
 * Uso: [saas_heading size="2xl"]Título[/saas_heading]
 */
function novaui_heading_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts(
        array(
            'size'      => 'xl',
            'color'     => '',
            'align'     => '',
            'class'     => '',
            'id'        => '',
            'tag'       => 'h2',
        ),
        $atts,
        'saas_heading'
    );
    
    // Validar el tag para evitar problemas de seguridad
    $allowed_tags = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6', 'div', 'span' );
    if ( ! in_array( $atts['tag'], $allowed_tags ) ) {
        $atts['tag'] = 'h2';
    }
    
    // Estilos en línea basados en los atributos
    $style = '';
    
    if ( ! empty( $atts['color'] ) ) {
        $style .= 'color:' . $atts['color'] . ';';
    }
    
    // Clases basadas en los atributos
    $classes = array( 'saas-heading' );
    
    if ( ! empty( $atts['size'] ) ) {
        $classes[] = 'saas-heading-' . $atts['size'];
    }
    
    if ( ! empty( $atts['align'] ) ) {
        $classes[] = 'text-' . $atts['align'];
    }
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = $atts['class'];
    }
    
    $class_attr = implode( ' ', $classes );
    
    // Generar el ID si está presente
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Generar el estilo en línea si hay alguno
    $style_attr = ! empty( $style ) ? ' style="' . esc_attr( $style ) . '"' : '';
    
    // Construir el HTML
    $tag = $atts['tag'];
    $html = '<' . $tag . ' class="' . esc_attr( $class_attr ) . '"' . $id_attr . $style_attr . '>';
    $html .= do_shortcode( $content );
    $html .= '</' . $tag . '>';
    
    return $html;
}
add_shortcode( 'saas_heading', 'novaui_heading_shortcode' );

/**
 * Shortcode para crear botones
 * Uso: [saas_button url="/registro" style="primary" size="lg"]Comenzar Ahora[/saas_button]
 */
function novaui_button_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts(
        array(
            'url'       => '#',
            'style'     => 'primary',
            'size'      => 'md',
            'block'     => 'false',
            'icon'      => '',
            'class'     => '',
            'id'        => '',
            'target'    => '_self',
        ),
        $atts,
        'saas_button'
    );
    
    // Clases basadas en los atributos
    $classes = array( 'button' );
    
    if ( ! empty( $atts['style'] ) ) {
        $classes[] = $atts['style'];
    }
    
    if ( ! empty( $atts['size'] ) ) {
        $classes[] = 'btn-' . $atts['size'];
    }
    
    if ( $atts['block'] === 'true' ) {
        $classes[] = 'btn-block';
    }
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = $atts['class'];
    }
    
    $class_attr = implode( ' ', $classes );
    
    // Generar el ID si está presente
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Validar el atributo target para evitar problemas de seguridad
    $allowed_targets = array( '_self', '_blank', '_parent', '_top' );
    if ( ! in_array( $atts['target'], $allowed_targets ) ) {
        $atts['target'] = '_self';
    }
    
    // Construir el HTML
    $html = '<a href="' . esc_url( $atts['url'] ) . '" class="' . esc_attr( $class_attr ) . '"' . $id_attr . ' target="' . esc_attr( $atts['target'] ) . '">';
    
    // Añadir icono si está presente
    if ( ! empty( $atts['icon'] ) ) {
        $html .= '<span class="button-icon">' . novaui_get_icon_svg( $atts['icon'] ) . '</span>';
    }
    
    $html .= '<span class="button-text">' . do_shortcode( $content ) . '</span>';
    $html .= '</a>';
    
    return $html;
}
add_shortcode( 'saas_button', 'novaui_button_shortcode' );

/**
 * Shortcode para crear bloques de características
 * Uso: [saas_feature title="Título" icon="rocket"]Descripción[/saas_feature]
 */
function novaui_feature_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts(
        array(
            'title'     => '',
            'icon'      => '',
            'image'     => '',
            'class'     => '',
            'id'        => '',
        ),
        $atts,
        'saas_feature'
    );
    
    // Clases basadas en los atributos
    $classes = array( 'saas-feature' );
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = $atts['class'];
    }
    
    $class_attr = implode( ' ', $classes );
    
    // Generar el ID si está presente
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Construir el HTML
    $html = '<div class="' . esc_attr( $class_attr ) . '"' . $id_attr . '>';
    
    // Icono o imagen
    if ( ! empty( $atts['icon'] ) ) {
        $html .= '<div class="saas-feature-icon">' . novaui_get_icon_svg( $atts['icon'] ) . '</div>';
    } elseif ( ! empty( $atts['image'] ) ) {
        $html .= '<div class="saas-feature-image"><img src="' . esc_url( $atts['image'] ) . '" alt="' . esc_attr( $atts['title'] ) . '" /></div>';
    }
    
    // Título
    if ( ! empty( $atts['title'] ) ) {
        $html .= '<h3 class="saas-feature-title">' . esc_html( $atts['title'] ) . '</h3>';
    }
    
    // Contenido
    $html .= '<div class="saas-feature-text">' . do_shortcode( $content ) . '</div>';
    $html .= '</div>';
    
    return $html;
}
add_shortcode( 'saas_feature', 'novaui_feature_shortcode' );

/**
 * Shortcode para crear testimonios
 * Uso: [saas_testimonial name="John Doe" position="CEO" image="url-imagen"]Testimonio[/saas_testimonial]
 */
function novaui_testimonial_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts(
        array(
            'name'      => '',
            'position'  => '',
            'image'     => '',
            'rating'    => '',
            'class'     => '',
            'id'        => '',
        ),
        $atts,
        'saas_testimonial'
    );
    
    // Clases basadas en los atributos
    $classes = array( 'saas-testimonial' );
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = $atts['class'];
    }
    
    $class_attr = implode( ' ', $classes );
    
    // Generar el ID si está presente
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Construir el HTML
    $html = '<div class="' . esc_attr( $class_attr ) . '"' . $id_attr . '>';
    $html .= '<div class="saas-testimonial-content">' . do_shortcode( $content ) . '</div>';
    
    $html .= '<div class="saas-testimonial-footer">';
    
    // Imagen de avatar
    if ( ! empty( $atts['image'] ) ) {
        $html .= '<div class="saas-testimonial-image"><img src="' . esc_url( $atts['image'] ) . '" alt="' . esc_attr( $atts['name'] ) . '" /></div>';
    }
    
    $html .= '<div class="saas-testimonial-author">';
    
    // Nombre
    if ( ! empty( $atts['name'] ) ) {
        $html .= '<h4 class="saas-testimonial-name">' . esc_html( $atts['name'] ) . '</h4>';
    }
    
    // Posición
    if ( ! empty( $atts['position'] ) ) {
        $html .= '<div class="saas-testimonial-position">' . esc_html( $atts['position'] ) . '</div>';
    }
    
    $html .= '</div>'; // .saas-testimonial-author
    
    // Rating
    if ( ! empty( $atts['rating'] ) && is_numeric( $atts['rating'] ) ) {
        $rating = intval( $atts['rating'] );
        $html .= '<div class="saas-testimonial-rating">';
        for ( $i = 1; $i <= 5; $i++ ) {
            if ( $i <= $rating ) {
                $html .= '<span class="star filled">★</span>';
            } else {
                $html .= '<span class="star">☆</span>';
            }
        }
        $html .= '</div>';
    }
    
    $html .= '</div>'; // .saas-testimonial-footer
    $html .= '</div>'; // .saas-testimonial
    
    return $html;
}
add_shortcode( 'saas_testimonial', 'novaui_testimonial_shortcode' );

/**
 * Shortcode para crear llamadas a la acción
 * Uso: [saas_cta title="Título" button_text="Texto Botón" button_url="#"]Descripción[/saas_cta]
 */
function novaui_cta_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts(
        array(
            'title'         => '',
            'button_text'   => '',
            'button_url'    => '#',
            'button_style'  => 'primary',
            'button_size'   => 'lg',
            'background'    => '',
            'color'         => '',
            'class'         => '',
            'id'            => '',
        ),
        $atts,
        'saas_cta'
    );
    
    // Estilos en línea basados en los atributos
    $style = '';
    
    if ( ! empty( $atts['background'] ) ) {
        $style .= 'background-color:' . $atts['background'] . ';';
    }
    
    if ( ! empty( $atts['color'] ) ) {
        $style .= 'color:' . $atts['color'] . ';';
    }
    
    // Clases basadas en los atributos
    $classes = array( 'saas-cta' );
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = $atts['class'];
    }
    
    $class_attr = implode( ' ', $classes );
    
    // Generar el ID si está presente
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Generar el estilo en línea si hay alguno
    $style_attr = ! empty( $style ) ? ' style="' . esc_attr( $style ) . '"' : '';
    
    // Construir el HTML
    $html = '<div class="' . esc_attr( $class_attr ) . '"' . $id_attr . $style_attr . '>';
    
    // Título
    if ( ! empty( $atts['title'] ) ) {
        $html .= '<h2 class="saas-cta-title">' . esc_html( $atts['title'] ) . '</h2>';
    }
    
    // Contenido
    if ( ! empty( $content ) ) {
        $html .= '<div class="saas-cta-text">' . do_shortcode( $content ) . '</div>';
    }
    
    // Botón
    if ( ! empty( $atts['button_text'] ) ) {
        $html .= '<div class="saas-cta-button">';
        $html .= do_shortcode( '[saas_button url="' . esc_url( $atts['button_url'] ) . '" style="' . esc_attr( $atts['button_style'] ) . '" size="' . esc_attr( $atts['button_size'] ) . '"]' . esc_html( $atts['button_text'] ) . '[/saas_button]' );
        $html .= '</div>';
    }
    
    $html .= '</div>';
    
    return $html;
}
add_shortcode( 'saas_cta', 'novaui_cta_shortcode' );

/**
 * Shortcode para mostrar texto
 * Uso: [saas_text]Contenido de texto[/saas_text]
 */
function novaui_text_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts(
        array(
            'color'     => '',
            'align'     => '',
            'size'      => '',
            'class'     => '',
            'id'        => '',
        ),
        $atts,
        'saas_text'
    );
    
    // Estilos en línea basados en los atributos
    $style = '';
    
    if ( ! empty( $atts['color'] ) ) {
        $style .= 'color:' . $atts['color'] . ';';
    }
    
    if ( ! empty( $atts['size'] ) ) {
        $style .= 'font-size:' . $atts['size'] . ';';
    }
    
    // Clases basadas en los atributos
    $classes = array( 'saas-text' );
    
    if ( ! empty( $atts['align'] ) ) {
        $classes[] = 'text-' . $atts['align'];
    }
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = $atts['class'];
    }
    
    $class_attr = implode( ' ', $classes );
    
    // Generar el ID si está presente
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Generar el estilo en línea si hay alguno
    $style_attr = ! empty( $style ) ? ' style="' . esc_attr( $style ) . '"' : '';
    
    // Construir el HTML
    $html = '<div class="' . esc_attr( $class_attr ) . '"' . $id_attr . $style_attr . '>';
    $html .= do_shortcode( $content );
    $html .= '</div>';
    
    return $html;
}
add_shortcode( 'saas_text', 'novaui_text_shortcode' );

/**
 * Shortcode para mostrar imágenes
 * Uso: [saas_image src="/ruta/imagen.jpg" alt="Texto alternativo" class="class-adicional"]
 */
function novaui_image_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts(
        array(
            'src'       => '',
            'alt'       => '',
            'width'     => '',
            'height'    => '',
            'class'     => '',
            'id'        => '',
        ),
        $atts,
        'saas_image'
    );
    
    // Si no hay una URL de imagen, no mostramos nada
    if ( empty( $atts['src'] ) ) {
        return '';
    }
    
    // Clases basadas en los atributos
    $classes = array( 'saas-image' );
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = $atts['class'];
    }
    
    $class_attr = implode( ' ', $classes );
    
    // Generar el ID si está presente
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Dimensiones de la imagen
    $dimensions = '';
    if ( ! empty( $atts['width'] ) ) {
        $dimensions .= ' width="' . esc_attr( $atts['width'] ) . '"';
    }
    if ( ! empty( $atts['height'] ) ) {
        $dimensions .= ' height="' . esc_attr( $atts['height'] ) . '"';
    }
    
    // Construir el HTML
    $html = '<img src="' . esc_url( $atts['src'] ) . '" alt="' . esc_attr( $atts['alt'] ) . '" class="' . esc_attr( $class_attr ) . '"' . $id_attr . $dimensions . ' />';
    
    return $html;
}
add_shortcode( 'saas_image', 'novaui_image_shortcode' );
