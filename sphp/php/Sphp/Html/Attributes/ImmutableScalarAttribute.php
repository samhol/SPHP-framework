<?php

/**
 * ImmutableScalarAttribute.php (UTF-8)
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
class ImmutableScalarAttribute implements AttributeInterface {

  /**
   * the name of the attribute
   *
   * @var string 
   */
  private $name;

  /**
   * the name of the attribute
   *
   * @var scalar 
   */
  private $value;

  /**
   * Constructs a new instance
   *
   * @param  string $name the name of the attribute
   * @throws AttributeException
   */
  public function __construct(string $name, $value) {
    if (!Strings::match($name, '/^[a-zA-Z][\w:.-]*$/')) {
      throw new AttributeException("Malformed Attribute name '$name'");
    }
    $this->name = $name;
    $this->value = $value;
  }

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->name, $this->value);
  }

  public function __toString(): string {
    return $this->getHtml();
  }

  public function getHtml(): string {
    $output = '';
    if ($this->isVisible()) {
      $output .= $this->getName();
      if (!$this->isEmpty()) {
        $value = preg_replace('/[\t\n\r]+/', ' ', $this->value);
        $output .= '="' . htmlspecialchars($value, \ENT_COMPAT | \ENT_DISALLOWED | \ENT_HTML5, 'utf-8', false) . '"';
      }
    }
    return $output;
  }

  public function getName(): string {
    return $this->name;
  }

  public function isDemanded(): bool {
    return $this->required || $this->isProtected();
  }

  public function isVisible(): bool {
    return $this->getValue() !== false && $this->getValue() !== null;
  }

  public function isEmpty(): bool {
    $val = $this->getValue();
    return is_bool($val) || $val === null || $val === '';
  }

  public function getValue() {
    return $this->value;
  }

}
