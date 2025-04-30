<?php
/**
 * Clase para manejar la documentación de Marquee Text
 */

if (!defined('ABSPATH')) {
    exit;
}

class Marquee_Text_Docs {
    /**
     * Registra el menú de administración
     */
    public function register() {
        add_action('admin_menu', array($this, 'add_menu'));
    }

    /**
     * Agrega el menú de administración
     */
    public function add_menu() {
        add_submenu_page(
            'tools.php',
            'Documentación Marquee Text',
            'Marquee Text',
            'manage_options',
            'marquee-text-docs',
            array($this, 'render_page')
        );
    }

    /**
     * Renderiza la página de documentación
     */
    public function render_page() {
        ?>
        <div class="wrap">
            <h1><?php _e('Documentation - Shortcode [marquee-text]', 'marquee-text'); ?></h1>
            <p><?php _e('This shortcode generates a "marquee" type text slider using SwiperJS.', 'marquee-text'); ?></p>

            <h2><?php _e('Basic Usage:', 'marquee-text'); ?></h2>
            <code>[marquee-text text="Text 1; Text 2; Text 3"]</code>

            <h2><?php _e('Available Parameters:', 'marquee-text'); ?></h2>
            <ul>
                <li><strong>text</strong> (<?php _e('required', 'marquee-text'); ?>): <?php _e('list of texts separated by semicolon (;).', 'marquee-text'); ?></li>
                <li><strong>speed</strong> (<?php _e('optional', 'marquee-text'); ?>): <?php _e('scroll speed in milliseconds. Default: 3000.', 'marquee-text'); ?></li>
                <li><strong>direction</strong> (<?php _e('optional', 'marquee-text'); ?>): <?php _e('"left" or "right". If left, text moves from left to right. Default: left.', 'marquee-text'); ?></li>
                <li><strong>min_slides</strong> (<?php _e('optional', 'marquee-text'); ?>): <?php _e('minimum number of slides for smooth loop. Default: 20.', 'marquee-text'); ?></li>
                <li><strong>id</strong> (<?php _e('optional', 'marquee-text'); ?>): <?php _e('custom ID for the slider.', 'marquee-text'); ?></li>
                <li><strong>fade</strong> (<?php _e('optional', 'marquee-text'); ?>): <?php _e('"true" or "false". Adds fade effect on edges.', 'marquee-text'); ?></li>
                <li><strong>fs</strong> (<?php _e('optional', 'marquee-text'); ?>): <?php _e('Font size (e.g. "16px", "1.2rem").', 'marquee-text'); ?></li>
                <li><strong>fw</strong> (<?php _e('optional', 'marquee-text'); ?>): <?php _e('Font weight (e.g. "400", "bold").', 'marquee-text'); ?></li>
                <li><strong>fc</strong> (<?php _e('optional', 'marquee-text'); ?>): <?php _e('Font color (e.g. "#ff0000", "red").', 'marquee-text'); ?></li>
                <li><strong>tt</strong> (<?php _e('optional', 'marquee-text'); ?>): <?php _e('Text transform (e.g. "uppercase", "lowercase", "capitalize").', 'marquee-text'); ?></li>
            </ul>

            <h2><?php _e('Advanced Example:', 'marquee-text'); ?></h2>
            <code>[marquee-text text="Offer 1; Offer 2; Offer 3" speed="4000" direction="right" min_slides="40" id="unique-offers" fade="true" fs="20px" fw="bold" fc="#ff0000" tt="uppercase"]</code>

            <h2><?php _e('Notes:', 'marquee-text'); ?></h2>
            <ul>
                <li><?php _e('SwiperJS is automatically loaded if not present.', 'marquee-text'); ?></li>
                <li><?php _e('Multiple sliders are allowed on the same page.', 'marquee-text'); ?></li>
                <li><?php _e('All texts are wrapped in a &lt;span&gt; with class <code>text-style</code>.', 'marquee-text'); ?></li>
                <li><?php _e('Texts are sanitized to prevent XSS.', 'marquee-text'); ?></li>
                <li><?php _e('Error handling is included for better debugging.', 'marquee-text'); ?></li>
            </ul>

            <p><em><?php printf(__('Version: %s', 'marquee-text'), MARQUEE_TEXT_VERSION); ?></em></p>
        </div>
        <?php
    }
} 