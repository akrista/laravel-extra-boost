<?php

declare(strict_types=1);

namespace Akrista\LaravelExtraBoost\Console;

use Akrista\LaravelExtraBoost\Contracts\HasCustomFrontmatter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Laravel\Boost\Install\Agents\Agent;
use Laravel\Boost\Support\Config;

final class InstallCommand extends Command
{
    protected $signature = 'extra-boost:install {--ignore-guidelines : Skip installing AI guidelines} {--ignore-mcp : Skip installing MCP server configuration}';

    protected $description = 'Install Laravel Boost and fix frontmatter for Windsurf and Antigravity';

    public function handle(): int
    {
        $options = [];
        if ($this->option('ignore-guidelines')) {
            $options['--ignore-guidelines'] = true;
        }

        if ($this->option('ignore-mcp')) {
            $options['--ignore-mcp'] = true;
        }

        $exitCode = $this->call(\Laravel\Boost\Console\InstallCommand::class, $options);

        if ($exitCode === 0) {
            $this->fixFrontmatter();
        }

        return $exitCode;
    }

    private function fixFrontmatter(): void
    {
        $this->newLine();

        $config = new Config;
        $selectedAgents = $config->getAgents();

        $environments = ['windsurf', 'antigravity'];

        foreach ($environments as $envName) {
            if (! in_array($envName, $selectedAgents, true)) {
                continue;
            }

            $env = Agent::fromName($envName);
            if (! $env instanceof Agent) {
                continue;
            }

            if (! ($env instanceof HasCustomFrontmatter)) {
                continue;
            }

            $filePath = base_path($env->guidelinesPath());

            if (! File::exists($filePath)) {
                continue;
            }

            $content = File::get($filePath);
            $correctFrontmatter = $env->getFrontmatterContent();

            if (preg_match('/^---\s*\n.*?\n---\s*\n/s', $content, $matches)) {
                $existingFrontmatter = $matches[0];

                if ($existingFrontmatter === $correctFrontmatter) {
                    continue;
                }

                $newContent = preg_replace('/^---\s*\n.*?\n---\s*\n/s', $correctFrontmatter, $content, 1);
                File::put($filePath, $newContent);
            } else {
                File::put($filePath, $correctFrontmatter . $content);
            }
        }
    }
}
