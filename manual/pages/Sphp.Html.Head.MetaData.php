<?php

namespace Sphp\Html\Head;

use Sphp\Html\Programming\Script;
use Sphp\Manual;

$headNS = Manual\api()->namespaceLink(__NAMESPACE__);
$metaIfLnk = Manual\api()->classLinker(HeadContent::class);
$head = Manual\api()->classLinker(Head::class);
$title = Manual\api()->classLinker(Title::class);
$metaInterface = Manual\api()->classLinker(MetaData::class);
$meta = Manual\api()->classLinker(MetaTag::class);
$base = Manual\api()->classLinker(Base::class);
$link = Manual\api()->classLinker(LinkTag::class);
$scriptInterface = Manual\api()->classLinker(Script::class);
$w3schools = Manual\w3schools();
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
##META DATA: <small>information about the HTML document</small>

$meta class works also as a object factory for $metaInterface objects implementing 
  different meta data properties.
MD
);
Manual\visualize('Sphp/Html/Head/MetaInterface.php', 'html5', false);

$code1 = Manual\codeModal('YAML file', 'Sphp/Html/Head/meta.yaml', 'YAML Meta data example');
$tr1 = $code1->getTrigger()->addCssClass('button', 'alert', 'radius', 'small', 'hide-from-pdf');
$code1->getPopup()->addCssClass('hide-from-pdf');
echo $code1;
$phpArr = \Sphp\Stdlib\Filesystem::executePhpToString('Sphp/Html/Head/meta-array.php');
$code2 = Manual\codeModalFromString('PHP array', $phpArr, 'php', 'PHP Meta data example');
$tr2 = $code2->getTrigger()->addCssClass('button', 'secondary', 'radius', 'small', 'hide-from-pdf');

echo $code2;

Manual\visualize('Sphp/Html/Head/MetaGroup.php', 'html5', false);

