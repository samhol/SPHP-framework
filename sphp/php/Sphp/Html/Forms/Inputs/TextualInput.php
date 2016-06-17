<?php

/**
 * TextualInput.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Class models an HTML &lt;input type="text|password|email|tel| ...))"&gt; tag
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
class TextualInput extends Input {

  /**
   * Constructs a new instance
   *
   * @Preconditions  `0 &lt; $size &lt;= $maxlength`
   *
   * @param  string $type the value of the type attribute
   * @param  string $name the value of the  name attribute
   * @param  string $value the value of the  value attribute
   * @param  int $maxlength the value of the  maxlength attribute
   * @param  int $size the value of the  size attribute
   * @link   http://www.w3schools.com/tags/att_input_type.asp type attribute
   * @link   http://www.w3schools.com/tags/att_input_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_input_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_input_maxlength.asp maxlength attribute
   * @link   http://www.w3schools.com/tags/att_input_size.asp size attribute
   */
  function __construct($type = "text", $name = null, $value = null, $maxlength = null, $size = null) {
    parent::__construct($type, $name, $value);
    if ($maxlength > 0) {
      $this->setMaxlength($maxlength);
    }
    if ($size > 0) {
      $this->setSize($size);
    }
  }

  /**
   * Returns the value of the size attribute
   *
   * @return int the value of the size attribute
   * @link   http://www.w3schools.com/tags/att_input_size.asp size attribute
   */
  public function getSize() {
    return $this->getAttr("size");
  }

  /**
   * Sets the value of the size attribute
   *
   *  **Preconditions:** <var>$size > 0</var>
   *
   * @param  int $size the value of the size attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_input_size.asp size attribute
   */
  public function setSize($size) {
    return $this->setAttr("size", $size);
  }

  /**
   * Returns the value of the maxlength attribute
   *
   * @return int the value of the maxlength attribute
   * @link   http://www.w3schools.com/tags/att_input_maxlength.asp maxlength attribute
   */
  public function getMaxlength() {
    return $this->getAttr("maxlength");
  }

  /**
   * Sets the value of the maxlength attribute
   *
   *  **Preconditions:** <var>$maxlength > 0</var>
   *
   * @param  int $maxlength the value of the maxlength attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_input_maxlength.asp maxlength attribute
   */
  public function setMaxlength($maxlength) {
    return $this->setAttr("maxlength", $maxlength);
  }

  /**
   * Sets the value of the placeholder attribute
   *
   * The placeholder attribute specifies a short hint that describes the expected value of an input field
   *  (e.g. a sample value or a short description of the expected format). The short hint is displayed in
   * the input field before the user enters a value.
   *
   * **Note:** The placeholder attribute works with the following &lt;input&gt; types:
   *  <var>text, search, url, tel, email, and password</var>.
   *
   * @param  string $placeholder the value of the placeholder attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_input_placeholder.asp placeholder attribute
   */
  public function setPlaceholder($placeholder) {
    return $this->setAttr("placeholder", $placeholder);
  }

  /**
   * Sets the autocomplete attribute's value on or off
   *
   * The autocomplete attribute specifies whether or not an input field should have autocomplete enabled.
   *
   * Autocomplete allows the browser to predict the value. When a user starts to type in a field,
   * the browser should display options to fill in the field, based on earlier typed values.
   *
   * **Note:** The autocomplete attribute works with the following &lt;input&gt; types:
   *   <var>text, search, url, tel, email, password, datepickers, range, and color</var>.
   *
   * @param  boolean $allow (allow the browser to predict the value)
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_input_autocomplete.asp autocomplete attribute
   */
  public function autocomplete($allow = true) {
    return $this->etAttr("autocomplete", $allow ? "on" : "off");
  }

  /**
   * Sets the autocomplete attribute's value on or off
   *
   * **Note:** The pattern attribute works with the following input types: text, search, url, tel, email, and password.
   * 
   * **Tip:** Use the global title attribute to describe the pattern to help the user.
   *
   * @param  string $pattern a regular expression pattern that the component's 
   *         value is checked against
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
   */
  public function setValidationPattern($pattern) {
    return $this->setAttr("pattern", $pattern);
  }

  /**
   * Returns the validation pattern string
   *
   * @return  string the regular expression pattern that the component's 
   *         value is checked against
   * @link   http://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
   */
  public function getValidationPattern() {
    return $this->getAttr("pattern");
  }

  /**
   * Checks if a value validation pattern is set fot the component
   *
   * @return boolean true if a value validation pattern is set fot the 
   *         component, othewise false
   * @link   http://www.w3schools.com/tags/att_input_pattern.asp pattern attribute
   */
  public function hasValidationPattern() {
    return $this->attrExists("pattern");
  }

}
