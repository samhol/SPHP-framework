<?php

namespace Sphp\Data\Sports;

use Sphp\Stdlib\Parsers\Parser;

echo '<pre>';
//print_r(Parser::csv()->arrayFromFile('manual/snippets/FitNotes.csv'));
$rawData = Parser::csv()->arrayFromFile('manual/snippets/FitNotes.csv');
array_shift($rawData);
$exercises  = new ExerciseCollection();
foreach ($rawData as $fitnoteData) {
  $exercises->insert(Factory::fromFitnote($fitnoteData));
}
echo $exercises;
echo '</pre>';
