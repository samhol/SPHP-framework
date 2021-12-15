<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Views\LogViews\Holidays;

use Sphp\Apps\Calendars\Diaries\Holidays\BirthDay;
use Sphp\DateTime\Date;
use Sphp\DateTime\ImmutableDate;
use Sphp\Html\Lists\Dl;
use Sphp\Apps\Calendars\Views\LogViews\ViewFactory;

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
   * @var Date
   */
  private $viewedDate;

  /**
   * Constructor
   * 
   * @param Date $viewedDate
   */
  public function __construct(Date $viewedDate = null) {
    if ($viewedDate === null) {
      $viewedDate = new ImmutableDate();
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
   * @return Date
   */
  public function getViewedDate(): Date {
    return $this->viewedDate;
  }

  /**
   * Sets the viewed Date
   * 
   * @param Date $viewedDate
   * @return $this
   */
  public function setViewedDate(Date $viewedDate) {
    $this->viewedDate = $viewedDate;
    return $this;
  }

  /**
   * Creates the birthday view
   * 
   * @return string
   */
  public function build(BirthDay $birthday): string {
    $dob = $birthday->getDateOfBirth();
    $bornAgo = $dob->diff($this->viewedDate)->y;
    $age = $birthday->getAge($this->viewedDate)->y;
    //print_r($birthday->getAge($this->viewedDate));
    $dl = new Dl();
    $termText = $dl->appendTerm("Birthday of {$birthday->getName()}");

    if ($birthday->isFlagDay()) {
      $termText->prepend(ViewFactory::flag('fi'));
    }
    if (!$birthday->isDead()) {
      // print_r($person->getAge());
      $termText->append(' (' . $age . ' years of age)');
      if ($age === 0) {
        $dl->appendDescription('Born this day');
      } else {
        $dl->appendDescription('Was born on the ' . $dob->format('l jS \o\f F Y'));
      }
    } else {
      $dl->appendDescription("Was born $bornAgo years ago on " . $dob->format('l \t\h\e jS \o\f F Y'));
      $dod = $birthday->getDateOfDeath();
      $dl->appendDescription('Died on the ' . $dod->format('l jS \o\f F Y') . ' at ' . $birthday->getAge()->y . ' years of age');
    }
    if ($birthday->isNationalHoliday()) {
      $dl->appendDescription(" (national holiday)");
    }
    return "$dl";
  }

}
