# Marquee Text

Un plugin para WordPress que permite crear textos en movimiento (marquee) de manera fácil y personalizable. Incluye soporte opcional para Elementor.

## 🚀 Características

- Creación de textos en movimiento con shortcodes
- Soporte opcional para Elementor (widget nativo)
- Personalización de velocidad y dirección
- Efecto de desvanecimiento en los bordes
- Personalización de estilos (tamaño, color, peso de fuente)
- Múltiples instancias en la misma página
- Responsive y adaptable a cualquier tema

## 📋 Requisitos

- WordPress 5.0 o superior
- PHP 7.2 o superior
- Elementor (opcional, solo para el widget nativo)

## 🛠️ Instalación

1. Sube el directorio `marquee-text` a la carpeta `/wp-content/plugins/`
2. Activa el plugin a través del menú 'Plugins' en WordPress
3. Usa el shortcode `[marquee_text]` o el widget de Elementor (si está instalado)

## 💻 Uso

### Uso Básico
```php
[marquee_text text="Tu texto aquí" speed="20"]
```

### Widget de Elementor

Si tienes Elementor instalado, encontrarás el widget "Texto en Movimiento" en la lista de widgets de Elementor.

### Parámetros Disponibles

| Parámetro | Descripción | Default |
|-----------|-------------|---------|
| `text` | El texto que se mostrará | (requerido) |
| `speed` | Velocidad de la animación (en segundos) | 20 |
| `direction` | Dirección del movimiento (left/right) | left |
| `min_slides` | Cantidad mínima de slides para loop fluido | 20 |
| `id` | ID personalizado para el slider | (auto) |
| `fade` | "true" o "false". Agrega efecto de desvanecimiento en los bordes | false |
| `fs` | Tamaño de la fuente (ej: "16px", "1.2rem") | 16px |
| `fw` | Peso de la fuente (ej: "400", "bold") | 500 |
| `fc` | Color de la fuente (ej: "#ff0000", "red") | #333 |
| `tt` | Transformación del texto (ej: "uppercase", "lowercase", "capitalize") | none |

### Ejemplo Avanzado
```php
[marquee_text 
    text="Oferta 1; Oferta 2; Oferta 3" 
    speed="4000" 
    direction="right" 
    min_slides="40" 
    id="ofertas-unicas" 
    fade="true" 
    fs="20px" 
    fw="bold" 
    fc="#ff0000" 
    tt="uppercase"
]
```

## ❓ Preguntas Frecuentes

### ¿Necesito Elementor para usar este plugin?

No, Elementor es opcional. Puedes usar el plugin con shortcodes sin necesidad de Elementor. El widget de Elementor es una característica adicional que se activa solo si Elementor está instalado.

### ¿Cómo personalizo el texto en movimiento?

Puedes personalizar el texto en movimiento usando los parámetros del shortcode o las opciones del widget de Elementor:

* `text`: El texto que se mostrará
* `speed`: Velocidad de la animación (en segundos)
* `direction`: Dirección del movimiento (left/right)

### ¿Puedo usar múltiples marquees en la misma página?
Sí, puedes usar tantos marquees como necesites en la misma página. Cada uno funcionará de manera independiente.

### ¿El plugin es compatible con mi tema?
Sí, el plugin es compatible con cualquier tema de WordPress que siga los estándares de WordPress.

### ¿Puedo personalizar los estilos?
Sí, puedes personalizar el tamaño de fuente, color, peso y transformación del texto usando los parámetros del shortcode.

## 📝 Changelog

### 1.0.1
* Agregado soporte opcional para Elementor
* Mejorada la compatibilidad con temas modernos
* Optimización de rendimiento

### 1.0.0
- Lanzamiento inicial
- Implementación del shortcode básico
- Soporte para personalización de estilos
- Integración con SwiperJS
- Efecto de desvanecimiento en los bordes

## 📄 Licencia

[![GPLv3 License](https://img.shields.io/badge/License-GPL%20v3-yellow.svg)](https://opensource.org/licenses/)

Este plugin está licenciado bajo GPL v3 o posterior.

## 👨‍💻 Autor

**devAcid**
- Website: [https://devacid.xyz](https://devacid.xyz)
- GitHub: [@devacid](https://github.com/devacid)

## ⭐ Donaciones

Si te gusta este plugin, considera hacer una donación para apoyar su desarrollo.

[![Donate](https://img.shields.io/badge/Donate-PayPal-green.svg)](https://www.paypal.com/donate/?hosted_button_id=AF9TTD4YT4W9W) 