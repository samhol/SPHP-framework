<?php

namespace Sphp\Html\Foundation\Sites\Containers\Modals;

use Sphp\Stdlib\Timer;

$license = (new Modal(null, 'SPHP license'))->appendMdFile('LICENSE.md');
$license->addCssClass('license');
?>
Copyright &copy; 2007-<?php echo date('Y'); ?> Sami Holck. All rights reserved.
<?php $license->printHtml(); ?> ||
<b>Script executed in:</b>
<i><?php echo Timer::getEcecutionTime(3) ?> seconds</i>
<b>PHP Peak memory:</b>
<i><?php echo number_format(memory_get_usage(true) / 1048576, 2) . " MB\n" ?></i>
