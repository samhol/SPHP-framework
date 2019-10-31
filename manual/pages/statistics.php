<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//echo '<pre>';
$controller = new \Sphp\Apps\Trackers\Controller('localhost', 'int48291_statistics', 'nO,pAS[4=tVv', 'int48291_statistics');
//$controller->run();

echo "<h2>Totals</h2>";
$controller->vewData();

use Sphp\Network\Utils;

echo '<pre>';
echo 'IP:' . gethostbyaddr(Utils::getClientIp()) . "\n";
$result = dns_get_record('91-152-225-73.elisa-laajakaista.fi');
print_r($result);
echo '</pre>';
//echo '<pre>';
//print_r($_COOKIE);
//echo '</pre>';

$ip = gethostbyname('www.example.com');
$out = "The following URLs are equivalent:<br />\n";
$out .= 'http://www.example.com/, http://' . $ip . '/, and http://' . sprintf("%u", ip2long($ip)) . "/<br />\n";
echo $out;
?>