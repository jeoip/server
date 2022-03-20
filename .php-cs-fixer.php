<?php

$finder = PhpCsFixer\Finder::create()
    ->in([
        __DIR__ . "/bootstrap",
        __DIR__ . "/public",
        __DIR__ . "/routes",
        __DIR__ . "/src",
        __DIR__ . "/tests",
    ]);

$config = new PhpCsFixer\Config();
return $config->setRules([
        '@Symfony' => true,
    ])
    ->setFinder($finder)
;