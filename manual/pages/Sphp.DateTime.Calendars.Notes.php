<?php

namespace Sphp\DateTime\Calendars\Notes;

use Sphp\Manual;

$note = Manual\api()->classLinker(\Sphp\DateTime\Calendars\CalendarDateNote::class);
$namespaces = Manual\api()->namespaceBreadGrumbs(__NAMESPACE__);

Manual\md(<<<MD
##Calendar notes
$namespaces
$note 
        
	
MD
);

Manual\example("Sphp/DateTime/Calendars/Notes/NoteCollection.php", "text", false)
        ->setExamplePaneTitle("Note examples")
        ->setOutputSyntaxPaneTitle("Note example results")
        ->printHtml();
