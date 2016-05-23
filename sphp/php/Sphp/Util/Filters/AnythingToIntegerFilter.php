<?php

/**
 * IntegerConverterFilter.php.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Util\Filters;

/**
 * Filter converts an input value to a corresponding integer value according to the PHP type conversion
 * 
 * * All non negative integer values remain unchanged. 
 * * value is consideserd as an integer if it contains only numbers
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AnythingToIntegerFilter extends AbstractFilter {

	/**
	 * Executes the filter for the given value
	 * 
	 * @param  mixed $value the value to filter
	 * @return mixed the filtered value
	 */
	public function filter($value) {
		return filter_var($value, FILTER_VALIDATE_INT, ["options" => ["default" => 0]]);
	}

}
