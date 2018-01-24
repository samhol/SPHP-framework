<?php

/**
 * CalendarUtils.php (UTF-8)
 * Copyright (c) 2018 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\I18n\Datetime;

/**
 * Description of CalendarUtils
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2018-01-24
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CalendarUtils {

  private static $days = array(
      1 => 'Monday',
      2 => 'Tuesday',
      3 => 'Wednesday',
      4 => 'Thursday',
      5 => 'Friday',
      6 => 'Saturday',
      7 => 'Sunday',
  );

  public static function getWeekdayNames(): array {
    $days = static::$days;
    $translator = new \Sphp\I18n\Gettext\Translator('Sphp.Datetime', 'sphp/locale');
    return $translator->translateArray($days);
  }

}
