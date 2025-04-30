<?php
/**
 * Plugin Name: Marquee Text
 * Plugin URI: https://github.com/devacid/marquee-text
 * Description: Un plugin para crear textos en movimiento tipo marquee usando SwiperJS. Incluye soporte opcional para Elementor.
 * Version: 1.0.1
 * Author: devAcid
 * Author URI: https://devacid.xyz
 * Text Domain: marquee-text
 * Domain Path: /languages
 * License: GPL v3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * Requires at least: 5.0
 * Requires PHP: 7.2
 * Elementor requires at least: 3.0.0
 * Elementor tested up to: 3.20.0
 */

// Prevenir acceso directo
if (!defined('ABSPATH')) {
    exit;
}

// Definir constantes del plugin
define('MARQUEE_TEXT_VERSION', '1.0.1');
define('MARQUEE_TEXT_PLUGIN_DIR', plugin_dir_path(__FILE__));
define('MARQUEE_TEXT_PLUGIN_URL', plugin_dir_url(__FILE__));

// Incluir el plugin-update-checker
require_once MARQUEE_TEXT_PLUGIN_DIR . 'plugin-update-checker/plugin-update-checker.php';

// Configurar el checker de actualizaciones
use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

$updateChecker = PucFactory::buildUpdateChecker(
    'https://github.com/devacid/marquee-text', // URL del repositorio
    __FILE__, // Ruta al archivo principal del plugin
    'marquee-text' // Slug del plugin
);

// Opcional: Configurar la rama de GitHub
$updateChecker->setBranch('main');

// Habilitar actualizaciones usando tags de GitHub
$updateChecker->getVcsApi()->enableReleaseAssets();

// Opcional: Configurar el acceso a GitHub si el repositorio es privado
// $updateChecker->setAuthentication('tu-token-de-github');

// Incluir archivos necesarios
require_once MARQUEE_TEXT_PLUGIN_DIR . 'includes/class-marquee-text.php';

// Inicializar el plugin
function marquee_text_init() {
    $plugin = new Marquee_Text();
    $plugin->init();
}
add_action('plugins_loaded', 'marquee_text_init');

// Registrar widget de Elementor
function register_marquee_text_widget($widgets_manager) {
    if (did_action('elementor/loaded')) {
        require_once(MARQUEE_TEXT_PLUGIN_DIR . 'includes/widgets/class-marquee-text-widget.php');
        $widgets_manager->register(new \Marquee_Text_Widget());
    }
}
add_action('elementor/widgets/register', 'register_marquee_text_widget', 20);

// Registrar categoría de widgets de Elementor
function register_devacid_addons_category($elements_manager) {
    $elements_manager->add_category(
        'devacid-addons',
        [
            'title' => __('devAcid Addons', 'marquee-text'),
            'icon' => 'fa fa-plug',
        ]
    );
}
add_action('elementor/elements/categories_registered', 'register_devacid_addons_category');

// Agregar mensaje de advertencia si Elementor no está instalado
function marquee_text_admin_notice() {
    if (!did_action('elementor/loaded')) {
        ?>
        <div class="notice notice-warning is-dismissible">
            <p><?php _e('El widget de texto en movimiento requiere que Elementor esté instalado y activado.', 'marquee-text'); ?></p>
        </div>
        <?php
    }
}
add_action('admin_notices', 'marquee_text_admin_notice');

// Activación del plugin
register_activation_hook(__FILE__, 'marquee_text_activate');
function marquee_text_activate() {
    // Código de activación si es necesario
}

// Desactivación del plugin
register_deactivation_hook(__FILE__, 'marquee_text_deactivate');
function marquee_text_deactivate() {
    // Código de desactivación si es necesario
}

// Cargar estilos y scripts
function marquee_text_enqueue_scripts() {
    // Cargar estilos del plugin
    wp_enqueue_style(
        'marquee-text-styles',
        MARQUEE_TEXT_PLUGIN_URL . 'assets/css/marquee-text.css',
        array(),
        MARQUEE_TEXT_VERSION
    );

    // Cargar SwiperJS solo si hay sliders en la página
    global $marquee_text_sliders;
    if (!empty($marquee_text_sliders)) {
        wp_enqueue_style(
            'swiper',
            'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css',
            array(),
            '11.0.0'
        );
        wp_enqueue_script(
            'swiper',
            'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js',
            array(),
            '11.0.0',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'marquee_text_enqueue_scripts');

// Agregar script de inicialización
function marquee_text_footer_script() {
    global $marquee_text_sliders;
    if (!empty($marquee_text_sliders)) {
        ?>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            <?php foreach ($marquee_text_sliders as $config) : ?>
                new Swiper('#<?php echo esc_js($config['id']); ?>', {
                    slidesPerView: 'auto',
                    loop: true,
                    freeMode: true,
                    speed: <?php echo $config['speed']; ?>,
                    autoplay: {
                        delay: 0,
                        disableOnInteraction: false,
                        pauseOnMouseEnter: false,
                    },
                    allowTouchMove: false,
                    spaceBetween: 30,
                    reverseDirection: <?php echo $config['direction']; ?>,
                });
            <?php endforeach; ?>
        });
        </script>
        <?php
    }
}
add_action('wp_footer', 'marquee_text_footer_script', 100); 