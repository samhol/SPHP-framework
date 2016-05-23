<?php

/**
 * HiddenInput.php (UTF-8)
 *
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>.
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

namespace Sphp\Html\Forms\Input;

use Sphp\Html\Forms\InputTrait as InputTrait;

/**
 * Class models an HTML &lt;input type="hidden"&gt; tag
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-03-10
 * @version 2.0.1
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class HiddenInput extends AbstractInputTag {

	use InputTrait;

	/**
	 * Constructs a new instance
	 *
	 * @param  string|null $name name attribute
	 * @param  string|null $value value attribute
	 * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
	 * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
	 */
	public function __construct($name = null, $value = null) {
		parent::__construct("hidden", $name, $value);
	}

}
