<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//echo '<pre>';
$controller = new \Sphp\Apps\Trackers\Controller('localhost','int48291_statistics', 'nO,pAS[4=tVv', 'int48291_statistics');
//$controller->run();

echo "<h2>Totals</h2>";
$controller->ViewData();
//echo '<pre>';
//print_r($_COOKIE);
//echo '</pre>';
