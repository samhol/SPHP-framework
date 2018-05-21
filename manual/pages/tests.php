<?php

namespace Sphp\Data\Sports;

use Sphp\Stdlib\Parsers\Parser;

$rawData = Parser::csv()->arrayFromFile('manual/snippets/FitNotes.csv');
?>
<pre>
  <?php
//print_r($rawData);
  array_shift($rawData);
  $exercises = [];
  $objs = [];
  $coll = new ExerciseDayCollection();
  foreach ($rawData as $exersice) {
    //print_r($arrayFilter->filter($d));
    //print_r(Factory::fromFitnote($d));
    $ds = $exersice[0];
    if (!array_key_exists($ds, $objs)) {
      $obj = new ExerciseDay(new \Sphp\DateTime\Date($exersice[0]));
      $objs[$ds] = $obj;
      $coll->setDay($obj);
    } else {
      $obj = $objs[$ds];
    }
    // $date = new \Sphp\DateTime\Date($exersice[0]);

    $name = $exersice[1];
    $category = $exersice[2];
    if ($exersice[3] > 0 && $exersice[4] > 0) {
      $ex = $obj->weightLifting($name, $category);
      $ex->addSet((float) $exersice[3], (int) $exersice[4]);
      /* $exercises[$ds][$name]['sets'][] = [
        'reps' => (int) $exersice[4],
        'weight' => (float) $exersice[3]
        ]; */
    }
    // $ed = [];
    // $type = '';
    //$exercises[$ds][$name]['type'] = $type;
    //$exercises[$ds][$name]['cat'] = $category;
    else if ($exersice[5] > 0 && !empty($exersice[7])) {
      $ex = $obj->distanceAndTime($name, $category);
      $ed['dist'] = (float) $exersice[5];
      if ($exersice[6] !== '') {
        $unit = $exersice[6];
      } else {
        $unit = 'km';
      }
      // $type .= 'd';
      $ex->addSet((float) $exersice[5], $unit, $exersice[7]);
    } else if ($exersice[7] !== '') {
      $ed['time'] = $exersice[7];
      $rawTime = $exersice[7];
      echo \Sphp\DateTime\Factory::timeDiff($rawTime)->format('%h :%m; %s');
      $parts = explode(':', $rawTime);
      $dateint = 'PT' . $parts[0] . 'H' . $parts[1] . 'M' . $parts[2] . "S";
      echo "$dateint\n";

      $interval = new \DateInterval($dateint);
      echo $interval->format('%h hours');
      print_r($parts);
      // $type .= 't';
    }
    //$exercises[$ds][$exercise]['sets'][] = $ed;
    //$exercises->insert(Factory::fromFitnote($fitnoteData));
  }
  //echo $coll;
  //echo implode("\n",$objs);
  $i = \DateInterval::createFromDateString('P1:03:22');
  print_r($i);
  ?>
</pre>
<?php ?>

