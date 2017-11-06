<?php

namespace Sphp\Stdlib\Datastructures;

use Sphp\Html\Apps\Manual\Apis;
$sami = \Sphp\Manual\api();
$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

$core = $sami->namespaceLink(__NAMESPACE__, false);
\Sphp\Manual\parseDown(<<<MD
#Standard library components
$ns  

MD
);
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
The $core namespace includes different collection classes.
                
* $collectionInterface
* $stackInterface and  $queueInterface
  * $stack
  * $queue
MD
);

namespace Sphp\Stdlib\Reader;

$readerNs = $sami->namespaceLink(__NAMESPACE__, false);
$blockGrid->appendMd(
<<<MD
#####Readers:

$readerNs
MD
);

foreach($blockGrid as $block) {
  $block->addCssClass('callout');
}
echo $blockGrid;

$toolsLink = $sami->namespaceLink(__NAMESPACE__, false);
?>
<div class="intro">
  <div class="row expanded small-up-1 medium-up-2 large-up-3" data-equalizer data-equalize-on="medium" data-equalize-by-row="true" id="f-r-1">
    <div class="column">
      <div class="callout" data-equalizer-watch>
<?php


$core = $sami->namespaceLink(__NAMESPACE__, false);
\Sphp\Manual\parseDown(<<<MD
#####Readers:

$readerNs
MD
);
?>
      </div>
    </div>
    <div class="column">
      <div class="callout" data-equalizer-watch>
<?php

\Sphp\Manual\parseDown(<<<MD
#####Readers:

$readerNs
MD
);
?>
      </div>
    </div>
    <div class="column">
      <div class="callout" data-equalizer-watch>
<?php

namespace Sphp\Stdlib\Events;

$eventNs = $sami->namespaceLink(__NAMESPACE__, false);
\Sphp\Manual\parseDown(<<<MD
#####Events

$eventNs
MD
);
?>
      </div>
    </div>
    <div class="column">
      <div class="callout" data-equalizer-watch>
<?php

namespace Sphp\Stdlib\Observers;

$observersNs = $sami->namespaceLink(__NAMESPACE__, false);

\Sphp\Manual\parseDown(<<<MD
#####Observers:
$observersNs
MD
);
?>
      </div>
    </div>
    <div class="column">
      <div class="callout" data-equalizer-watch>
<?php

namespace Sphp\Html\Foundation\Sites\Forms;

$forms_ns = $sami->namespaceLink(__NAMESPACE__, false);

\Sphp\Manual\parseDown(<<<MD
#####Data Filters:

The $forms_ns namespace includes Foundation based forms layouts and client-side form components.
Visual presentation of Foundation based Forms are built with the Grid. These forms 
extend basic SPHP forms.
MD
);
?>
      </div>
    </div>
    <div class="column">
      <div class="callout" data-equalizer-watch>
<?php

namespace Sphp\Html\Foundation\Sites\Containers;

$cont_ns = $sami->namespaceLink(__NAMESPACE__, false);

\Sphp\Manual\parseDown(<<<MD
#####Data Validators:

The $cont_ns namespace includes PHP implementations of useful container elements like Accordions, Tabs and Dropdowns for HTML presentation.
MD
);
?></div>
    </div>
  </div>
</div>


<?php

namespace Sphp\Stdlib;

use Sphp\Html\Apps\Manual\Apis;

$ns = \Sphp\Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

\Sphp\Manual\parseDown(<<<MD
#Standard library components
$ns  
##Datastructures
##Extensions and utlilities for Standard PHP types
        

##Event and observer patterns
        
        
##Data filtering and validaton
        
        
##I18n localization
        
##Filesystem manipulation
        
##Database manipulation
MD
);

\Sphp\Manual\loadPage('Core-intro/Orbit-intro');
\Sphp\Manual\loadPage('Sphp.Core.Router');

