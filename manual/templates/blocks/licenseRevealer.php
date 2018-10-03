<?php

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Stdlib\StopWatch;
?>
Copyright &copy; 2007-<?php echo date('Y'); ?> Sami Holck. All rights reserved.
<a href="license.php" target="license">GNU license</a> ||
<b>Script executed in:</b>
<i><?php echo StopWatch::getExecutionTime(2) ?> seconds</i>
<b>PHP Peak memory:</b>
<i><?php echo number_format(memory_get_usage(true) / 1048576, 2) . " MB\n" ?></i>
