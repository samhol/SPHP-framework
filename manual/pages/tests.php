<?php

namespace Sphp\Manual;

codeModal('locations', 'Sphp/Database/locations.sql', "`MySQL` version of locations table")->printHtml();
?>

<input class="searchBox" id="searchBox1" type="search" placeholder="search1" />
<input type="radio" name="fname" placeholder="First name"><br>
<input type="range" name="lname" placeholder="Last name"><br>
<input type="text" id="vw" name="foo" data-sphp-locale="fi_FI" placeholder="foo date" data-anytime><br>

<?php
$group = new \Sphp\Html\Foundation\Sites\Forms\Inputs\InputGroup;
//$group->appendInput('number')->setPlaceholder('Age');
$group->appendInput('text', 'username')->setPlaceholder('insert foo');
$group->appendInput('email', 'foomail')->setPlaceholder('Type e-mail address');
$group->appendSubmitter('Submit', 'foo-submit')->addCssClass('success');
$group->appendResetter('Reset')->addCssClass('alert');
echo $group;

$sf = new \Sphp\Html\Apps\Forms\SiteSearch360Form('playground.samiholck.com');
echo $sf;
echo $sf->createResultComponent();
?>
<input class="searchBox" id="searchBox2" type="search" placeholder="search2">
<div class="grid-x">
  <div class="cell auto">
    <div data-slick='{"slidesToShow": 4, "slidesToScroll": 4}'>
      <div><h3>1</h3></div>
      <div><h3>2</h3></div>
      <div><h3>3</h3></div>
      <div><h3>4</h3></div>
      <div><h3>5</h3></div>
      <div><h3>6</h3></div>
    </div>
  </div>
</div>
