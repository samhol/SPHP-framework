<?php
/*
echo '<pre>';
$date = new Sphp\DateTime\DateTime('2018-05-09 07:00:00 EET');


$db1 = new PDO('mysql:host=Localhost;dbname=int48291_calendar;charset=utf8mb4', 'int48291_calendar', '=IkG?q#kayn=', array(PDO::ATTR_EMULATE_PREPARES => false,
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
$values = [];
while ($date->compareTo('2018-08-09') < 0) {
  $date = $date->jumpDays(1);
  if ($date->getWeekDay() < 6) {
    $values[] = [
        'description' => 'Work',
        'starts' => $date->format('Y-m-d H:i:s'),
        'stops' => $date->add('PT8H30M')->format('Y-m-d H:i:s')];
  }
}
$sql = new Sphp\Database\MySQL\Insert($db1);
$sql->into('tasks')->columnNames('description', 'starts', 'stops');
$sql->valuesFromArray($values);
$sql->execute();
echo '</pre>';
*/
