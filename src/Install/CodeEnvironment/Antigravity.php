<?php

declare(strict_types=1);

namespace Akrista\LaravelExtraBoost\Install\CodeEnvironment;

use Akrista\LaravelExtraBoost\Contracts\HasCustomFrontmatter;
use Laravel\Boost\Contracts\Agent;
use Laravel\Boost\Contracts\McpClient;
use Laravel\Boost\Install\CodeEnvironment\CodeEnvironment;
use Laravel\Boost\Install\Enums\Platform;

final class Antigravity extends CodeEnvironment implements Agent, HasCustomFrontmatter, McpClient
{
    public bool $useAbsolutePathForMcp = true;

    public function name(): string
    {
        return 'antigravity';
    }

    public function displayName(): string
    {
        return 'Antigravity';
    }

    public function agentName(): string
    {
        return 'Gemini';
    }

    public function systemDetectionConfig(Platform $platform): array
    {
        return match ($platform) {
            Platform::Darwin => [
                'paths' => ['/Applications/Antigravity.app'],
            ],
            Platform::Linux => [
                'paths' => [
                    '/opt/antigravity',
                    '/usr/local/bin/antigravity',
                    '~/.local/bin/antigravity',
                ],
            ],
            Platform::Windows => [
                'paths' => [
                    '%ProgramFiles%\\Antigravity',
                    '%LOCALAPPDATA%\\Programs\\Antigravity',
                ],
            ],
        };
    }

    public function projectDetectionConfig(): array
    {
        return [
            'paths' => ['.agent'],
        ];
    }

    public function mcpConfigPath(): string
    {
        $home = getenv('HOME') ?: getenv('USERPROFILE');

        return $home . DIRECTORY_SEPARATOR . '.gemini' . DIRECTORY_SEPARATOR . 'antigravity' . DIRECTORY_SEPARATOR . 'mcp_config.json';
    }

    public function guidelinesPath(): string
    {
        return '.agent/rules/laravel-boost.md';
    }

    public function frontmatter(): bool
    {
        return true;
    }

    public function getFrontmatterContent(): string
    {
        return "---\ntrigger: always_on\nglob:\ndescription: Laravel Boost development guidelines for this project\n---\n";
    }
}
