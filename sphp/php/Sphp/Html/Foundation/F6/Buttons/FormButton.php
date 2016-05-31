<?php

/**
 * HyperlinkButton.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\Forms\InputInterface as InputInterface;
use Sphp\Html\Forms\InputTrait as InputTrait;

/**
 * Class implements an HTML &lt;button&gt; tag as a Foundation Button in PHP
 * 
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-04-11
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FormButton extends AbstractButton implements InputInterface {

	use InputTrait;

	/**
	 * Constructs a new instance
	 *
	 * **Important!**
	 *
	 * Parameter `mixed $content` can be of any type that converts to a
	 * string. So also an object of any class that implements magic method
	 * `__toString()` is allowed.
     *
     * @param  mixed $content the content of the button tag
     * @param  string $type the value of type attribute
     * @param  string $name the value of name attribute
     * @param  string $value the value of value attribute
	 * @link   http://www.w3schools.com/tags/att_button_type.asp type attribute
	 * @link   http://www.w3schools.com/tags/att_button_name.asp name attribute
	 * @link   http://www.w3schools.com/tags/att_button_value.asp value attribute
	 * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
	 */
	public function __construct($content = null, $type = null, $name = null, $value = null) {
		parent::__construct("button", $content);	
        $this->setType($type)->setName($name)->setValue($value);
	}

    /**
     * Returns the value of the value attribute
     *
     * @return string napin arvo
	 * @return self for PHP Method Chaining
	 * @link   http://www.w3schools.com/tags/att_button_value.asp value attribute
     */
    public function getValue() {
        return $this->getAttr("value");
    }

    /**
     * Sets the value of the value attribute
     *
     * @param  string $value napin arvo
	 * @return self for PHP Method Chaining
	 * @link   http://www.w3schools.com/tags/att_button_value.asp value attribute
     */
    public function setValue($value) {
        return $this->setAttr("value", $value);
    }

	/**
	 * Returns the value of the type attribute
	 *
	 * @return string the value of the type attribute
	 * @link   http://www.w3schools.com/tags/att_button_type.asp type attribute
	 */
	public function getType() {
		return $this->getAttr("type");
	}

	/**
	 * Sets the value of the type attribute
	 *
	 * @param  string $type the value of the type attribute
	 * @return self for PHP Method Chaining
	 * @link   http://www.w3schools.com/tags/att_button_type.asp type attribute
	 */
	public function setType($type) {
		return $this->setAttr("type", $type);
	}

}
