<?php

namespace Sphp\DateTime\Calendars\Events\Constraints;

use Sphp\DateTime\Calendars\Events\Event;
use Sphp\Manual;

$constraint = Manual\api()->classLinker(Constraint::class);
$event = Manual\api()->classLinker(Event::class);

Manual\md(<<<MD
###Date Constraints <small>for Calendar events</small>

$constraint interface defines date constraints for calendar events implementing $event.
        
	
MD
);

Manual\example("Sphp/DateTime/Calendars/Events/Constraints/Constraints.php", "text", false)
        ->setExamplePaneTitle("Note examples")
        ->setOutputSyntaxPaneTitle("Note example results")
        ->printHtml();
