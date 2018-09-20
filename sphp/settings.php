<?php

/**
 * This file holds the common settings to the PHP project
 */

namespace Sphp\Html\Media;

use Sphp\Config\PHP;

require_once(__DIR__ . '/../vendor/autoload.php');
PHP::config()
        ->insertIncludePaths(__DIR__);

const VIEWER_JS_PATH = '';

