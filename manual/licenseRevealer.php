<?php

namespace Sphp\Html\Foundation\F6\Containers\Modals;

use Sphp\Util\LocalFile as Filebject;
use Sphp\Util\Timer as Timer;

$fileObj = new Filebject("license.md");
$license = (new ModalReveal($fileObj->parseMarkdown(), "SPHP license"));
$license->addCssClass("license");
?>
Copyright &copy; 2007-<?php echo date("Y"); ?> Sami Holck. All rights reserved.
<?php $license->printHtml(); ?> ||
<b>Script executed in:</b>
<i><?php echo Timer::getEcecutionTime(3) ?> seconds</i>
<b>PHP Peak memory:</b>
<i><?php echo number_format(memory_get_usage(true) / 1048576, 2) . " MB\n" ?></i>
