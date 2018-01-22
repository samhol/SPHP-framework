<?php

namespace Sphp\Manual;

codeModal('locations', 'Sphp/Database/locations.sql', "`MySQL` version of locations table")->printHtml();
?>

<input class="searchBox" id="searchBox1" type="search" placeholder="search1" />
<input type="radio" name="fname" placeholder="First name"><br>
<input type="range" name="lname" placeholder="Last name"><br>

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

