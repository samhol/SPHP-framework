<?php

/**
 * ButtonTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Core;

/**
 * Trait implements {@link ButtonStylingInterface} functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait ColoringTrait {

	/**
	 * CSS classes corresponding to the button style constants
	 *
	 * @var string[]
	 */
	private $styles = [
		"alert", "success", "secondary", "info", "disabled"
	];

	/**
	 * Sets the color to default
	 * 
	 * @return self for PHP Method Chaining
	 * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Sizing
	 */
	public function defaultColor() {
		return $this->setColor(null);
	}

	/**
	 * Sets the button color to `'alert'`
	 * 
	 * @return self for PHP Method Chaining
	 * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Sizing
	 */
	public function alertColor() {
		return $this->setColor("alert");
	}

	/**
	 * Sets the button color to `'success'`
	 * 
	 * @return self for PHP Method Chaining
	 * @link   http://foundation.zurb.com/docs/components/buttons.html#button-colors Button Sizing
	 */
	public function successColor() {
		return $this->setColor("success");
	}

	/**
	 * Sets the button color to `'secondary'`
	 * 
	 * @return self for PHP Method Chaining
	 * @link   http://foundation.zurb.com/docs/components/buttons.html#coloring Button Sizing
	 */
	public function secondaryColor() {
		return $this->setColor("secondary");
	}

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
	public function setColor($style = null) {
		$this->removeCssClass($this->styles);
		if ($style !== null) {
			$this->addCssClass($style);
			if (!in_array($style, $this->styles)) {
				$this->styles[] = $style;
			}
		}
		return $this;
	}

}
