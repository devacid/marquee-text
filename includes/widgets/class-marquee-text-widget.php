<?php
/**
 * Widget de Marquee Text para Elementor
 */

if (!defined('ABSPATH')) {
    exit; // Salir si se accede directamente
}

// Verificar que Elementor esté cargado
if (!did_action('elementor/loaded')) {
    return;
}

// Asegurar que la clase base de Elementor esté disponible
if (!class_exists('\Elementor\Widget_Base')) {
    return;
}

class Marquee_Text_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'marquee_text';
    }

    public function get_title() {
        return __('Marquee Text', 'marquee-text');
    }

    public function get_icon() {
        return 'eicon-text';
    }

    public function get_categories() {
        return ['devacid-addons'];
    }

    public function get_script_depends() {
        return ['swiper'];
    }

    public function get_style_depends() {
        return ['swiper', 'marquee-text-styles'];
    }


    protected function register_controls() : void {
      
        // Sección de Contenido
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Slides de Texto', 'marquee-text'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'text',
            [
                'label' => __('Texto', 'marquee-text'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Tu texto aquí...', 'marquee-text'),
                'label_block' => true,
            ]
        );

        $this->add_control(
            'text_items',
            [
                'label' => __('Elementos de Texto', 'marquee-text'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'text' => __('Primer texto...', 'marquee-text'),
                    ],
                ],
                'title_field' => '{{{ text }}}',
            ]
        );

        $this->end_controls_section();
        // Sección de Configuración
        $this->start_controls_section(
          'config_section',
          [
              'label' => __('Configuración', 'marquee-text'),
              'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
          ]
      );

      $this->add_control(
          'marquee_id',
          [
              'label' => __('ID del Marquee', 'marquee-text'),
              'type' => \Elementor\Controls_Manager::TEXT,
              'default' => '',
              'description' => __('ID único para este marquee. Útil para personalización CSS.', 'marquee-text'),
          ]
      );

      $this->add_control(
          'direction',
          [
              'label' => __('Dirección', 'marquee-text'),
              'type' => \Elementor\Controls_Manager::SELECT,
              'default' => 'left',
              'options' => [
                  'left' => __('Izquierda', 'marquee-text'),
                  'right' => __('Derecha', 'marquee-text'),
              ],
          ]
      );

      $this->add_control(
          'speed',
          [
              'label' => __('Velocidad (milisegundos)', 'marquee-text'),
              'type' => \Elementor\Controls_Manager::NUMBER,
              'default' => 3000,
              'min' => 1,
              'max' => 50000,
              'step' => 100,
          ]
      );

      $this->add_control(
          'min_slides',
          [
              'label' => __('Slides Mínimos', 'marquee-text'),
              'type' => \Elementor\Controls_Manager::NUMBER,
              'default' => 20,
              'min' => 1,
              'max' => 50,
              'step' => 1,
          ]
      );

      $this->add_control(
          'enable_fade',
          [
              'label' => __('Fade en las orillas', 'marquee-text'),
              'type' => \Elementor\Controls_Manager::SWITCHER,
              'label_on' => __('Sí', 'marquee-text'),
              'label_off' => __('No', 'marquee-text'),
              'return_value' => 'yes',
              'default' => 'no',
          ]
      );

      $this->end_controls_section();

        // Sección de Estilos
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Estilos del Texto', 'marquee-text'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'text_typography',
                'label' => __('Tipografía', 'marquee-text'),
                'selector' => '{{WRAPPER}} .swiper-slide .text-style',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => 'text_stroke',
                'selector' => '{{WRAPPER}} .swiper-slide .text-style',
            ]
        );

        $this->add_control(
            'text_color',
            [
                'label' => __('Color del Texto', 'marquee-text'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .text-style' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        try {
            $settings = $this->get_settings_for_display();
            
            // Validación y sanitización
            $speed = absint($settings['speed']);
            if ($speed < 100) {
                $speed = 100;
            }

            $min_slides = absint($settings['min_slides']);
            if ($min_slides < 1) {
                $min_slides = 1;
            }

            // Clases CSS
            $classes = array('swiper', 'marquee-text');
            if ($settings['enable_fade'] === 'yes') {
                $classes[] = 'fade';
            }

            // ID del slider
            $slider_id = !empty($settings['marquee_id']) ? sanitize_html_class($settings['marquee_id']) : 'swiper-' . uniqid();

            // Configuración para el script
            $config = array(
                'id' => $slider_id,
                'speed' => $speed,
                'direction' => ($settings['direction'] === 'right') ? 'true' : 'false'
            );

            // Guardar configuración global
            global $marquee_text_sliders;
            if (!isset($marquee_text_sliders)) {
                $marquee_text_sliders = array();
            }
            $marquee_text_sliders[] = $config;

            if (empty($settings['text_items'])) {
                echo '<!-- Marquee Text: No texts to display -->';
                return;
            }

            // Calculamos cuántas veces repetir
            $text_count = count($settings['text_items']);
            $repetitions = ceil($min_slides / $text_count);

            ?>
            <div class="<?php echo esc_attr(implode(' ', $classes)); ?>" id="<?php echo esc_attr($slider_id); ?>">
                <div class="swiper-wrapper" style="-webkit-transition-timing-function: linear !important; transition-timing-function: linear !important;">
                    <?php for ($i = 0; $i < $repetitions; $i++) : ?>
                        <?php foreach ($settings['text_items'] as $item) : ?>
                            <div class="swiper-slide">
                                <span class="text-style"><?php echo wp_kses_post($item['text']); ?></span>
                            </div>
                        <?php endforeach; ?>
                    <?php endfor; ?>
                </div>
            </div>
            <?php
        } catch (Exception $e) {
            error_log('Marquee Text Error: ' . $e->getMessage());
            echo '<!-- Error in Marquee Text: ' . esc_html($e->getMessage()) . ' -->';
        }
    }
} 