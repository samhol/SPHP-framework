<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\DateTime\Calendars\Notes;

use Sphp\DateTime\Date;
use Exception;
use Sphp\DateTime\Exceptions\DateTimeException;

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
  private $weekly = [];
  private $daily = [];

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

  public function containsAnnualNotes(int $month, int $day): bool {
    return array_key_exists($month, $this->annuals) && array_key_exists($day, $this->annuals[$month]) && !empty($this->annuals[$month]);
  }

  public function getAnnualNotes(int $month, int $day): array {
    $notes = [];
    if ($this->containsAnnualNotes($month, $day)) {
      $notes = $this->annuals[$month][$day];
    }
    return $notes;
  }

  public function getAnnualNotesForDate($date): array {
    $notes = [];
    $parsed = Date::from($date);
    $month = $parsed->getMonth();
    $day = $parsed->getMonthDay();
    if ($this->containsAnnualNotes($month, $day)) {
      $notes = $this->annuals[$month][$day];
    }
    return $notes;
  }

  /**
   * 
   * @param  type $date
   * @return AnnualNote
   */
  public function getNotesForDate($date): array {

    return array_key_exists($month, $this->annuals) && array_key_exists($day, $this->annuals[$month]) && !empty($this->annuals[$month]);
    return $holiday;
  }

  public function insertNote(Note $note) {
    if ($note instanceof AnnualNote) {
      $this->insertAnnualNote($note);
    }
  }

  public function containsAnnualNote(AnnualNote $note): bool {
    $contains = false;
    foreach ($this->getAnnualNotes($note->getMonth(), $note->getMonthDay()) as $n) {
      $contains = $note == $n;
      if ($contains) {
        break;
      }
    }
    return $contains;
  }

  public function insertAnnualNote(AnnualNote $note): bool {
    $month = $note->getMonth();
    $day = $note->getMonthDay();
    if (!array_key_exists($month, $this->annuals) || !array_key_exists($day, $this->annuals[$month])) {
      $this->annuals[$month][$day] = [];
    }
    if ($this->containsAnnualNote($note)) {
      return false;
    }
    $this->annuals[$month][$day][] = $note;
    return true;
  }

  
  public function insertWeeklyNote(WeeklyNote $note): bool {
    $month = $note->getMonth();
    $day = $note->getMonthDay();
    if (!array_key_exists($month, $this->annuals) || !array_key_exists($day, $this->annuals[$month])) {
      $this->annuals[$month][$day] = [];
    }
    if ($this->containsAnnualNote($note)) {
      return false;
    }
    $this->annuals[$month][$day][] = $note;
    return true;
  }
  
}
