<?php

use Sphp\Data\Person;
use Sphp\DateTime\Calendars\Diaries\Holidays\Fi\HolidayDiary;
use Sphp\DateTime\Calendars\Diaries\Holidays\Holidays;

echo "<pre>";
$fi = new HolidayDiary();
$fi->insertLog(Holidays::birthday('1975-9-16', 'Sami, Holck'));
$d = $fi->getDate('2018-12-6');
$dd = $fi->getDate('2018-12-24');

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
  <div class="calendar-date-root">
    <h1>Awesome. I Have It.</h1>
    <p class="lead">Your couch. It is mine.</p>
    <p>I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p>
  </div>
  <button class="close-button" data-close aria-label="Close modal" type="button">
    <span aria-hidden="true">&times;</span>
  </button>
</div>

<p><button class="button" data-date="2018-12-23" data-url="manual/snippets/loremipsum.html" data-open="exampleModal1">Click me for a modal</button></p>
<p><button class="button alert" data-date="2018-09-16" data-url="sphp/ajax/DateInfoContent.php" data-open="exampleModal1">Click me for a modal1</button></p>
<p><button class="button warning" data-date="2018-12-6" data-url="manual/snippets/sleep.php" data-open="exampleModal1">Click me for a modal2</button></p>

<div class="sphp calendar-month"><div class="grid-x"><div class="cell auto">
                                                                                                                                                                                                        <div class="sphp month-selector"><a href="calendar/2018/2" data-sphp-qtip="" data-sphp-qtip-at="bottom center" data-sphp-qtip-my="top center" class="prev-month" data-hasqtip="2" oldtitle="Go to February 2018" title=""><svg aria-hidden="true" class="svg-inline--fa fa-chevron-left fa-w-10 fa-sm" data-prefix="fas" data-icon="chevron-left" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M34.52 239.03L228.87 44.69c9.37-9.37 24.57-9.37 33.94 0l22.67 22.67c9.36 9.36 9.37 24.52.04 33.9L131.49 256l154.02 154.75c9.34 9.38 9.32 24.54-.04 33.9l-22.67 22.67c-9.37 9.37-24.57 9.37-33.94 0L34.52 272.97c-9.37-9.37-9.37-24.57 0-33.94z"></path></svg><!-- <i aria-hidden="true" class="fas fa-chevron-left fa-sm"></i> --><span class="show-for-sr">Go to February 2018</span></a><span>March 2018</span><a href="calendar/2018/4" data-sphp-qtip="" data-sphp-qtip-at="bottom center" data-sphp-qtip-my="top center" class="next-month" data-hasqtip="3" oldtitle="Go to April 2018" title=""><svg aria-hidden="true" class="svg-inline--fa fa-chevron-right fa-w-10 fa-sm" data-prefix="fas" data-icon="chevron-right" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512" data-fa-i2svg=""><path fill="currentColor" d="M285.476 272.971L91.132 467.314c-9.373 9.373-24.569 9.373-33.941 0l-22.667-22.667c-9.357-9.357-9.375-24.522-.04-33.901L188.505 256 34.484 101.255c-9.335-9.379-9.317-24.544.04-33.901l22.667-22.667c9.373-9.373 24.569-9.373 33.941 0L285.475 239.03c9.373 9.372 9.373 24.568.001 33.941z"></path></svg><!-- <i aria-hidden="true" class="fas fa-chevron-right fa-sm"></i> --><span class="show-for-sr">Go to April 2018</span></a></div></div></div><div class="grid-x"><div class="cell auto">
      <div class="head day">
        <span class="show-for-small-only">Mo</span>
        <span class="hide-for-small-only">Monday</span>
      </div>
    </div><div class="cell auto">
      <div class="head day">
        <span class="show-for-small-only">Tu</span>
        <span class="hide-for-small-only">Tuesday</span>
      </div>
    </div><div class="cell auto">
      <div class="head day">
        <span class="show-for-small-only">We</span>
        <span class="hide-for-small-only">Wednesday</span>
      </div>
    </div><div class="cell auto">
      <div class="head day">
        <span class="show-for-small-only">Th</span>
        <span class="hide-for-small-only">Thursday</span>
      </div>
    </div><div class="cell auto">
      <div class="head day">
        <span class="show-for-small-only">Fr</span>
        <span class="hide-for-small-only">Friday</span>
      </div>
    </div><div class="cell auto">
      <div class="head day">
        <span class="show-for-small-only">Sa</span>
        <span class="hide-for-small-only">Saturday</span>
      </div>
    </div><div class="cell auto">
      <div class="head day">
        <span class="show-for-small-only">Su</span>
        <span class="hide-for-small-only">Sunday</span>
      </div>
    </div>
  </div>
  <div class="grid-x">
    <div class="cell auto">
      <div class="sphp calendar-day not-selected-month monday">
        <div class="week-nr">9</div>
        <time datetime="2018-02-26 00:00:00+0200" title="Monday, 2018-02-26">26</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day not-selected-month tuesday">
        <time datetime="2018-02-27 00:00:00+0200" title="Tuesday, 2018-02-27">27</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day not-selected-month has-info flag-day wednesday" data-open="aqoV0LHIkYXIiXh1" aria-controls="aqoV0LHIkYXIiXh1" aria-haspopup="true" tabindex="0">
        <time datetime="2018-02-28 00:00:00+0200" title="Wednesday, 2018-02-28">
          <span class="flag">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 180 110">
              <rect width="180" height="110" fill="#fff"></rect>
              <rect width="180" height="30" y="40" fill="#003580"></rect>
              <rect width="30" height="110" x="50" fill="#003580"></rect>
            </svg>
          </span>28</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month thursday">
        <time datetime="2018-03-01 00:00:00+0200" title="Thursday, 2018-03-01">1</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month friday">
        <time datetime="2018-03-02 00:00:00+0200" title="Friday, 2018-03-02">2</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month saturday">
        <time datetime="2018-03-03 00:00:00+0200" title="Saturday, 2018-03-03">3</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info sunday" data-open="hpn7JHxvKfuyHp3T" aria-controls="hpn7JHxvKfuyHp3T" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-04 00:00:00+0200" title="Sunday, 2018-03-04">4</time>
      </div>
    </div>
  </div>
  <div class="grid-x">
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info monday" data-open="AZ973jLDR6UnWVdC" aria-controls="AZ973jLDR6UnWVdC" aria-haspopup="true" tabindex="0">
        <div class="week-nr">10</div>
        <time datetime="2018-03-05 00:00:00+0200" title="Monday, 2018-03-05">5</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month tuesday">
        <time datetime="2018-03-06 00:00:00+0200" title="Tuesday, 2018-03-06">6</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info wednesday" data-open="cL6WDYExIUk3Lfck" aria-controls="cL6WDYExIUk3Lfck" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-07 00:00:00+0200" title="Wednesday, 2018-03-07">7</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month thursday">
        <time datetime="2018-03-08 00:00:00+0200" title="Thursday, 2018-03-08">8</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info friday" data-open="SltmGHXQokItNABN" aria-controls="SltmGHXQokItNABN" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-09 00:00:00+0200" title="Friday, 2018-03-09">9</time>
      </div>
    </div><div class="cell auto">
      <div class="sphp calendar-day selected-month has-info saturday" data-open="syicLKtkagisW2KC" aria-controls="syicLKtkagisW2KC" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-10 00:00:00+0200" title="Saturday, 2018-03-10">10</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info sunday" data-open="GrtvJgpDDIKIzrfN" aria-controls="GrtvJgpDDIKIzrfN" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-11 00:00:00+0200" title="Sunday, 2018-03-11">11</time>
      </div>
    </div>
  </div>
  <div class="grid-x">
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info monday" data-open="TPGgnmWWR0rTM1pv" aria-controls="TPGgnmWWR0rTM1pv" aria-haspopup="true" tabindex="0">
        <div class="week-nr">11</div>
        <time datetime="2018-03-12 00:00:00+0200" title="Monday, 2018-03-12">12</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month tuesday">
        <time datetime="2018-03-13 00:00:00+0200" title="Tuesday, 2018-03-13">13</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info wednesday" data-open="PhxskSsn0dcYkmbw" aria-controls="PhxskSsn0dcYkmbw" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-14 00:00:00+0200" title="Wednesday, 2018-03-14">14</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month thursday">
        <time datetime="2018-03-15 00:00:00+0200" title="Thursday, 2018-03-15">15</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info friday" data-open="nOpuFhj2fxA6CiAd" aria-controls="nOpuFhj2fxA6CiAd" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-16 00:00:00+0200" title="Friday, 2018-03-16">16</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info saturday" data-open="QxbagOU6kSn6oW2f" aria-controls="QxbagOU6kSn6oW2f" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-17 00:00:00+0200" title="Saturday, 2018-03-17">17</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info sunday" data-open="ST4KEDLAUz1n3ziY" aria-controls="ST4KEDLAUz1n3ziY" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-18 00:00:00+0200" title="Sunday, 2018-03-18">18</time>
      </div>
    </div>
  </div><div class="grid-x"><div class="cell auto">
      <div class="sphp calendar-day selected-month has-info flag-day monday" data-open="R7wpwYFfF1yaYQvS" aria-controls="R7wpwYFfF1yaYQvS" aria-haspopup="true" tabindex="0">
        <div class="week-nr">12</div><time datetime="2018-03-19 00:00:00+0200" title="Monday, 2018-03-19">
          <span class="flag"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 180 110">
              <rect width="180" height="110" fill="#fff"></rect>
              <rect width="180" height="30" y="40" fill="#003580"></rect>
              <rect width="30" height="110" x="50" fill="#003580"></rect>
            </svg>
          </span>19</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info tuesday" data-open="P5oOFvIJnMz9ngsM" aria-controls="P5oOFvIJnMz9ngsM" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-20 00:00:00+0200" title="Tuesday, 2018-03-20">20</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month wednesday">
        <time datetime="2018-03-21 00:00:00+0200" title="Wednesday, 2018-03-21">21</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info thursday" data-open="JqPokoVZZIjAYM89" aria-controls="JqPokoVZZIjAYM89" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-22 00:00:00+0200" title="Thursday, 2018-03-22">22</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info friday" data-open="ojQeoDQJ55l6gfJV" aria-controls="ojQeoDQJ55l6gfJV" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-23 00:00:00+0200" title="Friday, 2018-03-23">23</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month saturday">
        <time datetime="2018-03-24 00:00:00+0200" title="Saturday, 2018-03-24">24</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info sunday" data-open="uU0PG03ksyEIFYGj" aria-controls="uU0PG03ksyEIFYGj" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-25 00:00:00+0200" title="Sunday, 2018-03-25">25</time>
      </div>
    </div>
  </div>
  <div class="grid-x">
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info monday" data-open="c3T2zTHEIxRrCpjl" aria-controls="c3T2zTHEIxRrCpjl" aria-haspopup="true" tabindex="0">
        <div class="week-nr">13</div>
        <time datetime="2018-03-26 00:00:00+0300" title="Monday, 2018-03-26">26</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info tuesday" data-open="exampleModal1" aria-controls="exampleModal1" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-27 00:00:00+0300" title="Tuesday, 2018-03-27">27</time>
      </div>
    </div><div class="cell auto"><div class="sphp calendar-day selected-month wednesday">
        <time datetime="2018-03-28 00:00:00+0300" title="Wednesday, 2018-03-28">28</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info thursday" data-open="exampleModal1" aria-controls="exampleModal1" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-29 00:00:00+0300" title="Thursday, 2018-03-29">29</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month has-info holiday friday" data-date="2018-03-30" data-open="exampleModal1" aria-controls="exampleModal1" aria-haspopup="true" tabindex="0">
        <time datetime="2018-03-30 00:00:00+0300" title="Friday, 2018-03-30">30</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day selected-month saturday">
        <time datetime="2018-03-31 00:00:00+0300" title="Saturday, 2018-03-31">31</time>
      </div>
    </div>
    <div class="cell auto">
      <div class="sphp calendar-day not-selected-month has-info holiday sunday" data-date="2018-04-01" data-open="exampleModal1" aria-controls="exampleModal1" aria-haspopup="true" tabindex="0">
        <time datetime="2018-04-01 00:00:00+0300" title="Sunday, 2018-04-01">1</time>
      </div>
    </div>
  </div>
</div>
