<?php

declare(strict_types=1);

namespace Akrista\LaravelExtraBoost\Contracts;

interface HasCustomFrontmatter
{
    public function getFrontmatterContent(): string;
}
