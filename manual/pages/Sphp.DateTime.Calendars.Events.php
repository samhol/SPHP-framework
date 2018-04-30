<?php

namespace Sphp\DateTime\Calendars\Events\Constraints;

use Sphp\DateTime\Calendars\Events\Event;
use Sphp\Manual;

$constraint = Manual\api()->classLinker(Constraint::class);
$event = Manual\api()->classLinker(Event::class);
$namespaces = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
##Calendar Events
$namespaces
$constraint defines date constraints for $event calendar events.

MD
);

Manual\example("Sphp/DateTime/Calendars/Events/EventCollection.php", "text", false)
        ->setExamplePaneTitle("Note examples")
        ->setOutputSyntaxPaneTitle("Note example results")
        ->printHtml();

Manual\example("Sphp/DateTime/Calendars/Events/Fi/HolidayCollection.php", "text", false)
        ->setExamplePaneTitle("Finnish holidays example")
        ->setOutputSyntaxPaneTitle("Finnish holidays example results")
        ->printHtml();

Manual\loadPage('Sphp.DateTime.Calendars.Events.Constraints');
