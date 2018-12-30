<?php

namespace Sphp\DateTime;

$task = Calendars\Diaries\Schedules\RepeatingTask::from('12:00', '13:00');
$task->setDescription('Foo is happening');

echo $task;
