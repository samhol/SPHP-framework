<pre>
<?php

use Sphp\DateTime\Interval;
//use DateInterval;
function f(DateInterval $input): Interval {
  //$output = 'P';
  $vars = get_object_vars($input);
  //var_dump($vars);
  $output = new Interval;
  foreach ($vars as $key => $value) {
    $output->$key = $value;
  }
  return $output;
}

$foo = f(new DateInterval('P2Y4DT6H8M'));

  var_dump($foo);
?>
</pre>
