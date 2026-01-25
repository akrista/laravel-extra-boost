# Laravel Extra Boost

<a href="https://packagist.org/packages/akrista/laravel-extra-boost"><img src="https://img.shields.io/packagist/dt/akrista/laravel-extra-boost" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/akrista/laravel-extra-boost"><img src="https://img.shields.io/packagist/v/akrista/laravel-extra-boost" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/akrista/laravel-extra-boost"><img src="https://img.shields.io/packagist/l/akrista/laravel-extra-boost" alt="License"></a>

English | [Español](README.es-VE.md)

## Version Compatibility

⚠️ **Important Notice**: This package has different versions for different Laravel Boost versions:

- **Version 1.x**: Compatible with Laravel Boost 1.x (stable)
- **Version 2.x (Beta)**: Compatible with Laravel Boost 2.x (development)

## Introduction

Laravel Extra Boost is a fork of the original [gonetone/laravel-boost-windsurf-extension](https://packagist.org/packages/gonetone/laravel-boost-windsurf-extension) package. It's an extension package for [Laravel Boost](https://github.com/laravel/boost) that provides integration for additional AI-powered development environments including [Windsurf](https://windsurf.com/) and [Antigravity](https://antigravity.dev/). This package enhances Laravel Boost by adding support for these modern AI coding assistants and provides custom commands to manage frontmatter in guideline files.

### About This Implementation

This package follows my personal workflow methodology. Instead of using the `.windsurfrules` file, it uses the `.windsurf/rules/laravel-boost.md` directory structure. Similarly, rather than having separate options for Windsurf and Windsurf JetBrains plugins, when creating the Windsurf MCP configuration, it creates it in both `.codeium` and `.codeium/windsurf` directories to ensure compatibility with both setups.

## Features

- **Windsurf Integration**: Full support for Windsurf editor and Windsurf JetBrains plugin
- **Antigravity Integration**: Complete support for Antigravity AI development environment
- **Custom Frontmatter Management**: Automatically fixes frontmatter in guideline files for supported environments
- **MCP Server Configuration**: Configures Model Context Protocol (MCP) servers for supported environments
- **Skills Support**: (v2.x) Support for AI agent skills with dedicated skills directories
- **Enhanced Commands**: Provides `extra-boost:install` and `extra-boost:update` commands
- **Agent Architecture**: (v2.x) Built on the new Agent system for better extensibility

## Requirements

### For Version 1.x (Laravel Boost 1.x)
- PHP 8.1 or higher
- Laravel 10.49.0, 11.45.3, or 12.41.1 and higher
- Laravel Boost 1.x

### For Version 2.x Beta (Laravel Boost 2.x)
- PHP 8.2 or higher
- Laravel 11.45.3 or 12.41.1 and higher
- Laravel Boost 2.x (dev-main)

### Common Requirements
- [Windsurf Editor](https://windsurf.com/editor) or [Windsurf JetBrains Plugin](https://plugins.jetbrains.com/plugin/20540-windsurf-plugin-formerly-codeium-for-python-js-java-go--) (for Windsurf support)
- [Antigravity](https://antigravity.dev/) (for Antigravity support)

## Installation

### Option A: For Laravel Boost 1.x (Stable)

Install the stable version:

```bash
composer require akrista/laravel-extra-boost --dev
```

### Option B: For Laravel Boost 2.x (Beta)

Install the beta version:

```bash
composer require akrista/laravel-extra-boost:2.0.*@beta --dev
```

Or for development:

```bash
composer require akrista/laravel-extra-boost:dev-main --dev
```

### Step 2: Install Laravel Boost

Run the enhanced install command to install Laravel Boost with support for Windsurf and Antigravity:

```bash
php artisan extra-boost:install
```

This command will:
- Install Laravel Boost with all its features
- Automatically detect and configure supported environments
- Fix frontmatter in guideline files for Windsurf and Antigravity

During installation, you will be prompted to select environments. The available options will include:

- `windsurf` - For Windsurf Editor and Windsurf JetBrains Plugin
- `antigravity` - For Antigravity AI development environment

### Optional Installation Parameters

You can skip specific features during installation:

```bash
# Skip installing AI guidelines
php artisan extra-boost:install --ignore-guidelines

# Skip installing MCP server configuration
php artisan extra-boost:install --ignore-mcp

# Skip both
php artisan extra-boost:install --ignore-guidelines --ignore-mcp
```

## Usage

### Updating Guidelines

To update Laravel Boost guidelines and fix frontmatter for supported environments:

```bash
php artisan extra-boost:update
```

### Switching Between Projects

Since Windsurf and Antigravity use global-level MCP configuration files, you need to run the following command when switching between different Laravel projects:

```bash
php artisan extra-boost:install --no-interaction
```

This ensures that the MCP configuration points to the correct path for the current project.

## Configuration

After installation, the package will automatically:

1. Register the Windsurf and Antigravity agents with Laravel Boost
2. Configure MCP servers for supported environments
3. Create or update guideline files with proper frontmatter:
   - `.windsurf/rules/laravel-boost.md` for Windsurf
   - `.agent/rules/laravel-boost.md` for Antigravity
4. (v2.x) Create skills directories:
   - `.windsurf/skills/` for Windsurf AI skills
   - `.agent/skills/` for Antigravity AI skills

## Migration Guide

### Upgrading from 1.x to 2.x

If you're upgrading from Laravel Extra Boost 1.x to 2.x beta:

1. Ensure you're using Laravel Boost 2.x (dev-main)
2. Update your composer.json:
   ```json
   {
       "require": {
           "akrista/laravel-extra-boost": "^2.0@beta"
       }
   }
   ```
3. Run `composer update`
4. The package will automatically use the new Boost 2.x architecture

### Breaking Changes in 2.x

- Architecture migrated from CodeEnvironment to Agent system
- Updated contracts: SupportsGuidelines, SupportsMcp, SupportsSkills
- Namespace changed from `CodeEnvironment` to `Agents`
- Minimum PHP version increased to 8.2

## License

Laravel Extra Boost is open-sourced software licensed under the [MIT license](LICENSE).
