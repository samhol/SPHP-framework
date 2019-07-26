<?php

//declare(strict_types=1);
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../settings.php');

use Sphp\Manual\MVC\MembershipRequest\Controller;
use Sphp\Stdlib\Datastructures\DataObject;
use Sphp\Stdlib\Parsers\Parser;
use Sphp\Network\Headers\Headers;

$config = DataObject::fromArray(Parser::fromFile('config/private-data.yml'));

$controller = new Controller($config);
$controller->process();
$headers = new Headers;
$headers->appendLocation('http://playground.samiholck.com/contact#answer');
$headers->save();
