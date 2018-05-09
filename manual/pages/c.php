<?php

namespace Sphp\Html\Apps\HyperlinkGenerators;

$sami = new Sami\Sami();
$sami->setDefaultHyperlinkAttributes(['class' => 'api sphp']);

echo $sami->namespaceBreadGrumbs(__NAMESPACE__);
echo $sami->classLinker(Sami\Sami::class)->methodLink('classLinker');
echo $sami->classLinker(Sami\Sami::class);
$php = new PHPManual\PHPManual();
$php->setDefaultHyperlinkAttributes(['class' => 'api php']);
$htmlLinker = $sami->Sphp->Html;
$w3s = new W3schools();
\Sphp\Manual\md(<<<MD
<h1>earggar</h1>


 * {$sami->Sphp->Html->Content->getHtml}
 * {$htmlLinker->Div}
 * {$php->Iterator}
 * $php->Exception
 * $w3s->a


MD
);
?>
