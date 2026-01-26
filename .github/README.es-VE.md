# Laravel Extra Boost

<a href="https://packagist.org/packages/akrista/laravel-extra-boost"><img src="https://img.shields.io/packagist/dt/akrista/laravel-extra-boost" alt="Descargas Totales"></a>
<a href="https://packagist.org/packages/akrista/laravel-extra-boost"><img src="https://img.shields.io/packagist/v/akrista/laravel-extra-boost" alt="Última Versión Estable"></a>
<a href="https://packagist.org/packages/akrista/laravel-extra-boost"><img src="https://img.shields.io/packagist/l/akrista/laravel-extra-boost" alt="Licencia"></a>

[English](README.md) | Español 

## Compatibilidad de Versiones

⚠️ **Aviso Importante**: Este paquete tiene diferentes versiones para diferentes versiones de Laravel Boost:

- **Versión 1.x**: Compatible con Laravel Boost 1.x (legacy)
- **Versión 2.x**: Compatible con Laravel Boost 2.x (estable actual)

## Introducción

Laravel Extra Boost es un fork del paquete original [gonetone/laravel-boost-windsurf-extension](https://packagist.org/packages/gonetone/laravel-boost-windsurf-extension). Es un paquete de extensión para [Laravel Boost](https://github.com/laravel/boost) que proporciona integración para entornos de desarrollo adicionales con IA incluyendo [Windsurf](https://windsurf.com/) y [Antigravity](https://antigravity.dev/). Este paquete mejora Laravel Boost añadiendo soporte para estos asistentes de codificación con IA modernos y proporciona comandos personalizados para gestionar el frontmatter en archivos de guías.

### Acerca de esta Implementación

Este paquete sigue mi metodología de trabajo personal. En lugar de usar el archivo `.windsurfrules`, utiliza la estructura de directorios `.windsurf/rules/laravel-boost.md`. De manera similar, en lugar de tener opciones separadas para Windsurf y Windsurf JetBrains plugins, al crear la configuración MCP de Windsurf, la crea tanto en `.codeium` como en `.codeium/windsurf` para asegurar compatibilidad con ambas configuraciones.

## Características

- **Integración con Windsurf**: Soporte completo para el editor Windsurf y el plugin Windsurf para JetBrains
- **Integración con Antigravity**: Soporte completo para el entorno de desarrollo con IA Antigravity
- **Gestión de Frontmatter Personalizado**: Corrige automáticamente el frontmatter en archivos de guías para entornos soportados
- **Configuración de Servidor MCP**: Configura servidores de Protocolo de Contexto de Modelo (MCP) para entornos soportados
- **Soporte de Skills**: Soporte para skills de agentes de IA con directorios dedicados
- **Comandos Mejorados**: Proporciona los comandos `extra-boost:install` y `extra-boost:update`
- **Arquitectura de Agentes**: Construido sobre el nuevo sistema de Agentes para mejor extensibilidad

## Requisitos

### Para Versión 1.x (Laravel Boost 1.x)
- PHP 8.1 o superior
- Laravel 10.49.0, 11.45.3, o 12.41.1 y superior
- Laravel Boost 1.x

### Para Versión 2.x (Laravel Boost 2.x)
- PHP 8.2 o superior
- Laravel 11.45.3 o 12.41.1 y superior
- Laravel Boost 2.0.0 o superior

### Requisitos Comunes
- [Editor Windsurf](https://windsurf.com/editor) o [Plugin Windsurf para JetBrains](https://plugins.jetbrains.com/plugin/20540-windsurf-plugin-formerly-codeium-for-python-js-java-go--) (para soporte de Windsurf)
- [Antigravity](https://antigravity.dev/) (para soporte de Antigravity)

## Instalación

### Opción A: Para Laravel Boost 1.x (Legacy)

Instala la versión legacy:

```bash
composer require akrista/laravel-extra-boost:^1.0 --dev
```

### Opción B: Para Laravel Boost 2.x (Estable Actual)

Instala la versión estable actual:

```bash
composer require akrista/laravel-extra-boost --dev
```

### Paso 2: Instalar Laravel Boost

Ejecuta el comando de instalación mejorado para instalar Laravel Boost con soporte para Windsurf y Antigravity:

```bash
php artisan extra-boost:install
```

Este comando:
- Instalará Laravel Boost con todas sus características
- Detectará y configurará automáticamente los entornos soportados
- Corregirá el frontmatter en archivos de guías para Windsurf y Antigravity

Durante la instalación, se te pedirá que selecciones entornos. Las opciones disponibles incluirán:

- `windsurf` - Para el Editor Windsurf y el Plugin Windsurf para JetBrains
- `antigravity` - Para el entorno de desarrollo con IA Antigravity

### Parámetros de Instalación Opcionales

Puedes omitir características específicas durante la instalación:

```bash
# Omitir la instalación de guías de IA
php artisan extra-boost:install --ignore-guidelines

# Omitir la instalación de la configuración del servidor MCP
php artisan extra-boost:install --ignore-mcp

# Omitir ambos
php artisan extra-boost:install --ignore-guidelines --ignore-mcp
```

## Uso

### Actualizar Guías

Para actualizar las guías de Laravel Boost y corregir el frontmatter para entornos soportados:

```bash
php artisan extra-boost:update
```

### Cambiar entre Proyectos

Dado que Windsurf y Antigravity usan archivos de configuración MCP a nivel global, necesitas ejecutar el siguiente comando al cambiar entre diferentes proyectos de Laravel:

```bash
php artisan extra-boost:install --no-interaction
```

Esto asegura que la configuración MCP apunte a la ruta correcta para el proyecto actual.

## Configuración

Después de la instalación, el paquete automáticamente:

1. Registrará los agentes Windsurf y Antigravity con Laravel Boost
2. Configurará servidores MCP para entornos soportados
3. Creará o actualizará archivos de guías con el frontmatter adecuado:
   - `.windsurf/rules/laravel-boost.md` para Windsurf
   - `.agent/rules/laravel-boost.md` para Antigravity
4. Creará directorios de skills:
   - `.windsurf/skills/` para skills de IA de Windsurf
   - `.agent/skills/` para skills de IA de Antigravity

## Guía de Migración

### Actualizar de 1.x a 2.x

Si estás actualizando de Laravel Extra Boost 1.x a 2.x:

1. Asegúrate de estar usando Laravel Boost 2.0.0 o superior
2. Actualiza tu composer.json:
   ```json
   {
       "require": {
           "akrista/laravel-extra-boost": "^2.0"
       }
   }
   ```
3. Ejecuta `composer update`
4. El paquete usará automáticamente la nueva arquitectura de Boost 2.x

### Cambios Rotos en 2.x

- La arquitectura migró de CodeEnvironment al sistema de Agentes
- Contratos actualizados: SupportsGuidelines, SupportsMcp, SupportsSkills
- Namespace cambiado de `CodeEnvironment` a `Agents`
- Versión mínima de PHP aumentada a 8.2

## Licencia

Laravel Extra Boost es software de código abierto licenciado bajo la [licencia MIT](LICENSE).
