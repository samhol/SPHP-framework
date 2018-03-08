<?php

namespace Sphp\Html\Head;

use Sphp\Html\Programming\Script;
use Sphp\Manual;

$headNS = Manual\api()->namespaceLink(__NAMESPACE__);
$metaIfLnk = Manual\api()->classLinker(HeadContent::class);
$head = Manual\api()->classLinker(Head::class);
$title = Manual\api()->classLinker(Title::class);
$metaInterface = Manual\api()->classLinker(MetaData::class);
$metaContainer = Manual\api()->classLinker(MetaContainer::class);
$meta = Manual\api()->classLinker(Meta::class);
$base = Manual\api()->classLinker(Base::class);
$link = Manual\api()->classLinker(Link::class);
$scriptInterface = Manual\api()->classLinker(Script::class);
$w3schools = Manual\w3schools();
$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
##META DATA OBJECTS: <small>$meta object implementing $metaInterface</small>

$meta class works also as a object factory for $metaInterface objects implementing different meta data properties.
All $metaInterface types can be stored into a $metaContainer container.
MD
);
Manual\visualize('Sphp/Html/Head/MetaInterface.php', 'html5', false);

$code1 = Manual\codeModal('YAML file', 'manual/snippets/meta-data.yaml', 'YAML Meta data example');
$tr1 = $code1->getTrigger()->addCssClass('button', 'alert', 'radius', 'small');

echo $code1;
Manual\visualize('Sphp/Html/Head/MetaGroup.php', 'html5', false);

