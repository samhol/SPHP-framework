<?php

/**
 * MenuFactory.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\I18n\Calendar;
use Sphp\Stdlib\Arrays;

/**
 * Factory for generating {@link Select} components for specified tasks
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class MenuFactory {

  /**
   * Returns a new {@link Select} containing {@link Option} 
   * components having their content as value
   *
   * @param  string[] $content the contents of the menu
   * @param  string $name the value of the name attribute
   * @return Select component containing months
   */
  public static function getContentAsValueMenu(array $content, string $name = null): Select {
    return new Select($name, Arrays::valuesToKeys($content));
  }

  /**
   * Returns a new {@link Select} component containing a range
   *
   * @param  mixed $from the lower limit
   * @param  mixed $to the upper limit
   * @param  int $step step the increment between elements in the sequence
   * @param  string $name the value of the name attribute
   * @return Select component containing the range
   */
  public static function rangeMenu($from, $to, $step = 1, $name = null): Select {
    $range = range($from, $to, $step);
    return new Select($name, array_combine($range, $range));
  }

}
