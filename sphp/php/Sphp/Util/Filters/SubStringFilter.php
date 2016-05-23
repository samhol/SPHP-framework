<?php

/**
 * SubStringFilter.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Util\Filters;

/**
 * Filter returns the portion of string specified by the start and length parameters
 * 
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SubStringFilter extends AbstractStringFilter {

	/**
	 * position of first character to use
	 *
	 * @var int 
	 */
	private $start;
	/**
	 * maximum number of characters to use. If omitted or  null is passed, 
	 * extract all characters to the end of the string.
	 *
	 * @var int|null  
	 */
	private $length;

	/**
	 * Constructs a new {@link self} object
	 * 
	 * @param  int $start position of first character to use
	 * @param  int|null $length maximum number of characters to use. If omitted or 
	 *         null is passed, extract all characters to the end of the string.
	 */
	public function __construct($start = 0, $length = null) {
		$this->start = $start;
		$this->length = $length;
		parent::__construct();
	}

	/**
	 * Executes the filter for the given value
	 * 
	 * @param  string $string the value to filter
	 * @return mixed the filtered value
	 */
	protected function runFilter($string) {
		return mb_substr($string, $this->start, $this->length, "UTF-8");
	}

}
