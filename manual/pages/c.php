<?php

namespace Sphp\Html\Apps\HyperlinkGenerators;

$sami = new Sami\Sami();
$sami->setDefaultHyperlinkAttributes(['class' => 'api sphp']);

echo '<h1>earggar</h1>';
echo $sami->namespaceBreadGrumbs(__NAMESPACE__);
echo '<p>';
echo $sami->functionLink('foo');
echo $sami->classLinker(Sami\Sami::class);
echo $sami->classLinker(Sami\Sami::class)->methodLink('classLinker');

echo $sami->classLinker(Sami\Sami::class)->classLinker;
echo $sami->Sphp->Html->Content->getHtml;
$htmlLinker = $sami->Sphp->Html;
echo $htmlLinker->Div;
$php = new PHPManual\PHPManual();
$php->setDefaultHyperlinkAttributes(['class' => 'api php']);
echo $php->functionLink('foo');
echo $php->classLinker(\Iterator::class);
echo $php->controlStructLink('foreach');
echo $php->Exception;
$w3s = new W3schools();
echo $w3s->a;
echo '</p>';
?>
