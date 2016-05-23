<?php

/**
 * FilterAggregate.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Util\Filters;

/**
 * An aggregate of {@link FilterInterface} objects
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-12
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FilterAggregate extends AbstractFilter {

	/**
	 * the filter container
	 *
	 * @var callable[] 
	 */
	private $filters = [];

	/**
	 * Constructs a new instance of the {@link self} object
	 * 
	 * @param callable|callable[] $filters optional filters to add
	 */
	public function __construct($filters = null) {
		if ($filters !== null) {
			foreach (is_array($filters) ? $filters : [$filters] as $filter) {
				$this->addFilter($filter);
			}
		}
	}

	/**
	 * Destroys the instance
	 * 
	 * The destructor method will be called as soon as there are no other references 
	 * to a particular object, or in any order during the shutdown sequence.
	 */
	public function __destruct() {
		unset($this->filters);
	}

	/**
	 * Executes the filter for the given value
	 * 
	 * @param  mixed $value the value to filter
	 * @return mixed the filtered value
	 */
	public function filter($value) {
		foreach ($this->filters as $filter) {
			$value = $filter($value);
			//var_dump($filter);
			//var_dump($value); 
		}
		return $value;
	}

	/**
	 * Adds a filter to the aggregate
	 * 
	 * @param  callable $filter a filter to add
	 * @return self for PHP Method Chaining
	 * @throws \InvalidArgumentException if the `$filter` is not callable
	 */
	public function addFilter($filter) {
		if (is_callable($filter)) {
			$this->filters[] = $filter;
		} else {
			throw new \InvalidArgumentException();
		}
		return $this;
	}

}
