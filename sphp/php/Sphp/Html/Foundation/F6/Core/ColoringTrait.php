<?php

/**
 * ButtonTrait.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Core;

/**
 * Trait implements {@link ColourableInterface} functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
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
   * {@inheritdoc}
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
   * {@inheritdoc}
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
