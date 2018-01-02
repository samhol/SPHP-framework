<?php

namespace Sphp\Manual;

codeModal('locations', 'Sphp/Database/locations.sql', "`MySQL` version of locations table")->printHtml();
?>

<input type="radio" name="fname" placeholder="First name"><br>
<input type="range" name="lname" placeholder="Last name"><br>
<form novalidate>
  <?php
  $group = new \Sphp\Html\Foundation\Sites\Forms\Inputs\InputGroup;
//$group->appendInput('number')->setPlaceholder('Age');
  $group->appendInput('text', 'username')->setPlaceholder('insert foo');
  $group->appendInput('email', 'foomail')->setPlaceholder('Type e-mail address');
  $group->appendSubmitter('Submit', 'foo-submit')->addCssClass('success');
  $group->appendResetter('Reset')->addCssClass('alert');
  echo $group;
  ?>

  <div class="slider" data-slider data-initial-start="25" data-initial-end="75">
    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="a"></span>
    <span class="slider-fill" data-slider-fill></span>
    <span class="slider-handle" data-slider-handle role="slider" tabindex="1" aria-controls="b"></span>

  </div>

  <input type="number" id="a">
  <span name="number" id="b"></span>
</form>
