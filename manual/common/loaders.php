<?php

use Sphp\Manual\MVC\PageLoader;
use Sphp\MVC\Router;

$pageLoader = new PageLoader();
$router = (new Router())
        ->setDefaultRoute([$pageLoader, 'loadNotFound'])
        ->route('/', [$pageLoader, 'loadIndex'])
        ->route('/calendar/<*categories>', [$pageLoader, 'loadCalendar'])
        ->route('/vendor/<*vendor>', [$pageLoader, 'loadVendorReadmes'])
        ->route('/index.php', [$pageLoader, 'loadIndex'], 10)
        ->route('/<!category>', [$pageLoader, 'loadPage'], 9);
