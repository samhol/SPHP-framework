<?php

namespace Sphp\Data\Sports;

use Sphp\Stdlib\Parsers\Parser;

echo '<pre>';
//print_r(Parser::csv()->arrayFromFile('manual/snippets/FitNotes.csv'));
$rawData = Parser::csv()->arrayFromFile('manual/snippets/FitNotes.csv');
//print_r($rawData);
array_shift($rawData);
$exercises = [];

$arrayFilter = new \Sphp\Filters\ArrayFilter();
$arrayFilter->setFilter(function($value) {
  return new \Sphp\DateTime\Date($value);
}, 0);
$arrayFilter->setFilter(new \Sphp\Filters\IntegerFilter(null, 0), 4);
$arrayFilter->setFilter('floatval', 3, 5);
$arrayFilter->rejectThese(null, '');
$arrayFilter->passUnchanged(1, 2);
foreach ($rawData as $d) {
  print_r($arrayFilter->filter($d));
  //print_r(Factory::fromFitnote($d));
 /* $ds = $d[0];
  $date = new \Sphp\DateTime\Date($d[0]);
  $exercise = $d[1];
  $ed = [];
  $category = $d[2];
  $type = '';
  if ($d[3] !== '' && $d[3] > 0) {
    $weight = (float) $d[3];
  } else {
    $weight = null;
  }
  if ($d[4] !== '' && $d[4] > 0) {
    $ed['reps'] = (int) $d[4];
    $type .= 'r';
  }
  if ($d[5] !== '' && $d[5] > 0) {
    $ed['dist'] = (float) $d[5];
    if ($d[6] !== '') {
      $ed['du'] = $d[6];
    } else {
      $ed['du'] = 'km';
    }
    $type .= 'd';
  }
  if ($d[7] !== '') {
    $ed['time'] = $d[7];
    $type .= 't';
  }
  $exercises[$ds][$exercise]['type'] = $type;
  $exercises[$ds][$exercise]['cat'] = $category;
  $exercises[$ds][$exercise]['sets'][] = $ed;

  //$exercises->insert(Factory::fromFitnote($fitnoteData));*/
}
foreach ($exercises as $date => $all) {

  foreach ($all as $name => $data) {
    if ($data['type'] === 'wr') {
      $wle = new WeightLifting($name, $data['cat']);
      foreach ($data['sets'] as $set) {
        // var_dump($set);
        $wle->addSet($set['weight'], $set['reps']);
      }
      $foo[] = $wle;
    }
  }
}
//print_r($exercises); 
$ed = new WorkoutDay(new \Sphp\DateTime\Date());
$ed->insert(new WeightLifting('Box Squat', 'legs'));
$exer = new WorkoutDiary();
$exer->setDay($ed);
$exer->getDay('2018-5-6')->insert(new WeightLifting('Box Squat', 'legs'));
$exer->getDay('2018-5-6')
        ->getExercise('Box Squat')
        ->addSet(20, 10)
        ->addSet(42.5, 10);
echo $exer;
echo '</pre>';
