<?php

/**
 * AbstractAttribute.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Attributes;

use Sphp\Stdlib\Strings;
use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;
use Sphp\Html\Attributes\Exceptions\InvalidAttributeException;

/**
 * An abstract implementation of an HTML attribute object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractAttribute implements MutableAttributeInterface {

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
   * @var boolean 
   */
  private $protected = false;

  /**
   * Constructs a new instance
   *
   * @param  string $name the name of the attribute
   * @throws InvalidAttributeException
   */
  public function __construct(string $name) {
    if (!Strings::match($name, '/^[a-zA-Z][\w:.-]*$/')) {
      throw new InvalidAttributeException("Malformed Attribute name '$name'");
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

  public function isProtected(): bool {
    return $this->protected;
  }

  public function protect($value) {
    if ($this->isProtected()) {
      throw new ImmutableAttributeException("Attribute '{$this->getName()}' is immutable");
    }
    $this->set($value);
    $this->protected = true;
    return $this;
  }

  public function getHtml(): string {
    $output = '';
    if ($this->isVisible()) {
      $output .= $this->getName();
      if (!$this->isEmpty()) {
        $value = $this->getValue();
        if (is_string($value)) {
          $value = preg_replace('/[\t\n\r]+/', ' ', $value);
          $output .= '="' . htmlspecialchars($value, \ENT_COMPAT | \ENT_DISALLOWED | \ENT_HTML5, 'utf-8', false) . '"';
        } else {
          $output .= '="' . $value . '"';
        }
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
    return $this->required || $this->isProtected();
  }

  public function isVisible(): bool {
    return $this->isDemanded() || ($this->getValue() !== false && $this->getValue() !== null);
  }

  public function isEmpty(): bool {
    $val = $this->getValue();
    return is_bool($val) || $val === null || $val === '';
  }

}

