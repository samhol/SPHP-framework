<?php


$begin = new DateTime( '2012-08-01' );
$end = new DateTime( '2012-08-31' );
$end = $end->modify( '+1 day' ); 

$interval = new DateInterval('P7D');
$daterange = new DatePeriod($begin, $interval ,$end);

foreach($daterange as $date){
    echo $date->format("Y-m-d l") . "<br>";
}

$foo = new \Sphp\DateTime\Calendars\Diaries\Schedules\RepeatingTask1(new Sphp\DateTime\Period('R2/2008-03-01T13:00:00Z/P1Y2M10DT2H30M'), 'PT7H');

echo $foo;