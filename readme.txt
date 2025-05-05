=== Marquee Text ===
Contributors: devacid
Tags: marquee, text, animation, elementor
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.2
Stable tag: 1.0.2
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Un plugin para crear textos en movimiento tipo marquee usando SwiperJS. Incluye soporte opcional para Elementor.

== Description ==

Marquee Text es un plugin que te permite crear textos en movimiento (marquee) de manera fácil y personalizable. Utiliza SwiperJS para crear animaciones suaves y profesionales.

= Características =

* Creación de textos en movimiento con shortcodes
* Soporte opcional para Elementor (widget nativo)
* Personalización de velocidad y dirección
* Estilos personalizables
* Compatible con temas modernos

= Requisitos =

* WordPress 5.0 o superior
* PHP 7.2 o superior
* Elementor (opcional, solo para el widget nativo)

= Uso Básico =

`[marquee-text textos="Texto1; Texto2; Texto3"]`

= Parámetros Disponibles =

* `textos` (requerido): Lista de textos separados por punto y coma (;)
* `velocidad` (opcional): Velocidad de desplazamiento en milisegundos. Default: 3000
* `invertir-sentido` (opcional): "true" o "false". Si es true, el texto se mueve de derecha a izquierda. Default: false
* `min_slides` (opcional): Cantidad mínima de slides para loop fluido. Default: 20
* `id` (opcional): ID personalizado para el slider
* `fade` (opcional): "true" o "false". Agrega efecto de desvanecimiento en los bordes
* `fs` (opcional): Tamaño de la fuente (ej: "16px", "1.2rem")
* `fw` (opcional): Peso de la fuente (ej: "400", "bold")
* `fc` (opcional): Color de la fuente (ej: "#ff0000", "red")
* `tt` (opcional): Transformación del texto (ej: "uppercase", "lowercase", "capitalize")

= Ejemplo Avanzado =

`[marquee-text textos="Oferta 1; Oferta 2; Oferta 3" velocidad="4000" invertir-sentido="true" min_slides="40" id="ofertas-unicas" fade="true" fs="20px" fw="bold" fc="#ff0000" tt="uppercase"]`

== Installation ==

1. Sube el directorio `marquee-text` a la carpeta `/wp-content/plugins/`
2. Activa el plugin a través del menú 'Plugins' en WordPress
3. Usa el shortcode `[marquee_text]` o el widget de Elementor (si está instalado)

== Frequently Asked Questions ==

= ¿Necesito Elementor para usar este plugin? =

No, Elementor es opcional. Puedes usar el plugin con shortcodes sin necesidad de Elementor. El widget de Elementor es una característica adicional que se activa solo si Elementor está instalado.

= ¿Cómo uso el shortcode? =

Usa el shortcode `[marquee_text]` con los parámetros que desees. Por ejemplo:
`[marquee_text text="Tu texto aquí" speed="20"]`

= ¿Puedo usar múltiples marquees en la misma página? =

Sí, puedes usar tantos marquees como necesites en la misma página. Cada uno funcionará de manera independiente.

= ¿El plugin es compatible con mi tema? =

Sí, el plugin es compatible con cualquier tema de WordPress que siga los estándares de WordPress.

= ¿Puedo personalizar los estilos? =

Sí, puedes personalizar el tamaño de fuente, color, peso y transformación del texto usando los parámetros del shortcode.

== Screenshots ==

1. Ejemplo básico de marquee text
2. Ejemplo con efecto fade
3. Ejemplo con estilos personalizados

== Changelog ==

= 1.0.2 =
* Actualización de SwiperJS a la versión 11
* Mejoras en la inicialización de los sliders
* Optimización del código JavaScript

= 1.0.1 =
* Agregado soporte opcional para Elementor
* Mejorada la compatibilidad con temas modernos
* Optimización de rendimiento

= 1.0.0 =
* Lanzamiento inicial
* Implementación del shortcode básico
* Soporte para personalización de estilos
* Integración con SwiperJS
* Efecto de desvanecimiento en los bordes

== Upgrade Notice ==

= 1.0.2 =
Esta versión actualiza SwiperJS a la versión 11 y mejora la inicialización de los sliders.

= 1.0.1 =
Esta versión agrega soporte opcional para Elementor y mejoras de rendimiento.

= 1.0.0 =
Lanzamiento inicial del plugin Marquee Text. 