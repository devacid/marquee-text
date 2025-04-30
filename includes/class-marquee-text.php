<?php
/**
 * Clase principal del plugin Marquee Text
 */

if (!defined('ABSPATH')) {
    exit;
}

class Marquee_Text {
    /**
     * Inicializa el plugin
     */
    public function init() {
        // Cargar clases necesarias
        require_once MARQUEE_TEXT_PLUGIN_DIR . 'includes/shortcodes/class-marquee-text-shortcode.php';
        require_once MARQUEE_TEXT_PLUGIN_DIR . 'includes/admin/class-marquee-text-docs.php';

        // Inicializar shortcode
        $shortcode = new Marquee_Text_Shortcode();
        $shortcode->register();

        // Inicializar documentación
        $docs = new Marquee_Text_Docs();
        $docs->register();
    }
} 