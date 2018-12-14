<?php

use Sphp\Data\Person;
use Sphp\DateTime\Calendars\Diaries\Holidays\Fi\HolidayDiary;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;

echo "<pre>";
$fi = new HolidayDiary();
$fi->insertLog(Holidays::birthday('1975-9-16', 'Sami, Holck'));
$d = $fi->getDate('2018-12-6');
$dd = $fi->getDate('2018-12-24');
$dateInfo = new Sphp\Html\DateTime\Calendars\DateInfo($d, 'foo');
echo $dateInfo . "\n";

$dateInfo1 = new Sphp\Html\DateTime\Calendars\DateInfo($dd, 'foo1');
echo $dateInfo1;
$cont = new Sphp\Html\DateTime\Calendars\DateInfoContetnGenerator();
echo $cont->generate($d);
$c = new Sphp\DateTime\Calendars\Diaries\Constraints\Constraints();
$c->isBefore('2008-11-1');
$c->isNotOneOf('2008-10-1', '2008-10-3');

var_dump($c->isValidDate('2010-10-1'));
var_dump($c->isValidDate('2008-10-1'));
var_dump($c->isValidDate('2008-10-2'));

$person = new Person();
$person->setFname('Vilho')->setLname('Koivisto');
$person->setDateOfBirth('1918-01-07');
$person->setDateOfDeath('2016-12-05');
var_dump($person->getAge()->y);
$person->getAddress()->setStreet('Tuohimaantie 14')->setCity('Loimaa')->setCountry('Finland');
echo $person;


$person1 = new Person();
$person1->setFname('Vilho')->setLname('Koivisto');
$person1->setDateOfBirth('1918-01-07');
$person1->getAddress()->setStreet('Tuohimaantie 14')->setCity('Loimaa')->setCountry('Finland');
echo $person1;
echo "</pre>";
?>
<div class="reveal" id="exampleModal1" data-reveal>
  <h1>Awesome. I Have It.</h1>
  <p class="lead">Your couch. It is mine.</p>
  <p>I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<p><button class="button" data-url="manual/snippets/loremipsum.html" data-open="exampleModal1">Click me for a modal</button></p>
<p><button class="button alert" data-url="manual/snippets/loremipsum.md" data-open="exampleModal1">Click me for a modal1</button></p>
<p><button class="button warning" data-url="manual/snippets/loremipsum.txt" data-open="exampleModal1">Click me for a modal2</button></p>

<script>
</script>
