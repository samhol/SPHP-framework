<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Inputs\Menus;

use Sphp\Stdlib\Arrays;

/**
 * Factory for generating {@link Select} components for specified tasks
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class MenuFactory {

  /**
   * Returns a new menu
   *
   * @param  string[] $content the contents of the menu
   * @param  string $name the value of the name attribute
   * @return Select component containing months
   */
  public static function getContentAsValueMenu(array $content, string $name = null): Select {
    if (count($content) > 0) {
      $content = array_combine($content, $content);
    }
    return new Select($name, $content);
  }

  /**
   * Returns a new menu containing a range
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

  /**
   * Creates a new instance of menu containing monnths
   * 
   * @param  string $name
   * @param  int $selected
   * @return Select new instance containing months
   */
  public static function months(string $name = null, int ...$selected): Select {
    $cal = new \Sphp\I18n\Datetime\CalendarUtils();
    $menu = Select::from($name, $cal->getMonths());
    if (!empty($selected)) {
      $menu->setSelectedValues($selected);
    }
    return $menu;
  }

}
