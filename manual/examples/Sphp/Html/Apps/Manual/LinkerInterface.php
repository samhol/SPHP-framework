<?php

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Lists\Ul;
use Doctrine\ORM\Decorator\EntityManagerDecorator;

$doctrine2 = Apis::apigen('http://www.doctrine-project.org/api/orm/2.4/');
$entityManagerDecorator = $doctrine2->classLinker(EntityManagerDecorator::class);
$links = new Ul();
$links->appendMd('###Doctrine 2:');
$links[] = $entityManagerDecorator;
$links[] = $entityManagerDecorator->method('getCache', true);
$links[] = $entityManagerDecorator->method('getCache', false);

$sphpApi = Apis::apigen('http://documentation.samiholck.com/apigen/');

$dateTime = $sphpApi->classLinker(\Datetime::class);

$links->appendMd('###SPHP framework:');
$links[] = $dateTime;
$links[] = $dateTime->method('format');
$links[] = $dateTime->constant('ATOM');
$links[] = $dateTime->classBreadGrumbs();
$links[] = $sphpApi->constantLink('Sphp\Regex\FI\DATE', 'constant Sphp\Regex\FI\DATE');
$links[] = $sphpApi->namespaceBreadGrumbs(__NAMESPACE__);

$w3schoolsApi = Apis::w3schools();

$links->appendMd("###W3schools:");
$links[] = $w3schoolsApi->tag("html");
$links[] = $w3schoolsApi->attr("id");
$links[] = $w3schoolsApi->attr('style', 'Global style attribute');

$phpApi = Apis::phpManual();

$dateTime1 = $phpApi->classLinker(\Datetime::class);

$links->appendMd('###PHP manual:');
$links[] = $phpApi->extensionLink("gettext");
$links[] = $phpApi->functionLink('date');
$links[] = $phpApi->constantLink('E_WARNING');
$links[] = $dateTime1;
$links[] = $dateTime1->method('format');
$links[] = $dateTime1->constant('ATOM');
$links->printHtml();
?>
