<?php

namespace Sphp\Data\Sports;

//$rawData = Parser::csv()->arrayFromFile('manual/snippets/FitNotes.csv');
$exercises = FitNotes::fromCsv('manual/snippets/FitNotes.csv');
?>
<pre>
<?php
echo $exercises;
?>
</pre>
  <?php ?>

