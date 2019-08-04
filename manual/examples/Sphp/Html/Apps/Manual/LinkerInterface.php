<?php

namespace Sphp\Html\Apps\HyperlinkGenerators;

use Sphp\Html\Lists\Ul;
use Doctrine\ORM\Decorator\EntityManagerDecorator;

$links = new Ul();

$wordPress = Factory::apigen('http://apigen.juzna.cz/doc/WordPress/WordPress/');

$links[] = $wordPress->functionLink('__return_empty_array');
$links[] = $wordPress->functionLink('_wp_footer_scripts');

$doctrine2 = Factory::apigen('http://www.doctrine-project.org/api/orm/2.4/');
$entityManagerDecorator = $doctrine2->classLinker(EntityManagerDecorator::class);

$links->appendMd('###Doctrine 2:');
$links[] = $entityManagerDecorator;
$links[] = $entityManagerDecorator->methodLink('getCache', true);
$links[] = $entityManagerDecorator->methodLink('getCache', false);

$sphpApi = Factory::sami('http://playground.samiholck.com/API/sami');

use Sphp\Html\SphpDocument;

$document = $sphpApi->classLinker(SphpDocument::class);

$links->appendMd('###SPHP framework:');
$links[] = $document;
$links[] = $document->methodLink('__construct');
$links[] = $document->constantLink('__destruct');
$links[] = $document->classBreadGrumbs();
$links[] = $sphpApi->constantLink('Sphp\Regex\FI\DATE', 'constant Sphp\Regex\FI\DATE');
$links[] = $sphpApi->namespaceLink(__NAMESPACE__, true);
$links[] = $sphpApi->namespaceBreadGrumbs(__NAMESPACE__);

$w3schoolsApi = Factory::w3schools();

$links->appendMd("###W3schools:");
$links[] = $w3schoolsApi->tag("html");
$links[] = $w3schoolsApi->attr("id");
$links[] = $w3schoolsApi->attr('style', 'Global style attribute');

$phpApi = Factory::phpManual();

$dateTime1 = $phpApi->classLinker(\Datetime::class);

$links->appendMd('###PHP manual:');
$links[] = $phpApi->extensionLink("gettext");
$links[] = $phpApi->functionLink('date');
$links[] = $phpApi->constantLink('E_WARNING');
$links[] = $dateTime1;
$links[] = $dateTime1->methodLink('format');
$links[] = $dateTime1->constantLink('ATOM');
$links->printHtml();
