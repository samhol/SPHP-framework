<?php

namespace Sphp\Images;

include '../settings.php'; //setting up the framework ...etc.

$scale = filter_input(INPUT_GET, 'scale', FILTER_VALIDATE_FLOAT, [
    'options' => [
        'default' => 1,
        'min_range' => 0.1,
        'max_range' => 2
        ]]);

echo ImagineImage::create(__DIR__ . '/example.jpg')->scale($scale);
