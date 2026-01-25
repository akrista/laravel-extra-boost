<?php

declare(strict_types=1);

namespace Akrista\LaravelExtraBoost;

use Akrista\LaravelExtraBoost\Console\InstallCommand;
use Akrista\LaravelExtraBoost\Console\UpdateCommand;
use Akrista\LaravelExtraBoost\Install\Agents\Antigravity;
use Akrista\LaravelExtraBoost\Install\Agents\Windsurf;
use Illuminate\Support\ServiceProvider;
use Laravel\Boost\Boost;

final class ExtraBoostServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Boost::registerAgent('windsurf', Windsurf::class);
        Boost::registerAgent('antigravity', Antigravity::class);

        if ($this->app->runningInConsole()) {
            $this->commands([
                InstallCommand::class,
                UpdateCommand::class,
            ]);
        }
    }
}
