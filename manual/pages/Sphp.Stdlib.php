<?php

namespace Sphp\Stdlib;

use Sphp\Manual;

$ns = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

\Sphp\Manual\md(<<<MD
#Standard library
$ns  
Standard library contains a set of components for different general purpose scopes.
MD
);

use Sphp\Html\Foundation\Sites\Grids\BlockGrid;

$blocks = new BlockGrid('small-up-1', 'large-up-2', 'xlarge-up-3');

//$blocks->appendPhpFile('Stdlib.Events-Observers.php');
//$blocks->appendPhpFile('Stdlib.Filesystem.php');
//$blocks->appendPhpFile('Stdlib.Datastructures.php');
echo $blocks;

namespace Sphp\Stdlib\Datastructures;

$sami = \Sphp\Manual\api();
$collectionInterface = $sami->classLinker(CollectionInterface::class);
$stackInterface = $sami->classLinker(StackInterface::class);
$queueInterface = $sami->classLinker(QueueInterface::class);
$stack = $sami->classLinker(Stack::class);
$queue = $sami->classLinker(Queue::class);
$blockGrid = new \Sphp\Html\Foundation\Sites\Grids\BlockGrid(['small-up-1', 'medium-up-2', 'large-up-3']);
$blockGrid->addCssClass('expanded');

$blockGrid->appendMd(
        <<<MD
#####Datastructures:
The  namespace includes different collection classes.
                
* $collectionInterface
* $stackInterface and  $queueInterface
  * $stack
  * $queue
MD
);

echo $blocks;
