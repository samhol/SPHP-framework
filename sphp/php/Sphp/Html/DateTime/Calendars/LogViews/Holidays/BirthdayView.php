<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\DateTime\Calendars\LogViews\Holidays;

use Sphp\DateTime\Calendars\Diaries\Holidays\BirthDay;
use Sphp\DateTime\DateInterface;
use Sphp\DateTime\Date;
use Sphp\Html\Lists\Dl;
use Sphp\Html\DateTime\Calendars\LogViews\ViewFactory;

/**
 * Implements a birthday view builder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class BirthdayView {

  /**
   * @var DateInterface
   */
  private $viewedDate;

  /**
   * Constructor
   * 
   * @param DateInterface $viewedDate
   */
  public function __construct(DateInterface $viewedDate = null) {
    if ($viewedDate === null) {
      $viewedDate = new Date();
    }
    $this->viewedDate = $viewedDate;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->viewedDate);
  }

  /**
   * Implements function call
   * 
   * @param BirthDay $birthday
   * @return string
   */
  public function __invoke(BirthDay $birthday): string {
    return $this->build($birthday);
  }

  /**
   * Returns the viewed Date
   * 
   * @return DateInterface
   */
  public function getViewedDate(): DateInterface {
    return $this->viewedDate;
  }

  /**
   * Sets the viewed Date
   * 
   * @param DateInterface $viewedDate
   * @return $this
   */
  public function setViewedDate(DateInterface $viewedDate) {
    $this->viewedDate = $viewedDate;
    return $this;
  }

  /**
   * Creates the birthday view
   * 
   * @return string
   */
  public function build(BirthDay $birthday): string {
    $dob = $birthday->getDate();
    $bornAgo = $dob->diff($this->viewedDate)->y;
    $person = $birthday->getPerson();
    $age = $person->getAge($this->viewedDate)->y;
    $dl = new Dl();
    $termText = $dl->appendTerm("Birthday of {$person->getFullname()}");
    
    if ($birthday->isFlagDay()) {
      $termText->prepend(ViewFactory::flag('fi'));
    }
    if (!$person->isDead()) {
      // print_r($person->getAge());
      $termText->append(' (' . $age . ' years of age)');
      if ($age === 0) {
        $dl->appendDescription('Born this day');
      } else {
        $dl->appendDescription('Was born on the ' . $dob->format('l jS \o\f F Y'));
      }
    } else {
      $dl->appendDescription("Was born $bornAgo years ago on " . $dob->format('l \t\h\e jS \o\f F Y'));
      $dod = $person->getDateOfDeath();
      $dl->appendDescription('Died on the ' . $dod->format('l jS \o\f F Y') . ' at ' . $person->getAge()->y . ' years of age');
    }
    if ($birthday->isNationalHoliday()) {
      $dl->appendDescription(" (national holiday)");
    }
    return "$dl";
  }

}
