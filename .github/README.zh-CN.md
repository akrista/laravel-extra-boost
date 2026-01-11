# Laravel Extra Boost

<a href="https://packagist.org/packages/akrista/laravel-extra-boost"><img src="https://img.shields.io/packagist/dt/akrista/laravel-extra-boost" alt="总下载量"></a>
<a href="https://packagist.org/packages/akrista/laravel-extra-boost"><img src="https://img.shields.io/packagist/v/akrista/laravel-extra-boost" alt="最新稳定版本"></a>
<a href="https://packagist.org/packages/akrista/laravel-extra-boost"><img src="https://img.shields.io/packagist/l/akrista/laravel-extra-boost" alt="许可证"></a>

[English](README) | [繁體中文](README.zh-TW.md) | 简体中文 | [Español](README.es-VE.md)

## 简介

Laravel Extra Boost 是原始 [gonetone/laravel-boost-windsurf-extension](https://packagist.org/packages/gonetone/laravel-boost-windsurf-extension) 包的分支。它是 [Laravel Boost](https://github.com/laravel/boost) 的扩展包，为包括 [Windsurf](https://windsurf.com/) 和 [Antigravity](https://antigravity.dev/) 在内的额外 AI 驱动开发环境提供集成支持。该包通过添加对这些现代 AI 编程助手的支持来增强 Laravel Boost，并提供自定义命令来管理指南文件中的前置内容。

## 特性

- **Windsurf 集成**：完全支持 Windsurf 编辑器和 Windsurf JetBrains 插件
- **Antigravity 集成**：完全支持 Antigravity AI 开发环境
- **自定义前置内容管理**：自动修复支持环境的指南文件中的前置内容
- **MCP 服务器配置**：为支持的环境配置模型上下文协议（MCP）服务器
- **增强命令**：提供 `boost:install-extra` 和 `boost:update-extra` 命令

## 系统要求

- PHP 8.1 或更高版本
- Laravel 10.49.0、11.45.3 或 12.41.1 及更高版本
- Laravel Boost 1.4 或更高版本
- [Windsurf 编辑器](https://windsurf.com/editor) 或 [Windsurf JetBrains 插件](https://plugins.jetbrains.com/plugin/20540-windsurf-plugin-formerly-codeium-for-python-js-java-go--)（用于 Windsurf 支持）
- [Antigravity](https://antigravity.dev/)（用于 Antigravity 支持）

## 安装方法

### 步骤 1：安装包

通过 Composer 将包安装为开发依赖项：

```bash
composer require akrista/laravel-extra-boost --dev
```

### 步骤 2：安装 Laravel Boost

运行增强的安装命令来安装带有 Windsurf 和 Antigravity 支持的 Laravel Boost：

```bash
php artisan boost:install-extra
```

此命令将：
- 安装带有所有功能的 Laravel Boost
- 自动检测并配置支持的环境
- 修复 Windsurf 和 Antigravity 的指南文件中的前置内容

在安装过程中，系统将提示您选择环境。可用选项将包括：

- `windsurf` - 用于 Windsurf 编辑器和 Windsurf JetBrains 插件
- `antigravity` - 用于 Antigravity AI 开发环境

### 可选安装参数

您可以在安装过程中跳过特定功能：

```bash
# 跳过安装 AI 指南
php artisan boost:install-extra --ignore-guidelines

# 跳过安装 MCP 服务器配置
php artisan boost:install-extra --ignore-mcp

# 跳过两者
php artisan boost:install-extra --ignore-guidelines --ignore-mcp
```

## 使用方法

### 更新指南

要更新 Laravel Boost 指南并修复支持环境的前置内容：

```bash
php artisan boost:update-extra
```

### 在项目之间切换

由于 Windsurf 和 Antigravity 使用全局级别的 MCP 配置文件，在切换不同的 Laravel 项目时，您需要运行以下命令：

```bash
php artisan boost:install-extra --no-interaction
```

这确保 MCP 配置指向当前项目的正确路径。

## 配置

安装后，该包将自动：

1. 向 Laravel Boost 注册 Windsurf 和 Antigravity 环境
2. 为支持的环境配置 MCP 服务器
3. 创建或更新具有正确前置内容的指南文件：
   - `.windsurf/rules/laravel-boost.md` 用于 Windsurf
   - `.agent/rules/laravel-boost.md` 用于 Antigravity

## 许可证

Laravel Extra Boost 是采用 [MIT 许可证](LICENSE) 的开源软件。
