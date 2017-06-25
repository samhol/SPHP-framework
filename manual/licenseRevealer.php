<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Stdlib\StopWatch;

$license = (new Modal('SPHP license'));
$license->getTrigger()->addCssClass('license');
$license->setSize('large')->getPopup()->appendMdFile('LICENSE.md')->addCssClass('license');
?>
Copyright &copy; 2007-<?php echo date('Y'); ?> Sami Holck. All rights reserved.
<?php $license->printHtml(); ?> ||
<b>Script executed in:</b>
<i><?php echo StopWatch::getEcecutionTime() ?> seconds</i>
<b>PHP Peak memory:</b>
<i><?php echo number_format(memory_get_usage(true) / 1048576, 2) . " MB\n" ?></i>
