<?php

/**
 * AbstractAttribute.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Attributes;

use Sphp\Stdlib\Strings;
use Sphp\Html\Attributes\Exceptions\AttributeException;

/**
 * An abstract implementation of an HTML attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
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
   * @param  string $name the name of the attribute
   * @throws AttributeException
   */
  public function __construct(string $name) {
    if (!Strings::match($name, '/^[a-zA-Z][\w:.-]*$/')) {
      throw new AttributeException("Malformed Attribute name '$name'");
    }
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

  public function __toString(): string {
    return $this->getHtml();
  }

  public function getHtml(): string {
    $output = '';
    $value = $this->getValue();
    if ($value !== false) {
      $output .= $this->getName();
      if ($value !== true) {
        $strVal = Strings::toString($value);
        $output .= '="' . htmlspecialchars($strVal, \ENT_COMPAT | \ENT_DISALLOWED | \ENT_HTML5, 'utf-8', false) . '"';
      }
    }
    return $output;
  }

  public function getName(): string {
    return $this->name;
  }

  public function demand() {
    $this->required = true;
    return $this;
  }

  public function isDemanded(): bool {
    return $this->required || $this->isLocked();
  }

  public function isVisible(): bool {
    return $this->isDemanded() || $this->getValue() !== false;
  }

  public function isEmpty(): bool {
    $val = $this->getValue();
    return is_bool($val) || $val === null || $val === '';
  }

}
