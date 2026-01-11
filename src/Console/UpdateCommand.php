<?php

declare(strict_types=1);

namespace Akrista\LaravelExtraBoost\Console;

use Akrista\LaravelExtraBoost\Contracts\HasCustomFrontmatter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Laravel\Boost\Install\CodeEnvironment\CodeEnvironment;
use Laravel\Boost\Support\Config;

final class UpdateCommand extends Command
{
    protected $signature = 'boost:update-extra';

    protected $description = 'Update Laravel Boost guidelines and fix frontmatter for Windsurf and Antigravity';

    public function handle(): int
    {
        $this->call(\Laravel\Boost\Console\UpdateCommand::class);

        $this->fixFrontmatter();

        return self::SUCCESS;
    }

    private function fixFrontmatter(): void
    {
        $this->newLine();

        $config = new Config();
        $selectedAgents = $config->getAgents();

        $environments = ['windsurf', 'antigravity'];

        foreach ($environments as $envName) {
            if (! in_array($envName, $selectedAgents, true)) {
                continue;
            }

            $env = CodeEnvironment::fromName($envName);
            if (!$env instanceof CodeEnvironment) {
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
