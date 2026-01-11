# Laravel Extra Boost

<a href="https://packagist.org/packages/akrista/laravel-extra-boost"><img src="https://img.shields.io/packagist/dt/akrista/laravel-extra-boost" alt="總下載次數"></a>
<a href="https://packagist.org/packages/akrista/laravel-extra-boost"><img src="https://img.shields.io/packagist/v/akrista/laravel-extra-boost" alt="最新穩定版本"></a>
<a href="https://packagist.org/packages/akrista/laravel-extra-boost"><img src="https://img.shields.io/packagist/l/akrista/laravel-extra-boost" alt="授權條款"></a>

[English](README.md) | [Español](README.es-VE.md) | [简体中文](README.zh-CN.md) | 繁體中文

## 簡介

Laravel Extra Boost 是原始 [gonetone/laravel-boost-windsurf-extension](https://packagist.org/packages/gonetone/laravel-boost-windsurf-extension) 套件的分支。它是 [Laravel Boost](https://github.com/laravel/boost) 的擴充套件，為包括 [Windsurf](https://windsurf.com/) 和 [Antigravity](https://antigravity.dev/) 在內的額外 AI 驅動開發環境提供整合支援。此套件透過新增對這些現代 AI 程式設計助手的支援來增強 Laravel Boost，並提供自訂指令來管理指南檔案中的前置內容。

### 關於此實作

此套件遵循我的個人工作流程方法。不使用 `.windsurfrules` 檔案，而是使用 `.windsurf/rules/laravel-boost.md` 目錄結構。同樣地，不是為 Windsurf 和 Windsurf JetBrains 外掛程式提供單獨的選項，而是在建立 Windsurf MCP 設定時，同時在 `.codeium` 和 `.codeium/windsurf` 目錄中建立，以確保與兩種設定的相容性。

## 特性

- **Windsurf 整合**：完全支援 Windsurf 編輯器和 Windsurf JetBrains 外掛程式
- **Antigravity 整合**：完全支援 Antigravity AI 開發環境
- **自訂前置內容管理**：自動修復支援環境的指南檔案中的前置內容
- **MCP 伺服器設定**：為支援的環境設定模型上下文協定（MCP）伺服器
- **增強指令**：提供 `boost:install-extra` 和 `boost:update-extra` 指令

## 系統需求

- PHP 8.1 或更高版本
- Laravel 10.49.0、11.45.3 或 12.41.1 及更高版本
- Laravel Boost 1.4 或更高版本
- [Windsurf 編輯器](https://windsurf.com/editor) 或 [Windsurf JetBrains 外掛程式](https://plugins.jetbrains.com/plugin/20540-windsurf-plugin-formerly-codeium-for-python-js-java-go--)（用於 Windsurf 支援）
- [Antigravity](https://antigravity.dev/)（用於 Antigravity 支援）

## 安裝方式

### 步驟 1：安裝套件

透過 Composer 將套件安裝為開發依賴項目：

```bash
composer require akrista/laravel-extra-boost --dev
```

### 步驟 2：安裝 Laravel Boost

執行增強的安裝指令來安裝带有 Windsurf 和 Antigravity 支援的 Laravel Boost：

```bash
php artisan boost:install-extra
```

此指令將：
- 安裝带有所有功能的 Laravel Boost
- 自動偵測並設定支援的環境
- 修復 Windsurf 和 Antigravity 的指南檔案中的前置內容

在安裝過程中，系統將提示您選擇環境。可用選項將包括：

- `windsurf` - 用於 Windsurf 編輯器和 Windsurf JetBrains 外掛程式
- `antigravity` - 用於 Antigravity AI 開發環境

### 可選安裝參數

您可以在安裝過程中跳過特定功能：

```bash
# 跳過安裝 AI 指南
php artisan boost:install-extra --ignore-guidelines

# 跳過安裝 MCP 伺服器設定
php artisan boost:install-extra --ignore-mcp

# 跳過兩者
php artisan boost:install-extra --ignore-guidelines --ignore-mcp
```

## 使用方法

### 更新指南

要更新 Laravel Boost 指南並修復支援環境的前置內容：

```bash
php artisan boost:update-extra
```

### 在專案之間切換

由於 Windsurf 和 Antigravity 使用全域層級的 MCP 設定檔，在切換不同的 Laravel 專案時，您需要執行以下指令：

```bash
php artisan boost:install-extra --no-interaction
```

這確保 MCP 設定指向目前專案的正確路徑。

## 設定

安裝後，此套件將自動：

1. 向 Laravel Boost 註冊 Windsurf 和 Antigravity 環境
2. 為支援的環境設定 MCP 伺服器
3. 建立或更新具有正確前置內容的指南檔案：
   - `.windsurf/rules/laravel-boost.md` 用於 Windsurf
   - `.agent/rules/laravel-boost.md` 用於 Antigravity

## 授權條款

Laravel Extra Boost 是採用 [MIT 授權條款](LICENSE) 的開源軟體。
