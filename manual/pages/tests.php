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

?>
<ul class="tabs" data-tabs id="example-tabs">
  <li class="tabs-title"><a href="#panel1">Tab 1</a></li>
  <li class="tabs-title"><a href="#panel2">Tab 2</a></li>
</ul>
<div class="tabs-content" data-tabs-content="example-tabs">
  <div class="tabs-panel" id="panel1">
    <p>Vivamus hendrerit arcu sed erat molestie vehicula. Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor. Suspendisse dictum feugiat nisl ut dapibus.</p>
  </div>
  <div class="tabs-panel" id="panel2">
    <p>Suspendisse dictum feugiat nisl ut dapibus.  Vivamus hendrerit arcu sed erat molestie vehicula. Ut in nulla enim. Phasellus molestie magna non est bibendum non venenatis nisl tempor.  Sed auctor neque eu tellus rhoncus ut eleifend nibh porttitor.</p>
  </div>
</div>
<ul id="id_ff7a8b2fa0ff25d0" data-tabs class="tabs">
  <li class="tabs-title"><a href="#id_89c0140d294641ea">1st. tab</a></li>
  <li class="tabs-title"><a href="#id_7b21dc642ae0f729">2nd. Tab</a></li>
  <li class="tabs-title"><a href="#id_379068c12d3603c7">3rd. Tab</a></li>
  <li class="tabs-title" role="presentation"><a href="#id_bec991c905aee991">4th. Tab</a></li>
</ul>
<div data-tabs-content="id_ff7a8b2fa0ff25d0" data-match-height="true" class="tabs-content">
  <div id="id_89c0140d294641ea" class="tabs-panel"><h2>Lorem ipsum</h2>
<p>Lorem ipsum dolor sit amet, consetetur <strong>sadipscing</strong> elitr,<br>
sed diam nonumy eirmod tempor invidunt ut labore et dolore
magna aliquyam erat, sed diam voluptua. At vero eos et
accusam et justo duo dolores et ea rebum. Stet clita kasd
gubergren, no sea takimata sanctus est Lorem ipsum dolor
sit amet. </p>
<p>Lorem ipsum dolor sit amet, consetetur sadipscing
elitr,  sed <code>diam</code> nonumy eirmod tempor invidunt ut labore et
dolore magna aliquyam erat, sed diam voluptua. At vero eos et
accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
no sea takimata sanctus est Lorem ipsum dolor sit amet. </p>
<h3>Lorem ipsum consetetur sadipscing elitr</h3>
<p>Sed diam nonumy eirmod
tempor invidunt ut labore et dolore <strong>magna aliquyam erat</strong>, sed diam voluptua.
At vero eos et accusam et justo <code>duo dolores</code> et ea rebum. Stet clita kasd
gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.</p></div>
<div id="id_7b21dc642ae0f729" class="tabs-panel">The content of the second tab</div>
<div id="id_379068c12d3603c7" class="tabs-panel">
  <h3 id="lorem_h">Lorem ipsum</h3>

<p id="par_1" style="color: #555">Lorem ipsum dolor sit amet, consectetur 
adipiscing elit. Donec pretium ipsum non viverra dictum. Etiam scelerisque 
gravida ullamcorper. Aenean rhoncus a sem in vehicula.</p>

<p id="par_2" style="color: #090">enean elit sem, lacinia non dapibus quis, 
commodo vel enim. Pellentesque nec interdum dolor. Vestibulum varius suscipit 
diam eu feugiat. Nam rhoncus nunc in felis egestas elementum.</p>

<p id="par_3" style="color: #8c1111">Mauris pellentesque, elit et pulvinar ornare, 
dui lacus ullamcorper urna, tincidunt dictum risus tellus non nisi..</p>

<p id="par_4" style="color: #0bd">Donec tincidunt convallis libero nec 
sollicitudin. Integer sem nulla, pulvinar laoreet rutrum sit amet, suscipit eget 
sem. Cras ex orci, fringilla a accumsan at, malesuada sed lorem. Nam eget 
hendrerit dui..</p>

<p id="par_5" style="color: yellow">Aenean vitae commodo mi, non elementum enim. 
Nulla aliquam pharetra urna..</p></div>
<div id="id_bec991c905aee991" class="tabs-panel">The content of the fourth tab</div>
  
</div>