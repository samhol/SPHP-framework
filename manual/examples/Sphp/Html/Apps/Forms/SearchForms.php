<?php

namespace Sphp\Html\Apps\Forms;

$samiForm = new SamiApiSearchFormBuilder("http://playground.samiholck.com/API/sami/");
echo $samiForm;
$s360 = SiteSearch360Form::create("http://playground.samiholck.com");
echo $s360->setPlaceholder("Site Search 360");
$freefind = new FreefindSearchForm(['pid' => 'r', 'si' => '51613081', 'bcd' => '&#247;', 'n' => '0']);
echo $freefind->setPlaceholder("FreeFind");
