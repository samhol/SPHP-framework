<div class="sphp-calendar month">
<div class="grid-x">
  <div class="cell small-1"><div class="head week">week</div></div>
  <div class="cell auto">
    <div class="head day">
      <span class="show-for-small-only">Mo</span>
      <span class="hide-for-small-only">Monday</span>
    </div>
  </div>
  <div class="cell auto">
    <div class="head day">
      <span class="show-for-small-only">Mo</span>
      <span class="hide-for-small-only">Monday</span>
    </div>
  </div>
  <div class="cell auto">
    <div class="head day">
      <span class="show-for-small-only">Mo</span>
      <span class="hide-for-small-only">Monday</span>
    </div>
  </div>
  <div class="cell auto">
    <div class="head day">
      <span class="show-for-small-only">Mo</span>
      <span class="hide-for-small-only">Monday</span>
    </div>
  </div>
  <div class="cell auto">
    <div class="head day">
      <span class="show-for-small-only">Mo</span>
      <span class="hide-for-small-only">Monday</span>
    </div>
  </div>
  <div class="cell auto">
    <div class="head day">
      <span class="show-for-small-only">Mo</span>
      <span class="hide-for-small-only">Monday</span>
    </div>
  </div>
  <div class="cell auto">
    <div class="head day">
      <span class="show-for-small-only">Mo</span>
      <span class="hide-for-small-only">Monday</span>
    </div>
  </div>
</div>
<div class="grid-x">
  <div class="cell small-1">
    <div class="head day">2.</div>
      
  </div>
  <div class="cell auto">
    <div class="body day">1.</div>
  </div>
  
  <div class="cell auto">
    <div class="body day">1.</div>
  </div>
  <div class="cell auto">
    <div class="body day">1.</div>
  </div>
  <div class="cell auto">
    <div class="body day">1.</div>
  </div>
  <div class="cell auto">
    <div class="body day">1.</div>
  </div>
  <div class="cell auto">
    <div class="body day">1.</div>
  </div>
  <div class="cell auto">
    <div class="body day">1.</div>
  </div>
</div>
</div>
<?php

use Sphp\Html\Apps\Calendars\WeekDayView;

$day = new WeekDayView(new DateTime('now'));
echo $day;
$m = new \Sphp\Html\Apps\Calendars\Month(2018, 4);
echo $m;
$wv = new \Sphp\Html\Apps\Calendars\WeekNumberView(new DateTime);
