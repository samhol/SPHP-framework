<?php

declare(strict_types=1);

use Sphp\Manual\MVC\MembershipRequest\Controller;
use Sphp\Stdlib\Datastructures\DataObject;
use Sphp\Stdlib\Parsers\Parser;
use Sphp\Html\Flow\Section;

$section = new Section();
$section->addCssClass('form-container');
$section->appendH3('Jäsenhakemuslomake');
$config = DataObject::fromArray(Parser::fromFile('./manual/form/config/private-data.yml'));
$controller = new Controller($config);
$section->append($controller->doView());
echo $section;
