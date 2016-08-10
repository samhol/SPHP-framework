<?php

/**
 * EmailInput.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Class models an HTML &lt;input type="email"&gt; tag
 *
 *
 * {@inheritdoc}
 *
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @since   2011-09-26
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools HTML
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class EmailInput extends TextualInput {

	/**
	 * Constructs a new instance
	 *
	 *  **Preconditions:**   <var>0 < $size <= $maxlength</var>
	 *  **Postconditions:**  <var>attrLocked("type", "text")</var>
	 *
	 * @param  string|null $name the value of the  name attribute
	 * @param  string|null $value the value of the  value attribute
	 * @param  int|null $maxlength the value of the  maxlength attribute
	 * @param  int|null $size the value of the  size attribute
	 * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
	 * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
	 * @link   http://www.w3schools.com/tags/att_input_size.asp size attribute
	 * @link   http://www.w3schools.com/tags/att_input_maxlength.asp maxlength attribute
	 */
	public function __construct($name = null, $value = null, $maxlength = null, $size = null) {
		parent::__construct("email", $name, $value, $maxlength, $size);
	}
  

  /**
   * Sets whether to accept multiple email addresses or not
   *
   * @param  boolean $multiple whether to accept multiple email addresses or not
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_input_multiple.asp multiple attribute
   */
  public function multiple($multiple = true) {
    $this->attrs()->set("multiple", (bool)$multiple);
    return $this;
  }

}
