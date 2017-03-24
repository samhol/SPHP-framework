<?php

namespace Sphp\Html\Apps\Calendars;

echo"<pre>";
//var_dump($_SERVER);

//print_r(Configuration::useDomain("manual")->localPaths()->toArray());
//print_r(Configuration::useDomain("manual")->httpPaths()->toArray());

echo"</pre>";

echo new WeekView();


echo new WeekView(new \DateTimeImmutable('next tuesday'));


echo new MonthView();


echo new MonthView(2001, 12);