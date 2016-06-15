<?php

/**
 * ColourableInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Core;

/**
 * Trait implements {@link ButtonStylingInterface} functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ColourableInterface {

	/**
	 * Sets the color to default
	 * 
	 * @return self for PHP Method Chaining
	 * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Sizing
	 */
	public function defaultColor();

	/**
	 * Sets the color (a CSS class)
	 * 
	 * Predefined values of <var>$style</var> parameter:
	 * 
	 * * `null` unsets all special button styles (default)
	 * * `'alert'` for alert/error buttons
	 * * `'success'` for ok/success buttons
	 * * `'info'` for information buttons
	 * * `'secondary'` for alternatively styled buttons
	 * * `'disabled'` for disabled buttons
	 * 
	 * @param  string|null $style one of the CSS class names defining button styles
	 * @return self for PHP Method Chaining
	 * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Sizing
	 */
	public function setColor($style = null);

}