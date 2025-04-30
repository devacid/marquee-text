<?php
/**
 * Clase para manejar el shortcode de Marquee Text
 */

if (!defined('ABSPATH')) {
    exit;
}

class Marquee_Text_Shortcode {
    /**
     * Registra el shortcode
     */
    public function register() {
        add_shortcode('marquee-text', array($this, 'render'));
    }

    /**
     * Renderiza el shortcode
     */
    public function render($atts) {
        try {
            $atts = shortcode_atts(array(
                'id' => '',
                'speed' => 3000,
                'direction' => 'left',
                'text' => '',
                'min_slides' => 20,
                'fade' => false,
                'fs' => '',
                'fw' => '',
                'fc' => '',
                'tt' => ''
            ), $atts, 'marquee-text');

            // Validación y sanitización
            $speed = absint($atts['speed']);
            if ($speed < 100) {
                $speed = 100;
            }

            $min_slides = absint($atts['min_slides']);
            if ($min_slides < 1) {
                $min_slides = 1;
            }

            // Sanitización de textos
            $texts = array_map(function($text) {
                return wp_kses_post(trim($text));
            }, explode(';', $atts['text']));
            
            $texts = array_filter($texts);
            $text_count = count($texts);

            if ($text_count === 0) {
                return '<!-- Marquee Text: No texts to display -->';
            }

            // Calculamos cuántas veces repetir
            $repetitions = ceil($min_slides / $text_count);

            // Clases CSS
            $classes = array('swiper', 'marquee-text');
            if ($atts['fade'] === 'true') {
                $classes[] = 'fade';
            }

            // ID del slider
            $slider_id = $atts['id'] ? sanitize_html_class($atts['id']) : 'swiper-' . uniqid();

            // Configuración para el script
            $config = array(
                'id' => $slider_id,
                'speed' => $speed,
                'direction' => ($atts['direction'] === 'right') ? 'true' : 'false'
            );

            // Guardar configuración global
            global $marquee_text_sliders;
            if (!isset($marquee_text_sliders)) {
                $marquee_text_sliders = array();
            }
            $marquee_text_sliders[] = $config;

            // Estilos personalizados
            $custom_styles = '';
            if (!empty($atts['fs']) || !empty($atts['fw']) || !empty($atts['fc']) || !empty($atts['tt'])) {
                $custom_styles = sprintf(
                    '<style>
                        #%s .text-style {
                            %s
                            %s
                            %s
                            %s
                        }
                    </style>',
                    esc_attr($slider_id),
                    !empty($atts['fs']) ? 'font-size: ' . esc_attr($atts['fs']) . ';' : '',
                    !empty($atts['fw']) ? 'font-weight: ' . esc_attr($atts['fw']) . ';' : '',
                    !empty($atts['fc']) ? 'color: ' . esc_attr($atts['fc']) . ';' : '',
                    !empty($atts['tt']) ? 'text-transform: ' . esc_attr($atts['tt']) . ';' : ''
                );
            }

            ob_start();
            if (!empty($custom_styles)) {
                echo $custom_styles;
            }
            ?>
            <div class="<?php echo esc_attr(implode(' ', $classes)); ?>" id="<?php echo esc_attr($slider_id); ?>">
                <div class="swiper-wrapper" style="-webkit-transition-timing-function: linear !important; transition-timing-function: linear !important;">
                    <?php for ($i = 0; $i < $repetitions; $i++) : ?>
                        <?php foreach ($texts as $text) : ?>
                            <div class="swiper-slide">
                                <span class="text-style"><?php echo $text; ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endfor; ?>
                </div>
            </div>
            <?php
            return ob_get_clean();
        } catch (Exception $e) {
            error_log('Marquee Text Error: ' . $e->getMessage());
            return '<!-- Error in Marquee Text: ' . esc_html($e->getMessage()) . ' -->';
        }
    }
} 