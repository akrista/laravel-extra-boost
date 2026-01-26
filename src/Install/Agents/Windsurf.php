<?php

declare(strict_types=1);

namespace Akrista\LaravelExtraBoost\Install\Agents;

use Akrista\LaravelExtraBoost\Contracts\HasCustomFrontmatter;
use Laravel\Boost\Contracts\SupportsGuidelines;
use Laravel\Boost\Contracts\SupportsMcp;
use Laravel\Boost\Contracts\SupportsSkills;
use Laravel\Boost\Install\Agents\Agent;
use Laravel\Boost\Install\Enums\Platform;

final class Windsurf extends Agent implements HasCustomFrontmatter, SupportsGuidelines, SupportsMcp, SupportsSkills
{
    public function useAbsolutePathForMcp(): bool
    {
        return true;
    }

    public function name(): string
    {
        return 'windsurf';
    }

    public function displayName(): string
    {
        return 'Windsurf';
    }

    public function agentName(): string
    {
        return 'Cascade';
    }

    public function systemDetectionConfig(Platform $platform): array
    {
        return match ($platform) {
            Platform::Darwin => [
                'paths' => [
                    '/Applications/Windsurf.app',
                    '/Applications/PhpStorm.app',
                ],
            ],
            Platform::Linux => [
                'paths' => [
                    '/opt/windsurf',
                    '/usr/local/bin/windsurf',
                    '~/.local/bin/windsurf',
                    '/opt/phpstorm',
                    '/opt/PhpStorm*',
                    '/usr/local/bin/phpstorm',
                    '~/.local/share/JetBrains/Toolbox/apps/PhpStorm/ch-*',
                ],
            ],
            Platform::Windows => [
                'paths' => [
                    '%ProgramFiles%\\Windsurf',
                    '%LOCALAPPDATA%\\Programs\\Windsurf',
                    '%ProgramFiles%\\JetBrains\\PhpStorm*',
                    '%LOCALAPPDATA%\\JetBrains\\Toolbox\\apps\\PhpStorm\\ch-*',
                    '%LOCALAPPDATA%\\Programs\\PhpStorm',
                ],
            ],
        };
    }

    public function projectDetectionConfig(): array
    {
        return [
            'paths' => ['.windsurf'],
            'files' => ['.windsurfrules'],
        ];
    }

    public function mcpConfigPath(): string
    {
        $home = getenv('HOME') ?: getenv('USERPROFILE');

        return $home . DIRECTORY_SEPARATOR . '.codeium' . DIRECTORY_SEPARATOR . 'windsurf' . DIRECTORY_SEPARATOR . 'mcp_config.json';
    }

    public function guidelinesPath(): string
    {
        return '.windsurf/rules/laravel-boost.md';
    }

    public function frontmatter(): bool
    {
        return true;
    }

    public function getFrontmatterContent(): string
    {
        return "---\ntrigger: always_on\nglob:\ndescription: Laravel Boost development guidelines for this project\n---\n";
    }

    public function skillsPath(): string
    {
        return '.windsurf/skills';
    }

    public function installMcp(string $key, string $command, array $args = [], array $env = []): bool
    {
        $home = getenv('HOME') ?: getenv('USERPROFILE');

        $mcpPaths = [
            $home . DIRECTORY_SEPARATOR . '.codeium' . DIRECTORY_SEPARATOR . 'windsurf' . DIRECTORY_SEPARATOR . 'mcp_config.json',
            $home . DIRECTORY_SEPARATOR . '.codeium' . DIRECTORY_SEPARATOR . 'mcp_config.json',
        ];

        $installed = false;

        foreach ($mcpPaths as $path) {
            $dir = dirname($path);

            if (! file_exists($dir)) {
                continue;
            }

            if (! file_exists($path)) {
                file_put_contents($path, json_encode(['mcpServers' => []], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
            }

            $config = json_decode(file_get_contents($path), true);

            if (! isset($config['mcpServers'])) {
                $config['mcpServers'] = [];
            }

            $config['mcpServers'][$key] = [
                'command' => $command,
                'args' => $args,
            ];

            file_put_contents($path, json_encode($config, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));

            $installed = true;
        }

        return $installed;
    }
}
