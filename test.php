<?php

namespace Sphp\Html\Foundation\Sites\Navigation;

use Sphp\Core\Path;
use Sphp\Html\Document;

include_once('manual/settings.php');
include_once('manual/htmlHead.php');
?>
<body class="manual">
  <div class="row expanded small-collapse medium-uncollapse">
    <?php
    $linkData = \Sphp\Stdlib\Parser::fromFile(Path::get()->local('manual/yaml/documentation_links.yaml'));
    $mb = new MenuBuilder();
    echo $mb->buildMenu($linkData, new AccordionMenu());
    ?>
  </div>
    <?php

    use Sphp\Html\Apps\BackToTopButton;

(new BackToTopButton())
            ->setTitle('Back To Top')
            ->printHtml();
    $html->documentClose();




    
