<?php

/**
 * Th.php (UTF-8)
 *
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>.
 *
 * This file is part of SPH framework.
 *
 * SPH framework is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * SPH framework is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with SPH framework.  If not, see <http://www.gnu.org/licenses/>.
 *
 */

namespace Sphp\Html\Tables;

/**
 * Class models an HTML &lt;table&gt; tag's header cell (&lt;th&gt; tag)
 * 
 * The {@link self} defines a header cell in a {@link Table} component
 *
 *
 * {@inheritdoc}
 *
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2012-08-28
 * @version 1.0.0
 *
 * @link http://www.w3schools.com/tags/tag_th.asp w3schools HTML API link
 */
class Th extends Cell {
	
	/**
	 * the tag name of the HTML component
	 */
	const TAG_NAME = "th";

	/**
	 * Constructs a new instance
	 *
	 * <p>**Important!**</p>
	 *
	 * <p>Parameter `$content` can be of any type that converts to a
	 * string or to an array of strings. So also an object of any class that
	 * implements magic method `__toString()` is allowed.</p>
	 *
	 *  <p>**Preconditions:**</p>
	 *  <ol>
	 *    * $scope =="row" | $scope =="col" | $scope =="rowgroup" | $scope =="colgroup"
	 *    * $colspan &gt;= 1 & $rowspan >= 1
	 *  </ol>
	 *
	 * @param mixed $content the content of the tag
	 * @param string $scope the value of the scope attribute
	 * @param int $colspan solun colspan attribute value
	 * @param int $rowspan solun rowspan attribute value
	 * @link  http://www.w3schools.com/tags/att_th_scope.asp scope attribute
	 * @link  http://www.w3schools.com/tags/att_th_colspan.asp colspan attribute
	 * @link  http://www.w3schools.com/tags/att_th_rowspan.asp rowspan attribute
	 */
	public function __construct($content = null, $scope = null, $colspan = 1, $rowspan = 1) {
		parent::__construct(self::TAG_NAME, $content);
		if ($scope !== null) {
			$this->setScope($scope);
		}
		$this->setColspan($colspan)
				->setRowspan($rowspan);
	}

	/**
	 * Sets the value of the scope attribute
	 *
	 *  <p>**Preconditions:**</p>
	 *  <ol>
	 *    * $scope =="row" | $scope =="col" | $scope =="rowgroup" | $scope =="colgroup"
	 *  </ol>
	 *
	 * @param  string $scope the value of the scope attribute
	 * @return self for PHP Method Chaining
	 * @link   http://www.w3schools.com/tags/att_th_scope.asp scope attribute
	 */
	public function setScope($scope) {
		return $this->setAttr("scope", $scope);
	}

	/**
	 * Returns the value of the scope attribute
	 *
	 * @return string the value of the scope attribute
	 * @link   http://www.w3schools.com/tags/att_th_scope.asp scope attribute
	 */
	public function getScope() {
		return $this->getAttr("scope");
	}

}
