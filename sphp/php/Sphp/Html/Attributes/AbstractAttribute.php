<?php

/**
 * AbstractAttribute.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Attributes;

use Sphp\Core\Types\Strings;

/**
 * An abstract implementation of an HTML attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-06-12
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractAttribute implements AttributeInterface {

  /**
   * the name of the attribute
   *
   * @var string 
   */
  private $name;

  /**
   * whether the attribute is required or not
   *
   * @var boolean
   */
  private $required = false;


  /**
   * Constructs a new instance
   *
   * @param string $name the name of the attribute
   */
  public function __construct($name) {
    $this->name = $name;
  }

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->name, $this->required);
  }

  /**
   * Returns the instance of the {@link self} object as a string
   *
   * @return string the object as a string
   */
  public function __toString() {
    $output = '';
    $value = $this->getValue();
    if ($value !== false) {
      $output .= $this->getName();
      if ($value !== true && !Strings::isEmpty($value)) {
        $strVal = Strings::toString($value);
        $output .= '="' . htmlspecialchars($strVal, \ENT_COMPAT | \ENT_DISALLOWED | \ENT_HTML5, 'utf-8', false) . '"';
      }
    }
    return $output;
  }

  /**
   * Returns the name of the attribute 
   * 
   * @return string the name of the attribute
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets the attribute as required
   *  
   * **A required attribute cannot be removed** but its value is still mutable.
   * 
   * @return self for PHP Method Chaining
   */
  public function demand() {
    $this->required = true;
    return $this;
  }

  /**
   * Checks whether the attribute is required or not
   * 
   * **Note:** a required attribute either has locked value or the attribute 
   * name is required.
   *
   * @return boolean true if the attribute is required and false otherwise
   */
  public function isDemanded() {
    return $this->required || $this->isLocked();
  }

  /**
   * Checks whether the attribute is visible or not
   * 
   * **Note:** an attribute is visible if it has locked value or the attribute 
   * name is required or the attribute value is not boolean (false).
   * 
   * @return boolean true if the attribute is visible and false otherwise
   */
  public function isVisible() {
    return $this->isDemanded() || $this->getValue() !== false;
  }

}
