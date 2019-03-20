<?php

$path = 'manual/pages/intros/Network/tabs/';

use Sphp\Html\Foundation\Sites\Containers\Tabs\Tabs;
use Sphp\Html\Foundation\Sites\Containers\Tabs\SyntaxHighlightingTab;

$tabs = new Tabs();
//$tabs->matchHeight(true);
$sessionTab = new SyntaxHighlightingTab('Sesions');
$sessionTab->loadFromFile("$path/session.php");
$tabs->append($sessionTab);
$headerTab = new SyntaxHighlightingTab('Headers');
$headerTab->loadFromFile("$path/headers.php");
$tabs->append($headerTab);

$cookiesTab = new SyntaxHighlightingTab('Cookies');
$cookiesTab->loadFromFile("$path/cookies.php");
$tabs->append($cookiesTab);

$tabs->setActive(0);
echo $tabs;
