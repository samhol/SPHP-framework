<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews\Holidays;

use Sphp\DateTime\Calendars\Diaries\Holidays\HolidayInterface;
use Sphp\DateTime\Calendars\Diaries\DiaryDate;
use Sphp\DateTime\Calendars\Diaries\Holidays\BirthDay;
use Sphp\DateTime\DateInterface;
use Sphp\Html\PlainContainer;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Dl;
use Sphp\Html\Content;
use Sphp\Html\DateTime\Calendars\LogViews\ViewFactory;

/**
 * Description of BirthdayView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BirthdayView implements Content {

  use \Sphp\Html\ContentTrait;

  /**
   * @var DateInterface
   */
  private $currentDate;

  /**
   * Constructor
   * 
   * @param DateInterface $currentDate
   */
  public function __construct(DateInterface $currentDate) {
    $this->currentDate = $currentDate;
  }

  public function __destruct() {
    unset($this->currentDate);
  }

  /**
   * Creates the birthday view
   * 
   * @return string
   */
  public function build(BirthDay $birthday): string {
    $dob = $birthday->getDate();
    $bornAgo = $dob->diff($this->currentDate)->y;
    $person = $birthday->getPerson();
    $age = $person->getAge($this->currentDate)->y;
    $dl = new Dl();
    $termText = $dl->appendTerm("Birthday of {$person->getFullname()}");
    if (!$person->isDead()) {
      // print_r($person->getAge());
      $termText->append(' (' . $age . ' years of age)');
      if ($age === 0) {
        $dl->appendDescription('Born this day');
      } else {
        $dl->appendDescription('Was born on the ' . $dob->format('l jS \o\f F Y'));
      }
    } else {
      $dl->appendDescription('Was born on the ' . $dob->format('l jS \o\f F Y') . " $bornAgo years ago");
      $dod = $person->getDateOfDeath();
      $dl->appendDescription('Died on the ' . $dod->format('l jS \o\f F Y') . ' at ' . $person->getAge()->y . ' years of age');
    }
    if ($birthday->isNationalHoliday()) {
      $dl->appendDescription(" (national holiday)");
    }
    if ($birthday->isFlagDay()) {
      $dl->appendDescription(ViewFactory::flag('finland'));
    }
    return "$dl";
  }

  public function getHtml(): string {
    return "{$this->build()}";
  }

}
