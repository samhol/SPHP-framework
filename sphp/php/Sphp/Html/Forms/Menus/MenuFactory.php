<?php

/**
 * MenuFactory.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Menus;

use Sphp\Gettext\Calendar as Calendar;
use Sphp\Core\Types\Arrays as Arrays;

/**
 * Factory for generating {@link Select} components for specified tasks
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-10
 * @version 1.0.0
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
	public static function getContentAsValueMenu(array $content, $name = null) {
		return new Select($name, Arrays::valuesToKeys($content));
	}

	/**
	 * Returns a new {@link Select} component containing months
	 *
	 * @param  string $name the value of the name attribute
	 * @return Select component containing months
	 */
	public static function monthMenu($name = "month") {
		return new Select($name, (new Calendar())->getMonths());
	}

	/**
	 * Returns a new {@link Select} component containing weekdays
	 *
	 * @param  string $lang the language used ("en" = english, "fi" = finnish)
	 * @param  string $name the value of the name attribute
	 * @return Select component containing weekdays
	 */
	public static function getWeekdayMenu($lang = "en", $name = "weekday") {
		return new Select($name, (new Calendar())->getWeekdays($lang));
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
	public static function rangeMenu($from, $to, $step = 1, $name = null) {
		$range = range($from, $to, $step);
		return new Select($name, array_combine($range, $range));
	}

}
