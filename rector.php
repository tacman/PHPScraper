<?php

declare(strict_types=1);

use Rector\CodeQuality\Rector\Class_\InlineConstructorDefaultToPropertyRector;
use Rector\Config\RectorConfig;
use Rector\Set\ValueObject\LevelSetList;
use Rector\Renaming\Rector\PropertyFetch\RenamePropertyRector;
use Rector\Renaming\ValueObject\RenameProperty;
return static function (RectorConfig $rectorConfig): void {
    $rectorConfig->paths([
        __DIR__ . '/tests/'
    ]);

    // register a single rule
    $rectorConfig->rule(InlineConstructorDefaultToPropertyRector::class);
    $rectorConfig->ruleWithConfiguration(
        RenamePropertyRector::class,
        array_map(
            fn($property) => new RenameProperty(\spekulatius\phpscraper::class, $property, "$property()"),
            [
                'links','author','twitterCard','paragraphs','cleanParagraphs','cleanOutlineWithParagraphs',
                'contentType','csrfToken','description','image','keywordString','keywords','viewportString','viewport',
                'openGraph','currentUrl','outline','outlineWithParagraphs'
            ])
        );

    // define sets of rules
    //    $rectorConfig->sets([
    //        LevelSetList::UP_TO_PHP_80
    //    ]);
};
