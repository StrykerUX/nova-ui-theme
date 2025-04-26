<?php
/**
 * Shortcodes para el tema NovaUI
 *
 * @package NovaUI
 */

/**
 * Registra todos los shortcodes
 */
function nova_ui_register_shortcodes() {
    // Shortcodes de layout
    add_shortcode( 'saas_section', 'nova_ui_section_shortcode' );
    add_shortcode( 'saas_row', 'nova_ui_row_shortcode' );
    add_shortcode( 'saas_column', 'nova_ui_column_shortcode' );
    
    // Shortcodes de contenido
    add_shortcode( 'saas_heading', 'nova_ui_heading_shortcode' );
    add_shortcode( 'saas_text', 'nova_ui_text_shortcode' );
    add_shortcode( 'saas_button', 'nova_ui_button_shortcode' );
    add_shortcode( 'saas_image', 'nova_ui_image_shortcode' );
    
    // Shortcodes de componentes
    add_shortcode( 'saas_feature', 'nova_ui_feature_shortcode' );
    add_shortcode( 'saas_testimonial', 'nova_ui_testimonial_shortcode' );
    add_shortcode( 'saas_cta', 'nova_ui_cta_shortcode' );
}
add_action( 'init', 'nova_ui_register_shortcodes' );

/**
 * Shortcode para secciones principales
 */
function nova_ui_section_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'id'         => '',
        'class'      => '',
        'layout'     => 'default',  // default, hero, split, feature, etc.
        'background' => '',
        'padding'    => 'md',       // xs, sm, md, lg, xl, 2xl
        'text_align' => '',
    ), $atts, 'saas_section' );
    
    // Construir clases
    $classes = array( 'saas-section' );
    $classes[] = 'saas-section--' . esc_attr( $atts['layout'] );
    $classes[] = 'saas-p-' . esc_attr( $atts['padding'] );
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = esc_attr( $atts['class'] );
    }
    
    if ( ! empty( $atts['text_align'] ) ) {
        $classes[] = 'text-' . esc_attr( $atts['text_align'] );
    }
    
    // Estilos inline
    $styles = array();
    
    if ( ! empty( $atts['background'] ) ) {
        $styles[] = 'background-color: ' . esc_attr( $atts['background'] );
    }
    
    $style_attr = ! empty( $styles ) ? ' style="' . implode( '; ', $styles ) . '"' : '';
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Salida HTML
    $output = '<section class="' . esc_attr( implode( ' ', $classes ) ) . '"' . $id_attr . $style_attr . '>';
    $output .= '<div class="container">';
    $output .= do_shortcode( $content );
    $output .= '</div>';
    $output .= '</section>';
    
    return $output;
}

/**
 * Shortcode para filas (sistema de grid)
 */
function nova_ui_row_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'id'             => '',
        'class'          => '',
        'align'          => '',     // center, start, end, baseline, stretch
        'justify'        => '',     // center, start, end, between, around, evenly
        'gap'            => 'md',   // xs, sm, md, lg, xl
        'reverse'        => 'no',   // yes, no
        'vertical_align' => '',     // top, middle, bottom
    ), $atts, 'saas_row' );
    
    // Construir clases
    $classes = array( 'saas-row' );
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = esc_attr( $atts['class'] );
    }
    
    // Alineación de elementos
    if ( ! empty( $atts['align'] ) ) {
        $align_class = '';
        switch ( $atts['align'] ) {
            case 'center':
                $align_class = 'items-center';
                break;
            case 'start':
                $align_class = 'items-start';
                break;
            case 'end':
                $align_class = 'items-end';
                break;
            case 'baseline':
                $align_class = 'items-baseline';
                break;
            case 'stretch':
                $align_class = 'items-stretch';
                break;
        }
        
        if ( $align_class ) {
            $classes[] = $align_class;
        }
    }
    
    // Justificación horizontal
    if ( ! empty( $atts['justify'] ) ) {
        $justify_class = '';
        switch ( $atts['justify'] ) {
            case 'center':
                $justify_class = 'justify-center';
                break;
            case 'start':
                $justify_class = 'justify-start';
                break;
            case 'end':
                $justify_class = 'justify-end';
                break;
            case 'between':
                $justify_class = 'justify-between';
                break;
            case 'around':
                $justify_class = 'justify-around';
                break;
            case 'evenly':
                $justify_class = 'justify-evenly';
                break;
        }
        
        if ( $justify_class ) {
            $classes[] = $justify_class;
        }
    }
    
    // Espaciado
    if ( ! empty( $atts['gap'] ) ) {
        $classes[] = 'saas-gap-' . esc_attr( $atts['gap'] );
    }
    
    // Inversión de dirección
    if ( 'yes' === $atts['reverse'] ) {
        $classes[] = 'saas-row-reverse';
    }
    
    // Alineación vertical (compatibilidad con sistemas anteriores)
    if ( ! empty( $atts['vertical_align'] ) && empty( $atts['align'] ) ) {
        switch ( $atts['vertical_align'] ) {
            case 'top':
                $classes[] = 'items-start';
                break;
            case 'middle':
                $classes[] = 'items-center';
                break;
            case 'bottom':
                $classes[] = 'items-end';
                break;
        }
    }
    
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Salida HTML
    $output = '<div class="' . esc_attr( implode( ' ', $classes ) ) . '"' . $id_attr . '>';
    $output .= do_shortcode( $content );
    $output .= '</div>';
    
    return $output;
}

/**
 * Shortcode para columnas (sistema de grid)
 */
function nova_ui_column_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'id'         => '',
        'class'      => '',
        'width'      => '',  // 25%, 33%, 50%, 66%, 75%, 100% o 1/4, 1/3, 1/2, 2/3, 3/4, full
        'offset'     => '',  // 25%, 33%, 50%, etc.
        'align'      => '',  // center, start, end, stretch
        'text_align' => '',  // left, center, right
        'padding'    => '',  // xs, sm, md, lg, xl, 2xl
        'background' => '',
        'sm'         => '',  // viewport sm: ancho en este breakpoint
        'md'         => '',  // viewport md: ancho en este breakpoint
        'lg'         => '',  // viewport lg: ancho en este breakpoint
    ), $atts, 'saas_column' );
    
    // Construir clases
    $classes = array( 'saas-column' );
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = esc_attr( $atts['class'] );
    }
    
    // Anchura de columna
    if ( ! empty( $atts['width'] ) ) {
        // Convierte fracciones a porcentajes si es necesario
        $width = $atts['width'];
        
        if ( strpos( $width, '/' ) !== false ) {
            $fraction = explode( '/', $width );
            if ( count( $fraction ) === 2 && is_numeric( $fraction[0] ) && is_numeric( $fraction[1] ) && $fraction[1] != 0 ) {
                $percentage = ( intval( $fraction[0] ) / intval( $fraction[1] ) ) * 100;
                $width = $percentage . '%';
            }
        } else if ( $width === 'full' ) {
            $width = '100%';
        }
        
        if ( is_numeric( $width ) ) {
            $width .= '%';
        }
        
        // Convertir porcentajes a clases
        if ( $width === '25%' || $width === '1/4' ) {
            $classes[] = 'saas-col-3'; // 3 de 12 columnas
        } else if ( $width === '33%' || $width === '1/3' ) {
            $classes[] = 'saas-col-4'; // 4 de 12 columnas
        } else if ( $width === '50%' || $width === '1/2' ) {
            $classes[] = 'saas-col-6'; // 6 de 12 columnas
        } else if ( $width === '66%' || $width === '2/3' ) {
            $classes[] = 'saas-col-8'; // 8 de 12 columnas
        } else if ( $width === '75%' || $width === '3/4' ) {
            $classes[] = 'saas-col-9'; // 9 de 12 columnas
        } else if ( $width === '100%' || $width === 'full' ) {
            $classes[] = 'saas-col-12'; // 12 de 12 columnas
        } else {
            $classes[] = 'saas-col-custom'; // Ancho personalizado
        }
    } else {
        // Si no se especifica, usar diseño flexible
        $classes[] = 'saas-col';
    }
    
    // Offset (desplazamiento)
    if ( ! empty( $atts['offset'] ) ) {
        $offset = $atts['offset'];
        
        if ( strpos( $offset, '/' ) !== false ) {
            $fraction = explode( '/', $offset );
            if ( count( $fraction ) === 2 && is_numeric( $fraction[0] ) && is_numeric( $fraction[1] ) && $fraction[1] != 0 ) {
                $percentage = ( intval( $fraction[0] ) / intval( $fraction[1] ) ) * 100;
                $offset = $percentage . '%';
            }
        }
        
        if ( is_numeric( $offset ) ) {
            $offset .= '%';
        }
        
        // Convertir porcentajes a clases de offset
        if ( $offset === '25%' || $offset === '1/4' ) {
            $classes[] = 'saas-offset-3';
        } else if ( $offset === '33%' || $offset === '1/3' ) {
            $classes[] = 'saas-offset-4';
        } else if ( $offset === '50%' || $offset === '1/2' ) {
            $classes[] = 'saas-offset-6';
        } else if ( $offset === '66%' || $offset === '2/3' ) {
            $classes[] = 'saas-offset-8';
        } else if ( $offset === '75%' || $offset === '3/4' ) {
            $classes[] = 'saas-offset-9';
        }
    }
    
    // Alineación de columna
    if ( ! empty( $atts['align'] ) ) {
        switch ( $atts['align'] ) {
            case 'center':
                $classes[] = 'self-center';
                break;
            case 'start':
                $classes[] = 'self-start';
                break;
            case 'end':
                $classes[] = 'self-end';
                break;
            case 'stretch':
                $classes[] = 'self-stretch';
                break;
        }
    }
    
    // Alineación de texto
    if ( ! empty( $atts['text_align'] ) ) {
        $classes[] = 'text-' . esc_attr( $atts['text_align'] );
    }
    
    // Padding
    if ( ! empty( $atts['padding'] ) ) {
        $classes[] = 'saas-p-' . esc_attr( $atts['padding'] );
    }
    
    // Responsive
    if ( ! empty( $atts['sm'] ) ) {
        $sm_width = $atts['sm'];
        if ( $sm_width === '1/4' || $sm_width === '25%' ) {
            $classes[] = 'saas-sm-col-3';
        } else if ( $sm_width === '1/3' || $sm_width === '33%' ) {
            $classes[] = 'saas-sm-col-4';
        } else if ( $sm_width === '1/2' || $sm_width === '50%' ) {
            $classes[] = 'saas-sm-col-6';
        } else if ( $sm_width === '2/3' || $sm_width === '66%' ) {
            $classes[] = 'saas-sm-col-8';
        } else if ( $sm_width === '3/4' || $sm_width === '75%' ) {
            $classes[] = 'saas-sm-col-9';
        } else if ( $sm_width === 'full' || $sm_width === '100%' ) {
            $classes[] = 'saas-sm-col-12';
        }
    }
    
    if ( ! empty( $atts['md'] ) ) {
        $md_width = $atts['md'];
        if ( $md_width === '1/4' || $md_width === '25%' ) {
            $classes[] = 'saas-md-col-3';
        } else if ( $md_width === '1/3' || $md_width === '33%' ) {
            $classes[] = 'saas-md-col-4';
        } else if ( $md_width === '1/2' || $md_width === '50%' ) {
            $classes[] = 'saas-md-col-6';
        } else if ( $md_width === '2/3' || $md_width === '66%' ) {
            $classes[] = 'saas-md-col-8';
        } else if ( $md_width === '3/4' || $md_width === '75%' ) {
            $classes[] = 'saas-md-col-9';
        } else if ( $md_width === 'full' || $md_width === '100%' ) {
            $classes[] = 'saas-md-col-12';
        }
    }
    
    if ( ! empty( $atts['lg'] ) ) {
        $lg_width = $atts['lg'];
        if ( $lg_width === '1/4' || $lg_width === '25%' ) {
            $classes[] = 'saas-lg-col-3';
        } else if ( $lg_width === '1/3' || $lg_width === '33%' ) {
            $classes[] = 'saas-lg-col-4';
        } else if ( $lg_width === '1/2' || $lg_width === '50%' ) {
            $classes[] = 'saas-lg-col-6';
        } else if ( $lg_width === '2/3' || $lg_width === '66%' ) {
            $classes[] = 'saas-lg-col-8';
        } else if ( $lg_width === '3/4' || $lg_width === '75%' ) {
            $classes[] = 'saas-lg-col-9';
        } else if ( $lg_width === 'full' || $lg_width === '100%' ) {
            $classes[] = 'saas-lg-col-12';
        }
    }
    
    // Estilos inline para background y ancho personalizado
    $styles = array();
    
    if ( ! empty( $atts['background'] ) ) {
        $styles[] = 'background-color: ' . esc_attr( $atts['background'] );
    }
    
    // Si se proporcionó un ancho personalizado y no es una fracción o porcentaje reconocido
    if ( ! empty( $atts['width'] ) && strpos( implode( ' ', $classes ), 'saas-col-custom' ) !== false ) {
        $styles[] = 'width: ' . esc_attr( $atts['width'] );
        $styles[] = 'flex: 0 0 ' . esc_attr( $atts['width'] );
    }
    
    $style_attr = ! empty( $styles ) ? ' style="' . implode( '; ', $styles ) . '"' : '';
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Salida HTML
    $output = '<div class="' . esc_attr( implode( ' ', $classes ) ) . '"' . $id_attr . $style_attr . '>';
    $output .= do_shortcode( $content );
    $output .= '</div>';
    
    return $output;
}

/**
 * Shortcode para encabezados
 */
function nova_ui_heading_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'id'        => '',
        'class'     => '',
        'tag'       => 'h2',        // h1, h2, h3, h4, h5, h6
        'size'      => '',          // xs, sm, md, lg, xl, 2xl, 3xl, 4xl
        'weight'    => '',          // normal, medium, semibold, bold
        'color'     => '',          // primary, secondary, accent, etc.
        'align'     => '',          // left, center, right
        'transform' => '',          // uppercase, lowercase, capitalize
        'spacing'   => '',          // Espaciado de margen
        'gradient'  => 'no',        // yes, no
    ), $atts, 'saas_heading' );
    
    // Construir clases
    $classes = array( 'saas-heading' );
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = esc_attr( $atts['class'] );
    }
    
    // Tamaño de fuente
    if ( ! empty( $atts['size'] ) ) {
        $classes[] = 'text-' . esc_attr( $atts['size'] );
    }
    
    // Peso de fuente
    if ( ! empty( $atts['weight'] ) ) {
        $classes[] = 'font-' . esc_attr( $atts['weight'] );
    }
    
    // Color de texto
    if ( ! empty( $atts['color'] ) ) {
        $classes[] = 'text-' . esc_attr( $atts['color'] );
    }
    
    // Alineación de texto
    if ( ! empty( $atts['align'] ) ) {
        $classes[] = 'text-' . esc_attr( $atts['align'] );
    }
    
    // Transformación de texto
    if ( ! empty( $atts['transform'] ) ) {
        $classes[] = 'text-' . esc_attr( $atts['transform'] );
    }
    
    // Espaciado
    if ( ! empty( $atts['spacing'] ) ) {
        $classes[] = 'mb-' . esc_attr( $atts['spacing'] );
    }
    
    // Efecto de gradiente
    if ( 'yes' === $atts['gradient'] ) {
        $classes[] = 'saas-gradient-text';
    }
    
    // Sanitizar tag
    $allowed_tags = array( 'h1', 'h2', 'h3', 'h4', 'h5', 'h6' );
    $tag = in_array( $atts['tag'], $allowed_tags ) ? $atts['tag'] : 'h2';
    
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Salida HTML
    $output = '<' . $tag . ' class="' . esc_attr( implode( ' ', $classes ) ) . '"' . $id_attr . '>';
    $output .= do_shortcode( $content );
    $output .= '</' . $tag . '>';
    
    return $output;
}

/**
 * Shortcode para párrafos de texto
 */
function nova_ui_text_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'id'      => '',
        'class'   => '',
        'size'    => '',          // xs, sm, md, lg, xl
        'color'   => '',          // primary, secondary, accent, etc.
        'align'   => '',          // left, center, right
        'spacing' => '',          // Espaciado de margen
    ), $atts, 'saas_text' );
    
    // Construir clases
    $classes = array( 'saas-text' );
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = esc_attr( $atts['class'] );
    }
    
    // Tamaño de fuente
    if ( ! empty( $atts['size'] ) ) {
        $classes[] = 'text-' . esc_attr( $atts['size'] );
    }
    
    // Color de texto
    if ( ! empty( $atts['color'] ) ) {
        $classes[] = 'text-' . esc_attr( $atts['color'] );
    }
    
    // Alineación de texto
    if ( ! empty( $atts['align'] ) ) {
        $classes[] = 'text-' . esc_attr( $atts['align'] );
    }
    
    // Espaciado
    if ( ! empty( $atts['spacing'] ) ) {
        $classes[] = 'mb-' . esc_attr( $atts['spacing'] );
    }
    
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Salida HTML
    $output = '<p class="' . esc_attr( implode( ' ', $classes ) ) . '"' . $id_attr . '>';
    $output .= do_shortcode( $content );
    $output .= '</p>';
    
    return $output;
}

/**
 * Shortcode para botones
 */
function nova_ui_button_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'id'         => '',
        'class'      => '',
        'url'        => '#',
        'target'     => '_self',    // _self, _blank
        'style'      => 'primary',  // primary, secondary, accent, outline, ghost
        'size'       => 'md',       // sm, md, lg, xl
        'width'      => '',         // auto, full
        'icon'       => '',         // Nombre del icono
        'icon_pos'   => 'right',    // left, right
        'shadow'     => 'yes',      // yes, no
        'neobrutal'  => 'yes',      // yes, no
        'text_align' => '',         // left, center, right
    ), $atts, 'saas_button' );
    
    // Construir clases
    $classes = array( 'saas-button' );
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = esc_attr( $atts['class'] );
    }
    
    // Estilo del botón
    $classes[] = 'saas-button--' . esc_attr( $atts['style'] );
    
    // Tamaño del botón
    $classes[] = 'saas-button--' . esc_attr( $atts['size'] );
    
    // Ancho del botón
    if ( ! empty( $atts['width'] ) && 'full' === $atts['width'] ) {
        $classes[] = 'saas-button--block';
    }
    
    // Sombra
    if ( 'yes' === $atts['shadow'] ) {
        $classes[] = 'saas-button--shadow';
    }
    
    // Estilo neo-brutalista
    if ( 'yes' === $atts['neobrutal'] ) {
        $classes[] = 'saas-button--neobrutal';
    }
    
    // Alineación de texto
    if ( ! empty( $atts['text_align'] ) ) {
        $classes[] = 'text-' . esc_attr( $atts['text_align'] );
    }
    
    // Preparar icono si existe
    $icon_html = '';
    if ( ! empty( $atts['icon'] ) ) {
        $icon_html = nova_ui_get_svg_icon( $atts['icon'], 'sm' );
        $classes[] = 'saas-button--has-icon';
        $classes[] = 'saas-button--icon-' . esc_attr( $atts['icon_pos'] );
    }
    
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    $url = esc_url( $atts['url'] );
    $target_attr = ' target="' . esc_attr( $atts['target'] ) . '"';
    $rel_attr = '_blank' === $atts['target'] ? ' rel="noopener noreferrer"' : '';
    
    // Salida HTML
    $output = '<a href="' . $url . '" class="' . esc_attr( implode( ' ', $classes ) ) . '"' . $id_attr . $target_attr . $rel_attr . '>';
    
    if ( ! empty( $icon_html ) && 'left' === $atts['icon_pos'] ) {
        $output .= '<span class="saas-button__icon">' . $icon_html . '</span>';
    }
    
    $output .= '<span class="saas-button__text">' . do_shortcode( $content ) . '</span>';
    
    if ( ! empty( $icon_html ) && 'right' === $atts['icon_pos'] ) {
        $output .= '<span class="saas-button__icon">' . $icon_html . '</span>';
    }
    
    $output .= '</a>';
    
    return $output;
}

/**
 * Shortcode para imágenes
 */
function nova_ui_image_shortcode( $atts ) {
    $atts = shortcode_atts( array(
        'id'        => '',
        'class'     => '',
        'src'       => '',
        'alt'       => '',
        'width'     => '',
        'height'    => '',
        'align'     => '',       // left, center, right
        'shadow'    => 'no',     // yes, no
        'neobrutal' => 'no',     // yes, no
        'rounded'   => 'yes',    // yes, no
        'link'      => '',
        'target'    => '_self',
    ), $atts, 'saas_image' );
    
    // Verificar si hay imagen
    if ( empty( $atts['src'] ) ) {
        return '';
    }
    
    // Construir clases
    $classes = array( 'saas-image' );
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = esc_attr( $atts['class'] );
    }
    
    // Alineación
    if ( ! empty( $atts['align'] ) ) {
        $classes[] = 'saas-image--' . esc_attr( $atts['align'] );
    }
    
    // Sombra
    if ( 'yes' === $atts['shadow'] ) {
        $classes[] = 'saas-image--shadow';
    }
    
    // Estilo neo-brutalista
    if ( 'yes' === $atts['neobrutal'] ) {
        $classes[] = 'saas-image--neobrutal';
    }
    
    // Bordes redondeados
    if ( 'yes' === $atts['rounded'] ) {
        $classes[] = 'saas-image--rounded';
    }
    
    // Atributos adicionales
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    $width_attr = ! empty( $atts['width'] ) ? ' width="' . esc_attr( $atts['width'] ) . '"' : '';
    $height_attr = ! empty( $atts['height'] ) ? ' height="' . esc_attr( $atts['height'] ) . '"' : '';
    
    // Imagen
    $img_html = '<img src="' . esc_url( $atts['src'] ) . '" alt="' . esc_attr( $atts['alt'] ) . '" class="' . esc_attr( implode( ' ', $classes ) ) . '"' . $id_attr . $width_attr . $height_attr . '>';
    
    // Si tiene enlace, envolver en un <a>
    if ( ! empty( $atts['link'] ) ) {
        $target_attr = ' target="' . esc_attr( $atts['target'] ) . '"';
        $rel_attr = '_blank' === $atts['target'] ? ' rel="noopener noreferrer"' : '';
        
        return '<a href="' . esc_url( $atts['link'] ) . '"' . $target_attr . $rel_attr . '>' . $img_html . '</a>';
    }
    
    return $img_html;
}

/**
 * Shortcode para bloques de características
 */
function nova_ui_feature_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'id'          => '',
        'class'       => '',
        'title'       => '',
        'icon'        => '',
        'icon_color'  => 'primary', // primary, secondary, accent, etc.
        'image'       => '',
        'align'       => 'left',    // left, center, right
        'background'  => '',
        'padding'     => 'md',      // xs, sm, md, lg, xl
        'shadow'      => 'yes',     // yes, no
        'neobrutal'   => 'yes',     // yes, no
        'border'      => 'no',      // yes, no
        'hover_lift'  => 'yes',     // yes, no
    ), $atts, 'saas_feature' );
    
    // Construir clases
    $classes = array( 'saas-feature' );
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = esc_attr( $atts['class'] );
    }
    
    // Alineación
    $classes[] = 'saas-feature--' . esc_attr( $atts['align'] );
    
    // Padding
    $classes[] = 'saas-p-' . esc_attr( $atts['padding'] );
    
    // Sombra
    if ( 'yes' === $atts['shadow'] ) {
        $classes[] = 'saas-feature--shadow';
    }
    
    // Estilo neo-brutalista
    if ( 'yes' === $atts['neobrutal'] ) {
        $classes[] = 'saas-feature--neobrutal';
    }
    
    // Borde
    if ( 'yes' === $atts['border'] ) {
        $classes[] = 'saas-feature--border';
    }
    
    // Efecto de elevación al pasar el mouse
    if ( 'yes' === $atts['hover_lift'] ) {
        $classes[] = 'saas-feature--hover-lift';
    }
    
    // Estilos inline
    $styles = array();
    
    if ( ! empty( $atts['background'] ) ) {
        $styles[] = 'background-color: ' . esc_attr( $atts['background'] );
    }
    
    $style_attr = ! empty( $styles ) ? ' style="' . implode( '; ', $styles ) . '"' : '';
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Preparar el icono o imagen
    $icon_html = '';
    if ( ! empty( $atts['icon'] ) ) {
        $icon_html = '<div class="saas-feature__icon saas-feature__icon--' . esc_attr( $atts['icon_color'] ) . '">' . nova_ui_get_svg_icon( $atts['icon'], 'lg' ) . '</div>';
    } elseif ( ! empty( $atts['image'] ) ) {
        $icon_html = '<div class="saas-feature__image"><img src="' . esc_url( $atts['image'] ) . '" alt=""></div>';
    }
    
    // Título
    $title_html = '';
    if ( ! empty( $atts['title'] ) ) {
        $title_html = '<h3 class="saas-feature__title">' . esc_html( $atts['title'] ) . '</h3>';
    }
    
    // Contenido
    $content_html = '';
    if ( ! empty( $content ) ) {
        $content_html = '<div class="saas-feature__content">' . do_shortcode( $content ) . '</div>';
    }
    
    // Salida HTML
    $output = '<div class="' . esc_attr( implode( ' ', $classes ) ) . '"' . $id_attr . $style_attr . '>';
    $output .= $icon_html;
    $output .= '<div class="saas-feature__body">';
    $output .= $title_html;
    $output .= $content_html;
    $output .= '</div>';
    $output .= '</div>';
    
    return $output;
}

/**
 * Shortcode para testimonios
 */
function nova_ui_testimonial_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'id'         => '',
        'class'      => '',
        'name'       => '',
        'position'   => '',
        'company'    => '',
        'avatar'     => '',
        'rating'     => '',       // 1-5
        'align'      => 'left',   // left, center, right
        'background' => '',
        'padding'    => 'md',     // xs, sm, md, lg, xl
        'shadow'     => 'yes',    // yes, no
        'neobrutal'  => 'yes',    // yes, no
        'border'     => 'no',     // yes, no
    ), $atts, 'saas_testimonial' );
    
    // Construir clases
    $classes = array( 'saas-testimonial' );
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = esc_attr( $atts['class'] );
    }
    
    // Alineación
    $classes[] = 'saas-testimonial--' . esc_attr( $atts['align'] );
    
    // Padding
    $classes[] = 'saas-p-' . esc_attr( $atts['padding'] );
    
    // Sombra
    if ( 'yes' === $atts['shadow'] ) {
        $classes[] = 'saas-testimonial--shadow';
    }
    
    // Estilo neo-brutalista
    if ( 'yes' === $atts['neobrutal'] ) {
        $classes[] = 'saas-testimonial--neobrutal';
    }
    
    // Borde
    if ( 'yes' === $atts['border'] ) {
        $classes[] = 'saas-testimonial--border';
    }
    
    // Estilos inline
    $styles = array();
    
    if ( ! empty( $atts['background'] ) ) {
        $styles[] = 'background-color: ' . esc_attr( $atts['background'] );
    }
    
    $style_attr = ! empty( $styles ) ? ' style="' . implode( '; ', $styles ) . '"' : '';
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Preparar avatar
    $avatar_html = '';
    if ( ! empty( $atts['avatar'] ) ) {
        $avatar_html = '<div class="saas-testimonial__avatar"><img src="' . esc_url( $atts['avatar'] ) . '" alt="' . esc_attr( $atts['name'] ) . '"></div>';
    }
    
    // Preparar rating
    $rating_html = '';
    if ( ! empty( $atts['rating'] ) && is_numeric( $atts['rating'] ) && $atts['rating'] >= 1 && $atts['rating'] <= 5 ) {
        $rating_html = '<div class="saas-testimonial__rating">';
        for ( $i = 1; $i <= 5; $i++ ) {
            $star_class = $i <= $atts['rating'] ? 'saas-testimonial__star--filled' : 'saas-testimonial__star--empty';
            $rating_html .= '<span class="saas-testimonial__star ' . $star_class . '">★</span>';
        }
        $rating_html .= '</div>';
    }
    
    // Preparar información del autor
    $author_info = '';
    if ( ! empty( $atts['name'] ) ) {
        $author_info .= '<div class="saas-testimonial__author-name">' . esc_html( $atts['name'] ) . '</div>';
    }
    
    if ( ! empty( $atts['position'] ) || ! empty( $atts['company'] ) ) {
        $author_info .= '<div class="saas-testimonial__author-details">';
        
        if ( ! empty( $atts['position'] ) ) {
            $author_info .= '<span class="saas-testimonial__position">' . esc_html( $atts['position'] ) . '</span>';
        }
        
        if ( ! empty( $atts['position'] ) && ! empty( $atts['company'] ) ) {
            $author_info .= ' - ';
        }
        
        if ( ! empty( $atts['company'] ) ) {
            $author_info .= '<span class="saas-testimonial__company">' . esc_html( $atts['company'] ) . '</span>';
        }
        
        $author_info .= '</div>';
    }
    
    // Salida HTML
    $output = '<div class="' . esc_attr( implode( ' ', $classes ) ) . '"' . $id_attr . $style_attr . '>';
    
    // Contenido
    $output .= '<div class="saas-testimonial__content">';
    $output .= $rating_html;
    $output .= '<div class="saas-testimonial__text">' . do_shortcode( $content ) . '</div>';
    $output .= '</div>';
    
    // Autor
    $output .= '<div class="saas-testimonial__author">';
    $output .= $avatar_html;
    
    if ( ! empty( $author_info ) ) {
        $output .= '<div class="saas-testimonial__author-info">' . $author_info . '</div>';
    }
    
    $output .= '</div>';
    $output .= '</div>';
    
    return $output;
}

/**
 * Shortcode para llamadas a la acción (CTA)
 */
function nova_ui_cta_shortcode( $atts, $content = null ) {
    $atts = shortcode_atts( array(
        'id'          => '',
        'class'       => '',
        'title'       => '',
        'subtitle'    => '',
        'align'       => 'center',   // left, center, right
        'background'  => '',
        'text_color'  => '',
        'padding'     => 'lg',       // xs, sm, md, lg, xl, 2xl
        'layout'      => 'standard', // standard, split, compact
        'shadow'      => 'yes',      // yes, no
        'neobrutal'   => 'yes',      // yes, no
        'border'      => 'no',       // yes, no
        'button_text' => '',
        'button_url'  => '',
        'button_style'=> 'primary',
        'button_size' => 'lg',
        'image'       => '',
    ), $atts, 'saas_cta' );
    
    // Construir clases
    $classes = array( 'saas-cta' );
    
    if ( ! empty( $atts['class'] ) ) {
        $classes[] = esc_attr( $atts['class'] );
    }
    
    // Layout
    $classes[] = 'saas-cta--' . esc_attr( $atts['layout'] );
    
    // Alineación
    $classes[] = 'saas-cta--' . esc_attr( $atts['align'] );
    
    // Padding
    $classes[] = 'saas-p-' . esc_attr( $atts['padding'] );
    
    // Sombra
    if ( 'yes' === $atts['shadow'] ) {
        $classes[] = 'saas-cta--shadow';
    }
    
    // Estilo neo-brutalista
    if ( 'yes' === $atts['neobrutal'] ) {
        $classes[] = 'saas-cta--neobrutal';
    }
    
    // Borde
    if ( 'yes' === $atts['border'] ) {
        $classes[] = 'saas-cta--border';
    }
    
    // Con imagen
    if ( ! empty( $atts['image'] ) ) {
        $classes[] = 'saas-cta--with-image';
    }
    
    // Estilos inline
    $styles = array();
    
    if ( ! empty( $atts['background'] ) ) {
        $styles[] = 'background-color: ' . esc_attr( $atts['background'] );
    }
    
    if ( ! empty( $atts['text_color'] ) ) {
        $styles[] = 'color: ' . esc_attr( $atts['text_color'] );
    }
    
    $style_attr = ! empty( $styles ) ? ' style="' . implode( '; ', $styles ) . '"' : '';
    $id_attr = ! empty( $atts['id'] ) ? ' id="' . esc_attr( $atts['id'] ) . '"' : '';
    
    // Preparar título
    $title_html = '';
    if ( ! empty( $atts['title'] ) ) {
        $title_html = '<h2 class="saas-cta__title">' . esc_html( $atts['title'] ) . '</h2>';
    }
    
    // Preparar subtítulo
    $subtitle_html = '';
    if ( ! empty( $atts['subtitle'] ) ) {
        $subtitle_html = '<div class="saas-cta__subtitle">' . esc_html( $atts['subtitle'] ) . '</div>';
    }
    
    // Preparar botón
    $button_html = '';
    if ( ! empty( $atts['button_text'] ) && ! empty( $atts['button_url'] ) ) {
        $button_html = do_shortcode('[saas_button url="' . esc_attr( $atts['button_url'] ) . '" style="' . esc_attr( $atts['button_style'] ) . '" size="' . esc_attr( $atts['button_size'] ) . '"]' . esc_html( $atts['button_text'] ) . '[/saas_button]');
    }
    
    // Preparar imagen
    $image_html = '';
    if ( ! empty( $atts['image'] ) ) {
        $image_html = '<div class="saas-cta__image"><img src="' . esc_url( $atts['image'] ) . '" alt=""></div>';
    }
    
    // Preparar contenido
    $content_html = '';
    if ( ! empty( $content ) ) {
        $content_html = '<div class="saas-cta__text">' . do_shortcode( $content ) . '</div>';
    }
    
    // Salida HTML
    $output = '<div class="' . esc_attr( implode( ' ', $classes ) ) . '"' . $id_attr . $style_attr . '>';
    
    // Layout con imagen
    if ( ! empty( $image_html ) && 'split' === $atts['layout'] ) {
        $output .= '<div class="saas-cta__content-wrapper">';
    }
    
    // Contenido
    $output .= '<div class="saas-cta__content">';
    $output .= $title_html;
    $output .= $subtitle_html;
    $output .= $content_html;
    
    // Acción
    if ( ! empty( $button_html ) ) {
        $output .= '<div class="saas-cta__action">' . $button_html . '</div>';
    }
    
    $output .= '</div>';
    
    // Imagen (si el layout es split)
    if ( ! empty( $image_html ) && 'split' === $atts['layout'] ) {
        $output .= $image_html;
        $output .= '</div>'; // Cierre de content-wrapper
    } elseif ( ! empty( $image_html ) && 'standard' === $atts['layout'] ) {
        // Imagen para layout estándar (arriba o abajo)
        $output .= $image_html;
    }
    
    $output .= '</div>';
    
    return $output;
}
