<?php

/**
 * NonEmptyInputTag.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\ContainerTag as ContainerTag;

/**
 * Class Models an HTML &lt;button&gt; tag
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-02-06
 * @version 1.1.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class NonEmptyInputTag extends ContainerTag implements InputInterface {

  use InputTrait;

  /**
   * Constructs a new instance
   *
   * @param  string $tagName the name of the tag component
   * @param  scalar[] $attrs the attribute name and value pairs to set
   * @param  mixed $content the content of the component
   */
  public function __construct($tagName, array $attrs = [], $content = null) {
    parent::__construct($tagName, $content);
    if (count($attrs) > 0) {
      $this->setAttrs($attrs);
    }
  }

  /**
   * Returns the value of the value attribute
   *
   * @return string the value of the value attribute
   * @return self for PHP Method Chaining
   */
  public function getValue() {
    return $this->getAttr("value");
  }

  /**
   * Sets the value of the value attribute
   *
   * @param  string $value the value of the value attribute
   * @return self for PHP Method Chaining
   */
  public function setValue($value) {
    return $this->setAttr("value", $value);
  }

  /**
   * Sets whether the input must have a value or not before form submission
   * 
   * @param  boolean $required true if the input must have a value before form 
   *         submission, otherwise false
   * @return self for PHP Method Chaining
   */
  public function setRequired($required = true) {
    return $this->setAttr("required", $required);
  }

  /**
   * Checks whether the input must have a value before form submission
   *
   * @return boolean true if the input must have a value before form submission, 
   *         otherwise false
   */
  public function isRequired() {
    return $this->attrExists("required");
  }

}
