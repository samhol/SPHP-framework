<?php

use Sphp\Html\Foundation\Sites\Adapters\VisibilityToggleController;
use Sphp\Html\Foundation\Sites\Buttons\Button;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Tags;

$fa = new FontAwesome();
$fa->setSize('fa-5x');
$controller = Button::pushButton('Toggle icons')->setColor('alert')->addCssClass('rounded');
$toggleController = new VisibilityToggleController($controller);
$facebook = $fa->i('fab fa-facebook');
$toggleController->addToggler($k = Tags::span($facebook), 'hinge-in-from-top spin-out');
$github = $fa->i('fab fa-github');
$toggleController->addToggler($p = Tags::span($github), 'hinge-in-from-top spin-out');
$toggleController->printHtml();
$k->printHtml();
$p->printHtml();
