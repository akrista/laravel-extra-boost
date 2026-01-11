<?php

declare(strict_types=1);

use Rector\Caching\ValueObject\Storage\FileCacheStorage;
use Rector\Config\RectorConfig;
use Rector\Php83\Rector\ClassMethod\AddOverrideAttributeToOverriddenMethodsRector;
use Rector\ValueObject\PhpVersion;

return RectorConfig::configure()
    ->withPhpVersion(PhpVersion::PHP_85)
    ->withSkip([
        AddOverrideAttributeToOverriddenMethodsRector::class,
        __DIR__ . '/vendor/*',
    ])
    ->withCache(
        cacheDirectory: '/tmp/rector',
        cacheClass: FileCacheStorage::class,
    )
    ->withPaths([
        __DIR__ . '/src',
    ])
    ->withPreparedSets(
        deadCode: true,
        codeQuality: true,
        codingStyle: true,
        typeDeclarations: true,
        privatization: true,
        earlyReturn: true,
    )
    ->withParallel(timeoutSeconds: 60)
    ->withPhpSets()
    // Additional PHP level sets for modernization
    ->withSets([
        Rector\Set\ValueObject\LevelSetList::UP_TO_PHP_81,
        Rector\Set\ValueObject\SetList::CODE_QUALITY,
        Rector\Set\ValueObject\SetList::DEAD_CODE,
        Rector\Set\ValueObject\SetList::CODING_STYLE,
        Rector\Set\ValueObject\SetList::TYPE_DECLARATION,
        Rector\Set\ValueObject\SetList::PRIVATIZATION,
        Rector\Set\ValueObject\SetList::EARLY_RETURN,
    ]);
