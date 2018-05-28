<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\DateTime\Calendars\Diaries\Holidays;

/**
 * Defines HolidayDiary
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface HolidayDiary {

  /**
   * Returns all birthday notes stored
   * 
   * @return BirthDay[] all birthday notes stored
   */
  public function getBirthdays(): array;

  /**
   * Returns all holidays stored
   * 
   * @return Holiday[] all holiday notes stored
   */
  public function getHolidays(): array;

  /**
   * Returns all note type notes stored
   * 
   * @return Note[] all note type notes stored
   */
  public function getNotes(): array;
}
