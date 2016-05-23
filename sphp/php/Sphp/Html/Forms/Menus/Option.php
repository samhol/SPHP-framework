<?php

/**
 * Option.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Menus;

use Sphp\Html\SimpleContainerTag as SimpleContainerTag;

/**
 * Class models an HTML &lt;option&gt; tag
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-09-28
 * @version 2.1.0
 * @link    http://www.w3schools.com/tags/tag_option.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Option extends SimpleContainerTag implements SelectMenuContentInterface {

	/**
	 * the tag name of the HTML component
	 */
	const TAG_NAME = "option";
	
	/**
	 * Constructs a new instance of the {@link Option} component.
	 *
	 * @param string $value value attribute
	 * @param string $content the content text of the option
	 * @param boolean $selected whether option is selected or not
	 * @link  http://www.w3schools.com/tags/att_option_value.asp value attribute
	 * @link  http://www.w3schools.com/tags/att_option_selected.asp selected attribute
	 */
	public function __construct($value = null, $content = null, $selected = false) {
		parent::__construct(self::TAG_NAME, $content);
		$this->setValue($value)
				->setSelected($selected);
	}

	/**
	 * Returns the value of the value attribute
	 *
	 * @return  string the value of the value attribute
	 * @link    http://www.w3schools.com/tags/att_option_value.asp value attribute
	 */
	public function getValue() {
		return $this->getAttr("value");
	}

	/**
	 * Sets the value of the value attribute
	 *
	 * @param  string $value the value of the value attribute
	 * @return self for PHP Method Chaining
	 * @link   http://www.w3schools.com/tags/att_option_value.asp value attribute
	 */
	public function setValue($value) {
		return $this->setAttr("value", $value);
	}

	/**
	 * Sets the option as selected or not
	 *
	 * @param  boolean $selected true if the option is selected, otherwise false
	 * @return self for PHP Method Chaining
	 * @link   http://www.w3schools.com/tags/att_option_selected.asp selected attribute
	 */
	public function setSelected($selected = true) {
		return $this->setAttr("selected", $selected);
	}

	/**
	 * Checks whether the option is selected or not
	 *
	 * @return boolean true if the option is selected, false otherwise
	 * @link   http://www.w3schools.com/tags/att_option_selected.asp selected attribute
	 */
	public function isSelected() {
		return $this->attrExists("selected") && $this->isEnabled();
	}

	/**
	 * Disables or enables the option object
	 *
	 * @param  boolean $enabled true if the option is enabled, otherwise false
	 * @return self for PHP Method Chaining
	 * @link   http://www.w3schools.com/tags/att_option_disabled.asp disabled attribute
	 */
	public function setEnabled($enabled = true) {
		return $this->setAttr("disabled", !$enabled);
	}
	
	/**
	 * Checks whether the option is enabled or not
	 * 
	 * @param  boolean true if the option is enabled, otherwise false
	 */
	public function isEnabled() {
		return !$this->attrExists("disabled");
	}

}