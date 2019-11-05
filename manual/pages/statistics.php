<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

use Sphp\Apps\Trackers\Controller;

//echo '<pre>';
$controller = Controller::instance();
//$controller->run();

echo "<h2>Totals</h2>";
$controller->viewData();

use Sphp\Network\Utils;

echo '<pre>';
//print_r(Sphp\Apps\Trackers\User::fromCookie());
//echo 'IP:' . gethostbyaddr(Utils::getClientIp()) . "\n";
//$result = dns_get_record('91-152-225-73.elisa-laajakaista.fi');
//print_r($result);
$fileCache = new \Doctrine\Common\Cache\FilesystemCache("./vendor/browscap/browscap-php/resources");
$cache = new \Roave\DoctrineSimpleCache\SimpleCacheAdapter($fileCache);

$logger = new \Monolog\Logger('name');
$bc = new \BrowscapPHP\Browscap($cache, $logger);
$current_browser = $bc->getBrowser('facebookexternalhit/1.1 (+http://www.facebook.com/externalhit_uatext.php)');
print_r($current_browser);
echo '</pre>';
//echo '<pre>';
//print_r($_COOKIE);
//echo '</pre>';
//$ip = gethostbyname('www.example.com');
//$out = "The following URLs are equivalent:<br />\n";
//$out .= 'http://www.example.com/, http://' . $ip . '/, and http://' . sprintf("%u", ip2long($ip)) . "/<br />\n";
//echo $out;
?>