<?php

namespace Sphp\Html\Apps\HyperlinkGenerators;

$sami = new Sami\Sami();
$sami->setDefaultAttributes(['class' => 'api sphp']);

echo '<h1>earggar</h1>';
echo $sami->namespaceBreadGrumbs(__NAMESPACE__);
echo '<p>';
echo $sami->functionLink('foo');
echo $sami->classLinker(Sami\Sami::class);
echo $sami->classLinker(Sami\Sami::class)->methodLink('classLinker');

$php = new PHPManual\PHPManual();
$php->setDefaultAttributes(['class' => 'api php']);
echo $php->functionLink('foo');
echo $php->classLinker(\Iterator::class);
echo $php->controlStructLink('foreach');

$w3s = new W3schools();
echo $w3s->a;

echo '</p>';
?>
