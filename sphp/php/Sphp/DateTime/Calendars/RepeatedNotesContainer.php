<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\DateTime\Calendars;

/**
 * Description of AnnualsContainer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class RepeatedNotesContainer {

  private $annuals = [];

  /**
   * Constructor
   * 
   * @param Date $date
   */
  public function __construct() {
    $this->annuals = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->annuals);
  }

  public function setAnnualHoliday(int $month, int $day, string $name): AnnualHoliday {
    $holiday = $this->annuals[$month][$day][] = $name;
    return $holiday;
  }

  public function containsAnnualNotes(int $month, int $day): bool {
    return array_key_exists($month, $this->annuals) && array_key_exists($day, $this->annuals[$month]) && !empty($this->annuals[$month]);
  }

  public function getAnnualNotes(int $month, int $day, string $name): Holiday {
    $holiday = $this->annuals[$month][$day] = $name;
    return $holiday;
  }

  /**
   * 
   * @param type $date
   * @return AnnualNote
   */
  public function getAnnualHolidaysForDate($date): array {
    $holiday = $this->annuals[$month][$day] = $name;
    return $holiday;
  }
  
  public function insertNote() {
    
  }
}
