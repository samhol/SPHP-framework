<?php

namespace Sphp\Html\Head;

$metaData = [
    'name' => [
        'viewport' => 'width=device-width, initial-scale=1',
        'description' => 'SPHPlayground web framework',
        'author' => '',
        'keywords' => ['php', 'scss', 'css', 'html', 'html5', 'JavaScript'],
        'robots' => 'index, follow',
        'mobile-web-app-capable' => 'yes',
        'apple-mobile-web-app-capable' => 'yes',
    ],
    'http-equiv' => [
        'Expires' => '0',
        'Pragma' => 'no-cache',
        'Cache-Control' => 'no-cache',
        'imagetoolbar' => 'no',
        'x-dns-prefetch-control' => 'off',
        'apple-mobile-web-app-capable' => 'yes',],
];
echo MetaGroup::fromArray($metaData);
