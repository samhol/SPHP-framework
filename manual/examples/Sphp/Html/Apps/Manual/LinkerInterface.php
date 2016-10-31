<?php

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Lists\Ul;
use Doctrine\ORM\Decorator\EntityManagerDecorator;

$doctrine2 = Apis::apigen("http://apigen.juzna.cz/doc/doctrine/doctrine2.git/");
$entityManagerDecorator = $doctrine2->classLinker(EntityManagerDecorator::class);
$links = new Ul();
$links->appendMd("###Doctrine 2:");
$links[] = $entityManagerDecorator;
$links[] = $entityManagerDecorator->method("getCache", true);
$links[] = $entityManagerDecorator->method("getCache", false);

$sphpApi = Apis::apigen("http://documentation.samiholck.com/apigen/");

$dateTime = $sphpApi->classLinker(\Datetime::class);

$links->appendMd("###SPHP framework:");
$links[] = $dateTime;
$links[] = $dateTime->method("format");
$links[] = $dateTime->constant("ATOM");
$links[] = $sphpApi->constantLink("Sphp\Regex\FI\DATE");

$w3schoolsApi = Apis::w3schools();

$links->appendMd("###W3schools:");
$links[] = $w3schoolsApi->tag("html");
$links[] = $w3schoolsApi->attr("id");
$links[] = $w3schoolsApi->attr("style", "Global style attribute");
$links->printHtml();

$phpApi = Apis::phpManual();

$dateTime1 = $sphpApi->classLinker(\Datetime::class);

$links->appendMd("###PHP manual:");
$links[] = $phpApi->extensionLink("gettext");
$links[] = $phpApi->functionLink("date");
$links[] = $phpApi->constantLink("DATE_ATOM");
$links[] = $dateTime1;
$links[] = $dateTime1->method("format");
$links[] = $dateTime1->constant("ATOM");
$links->printHtml();
?>
