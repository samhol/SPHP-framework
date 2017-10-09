<?php

/**
 * IdentityAttribute.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Exceptions\ImmutableAttributeException;

/**
 * Description of IdentityAttribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-09-28
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class IdentityAttribute extends AbstractAttribute {

  /**
   * @var string 
   */
  private $value;

  /**
   * @var bool 
   */
  private $locked = false;

  /**
   * Constructs a new instance
   *
   * @param string $name the name of the attribute
   */
  public function __construct(string $name, $value = null) {
    parent::__construct($name, new Filters\AttributeValidator());
    if ($value !== null) {
      $this->set($value);
    }
  }

  public function clear() {
    if ($this->isLocked()) {
      throw new InvalidArgumentException();
    }
    $this->value = null;
  }

  public function getValue() {
    return $this->value;
  }

  public function isLocked(): bool {
    return $this->locked;
  }

  public function lock($value) {
    $this->set($value);
    $this->locked = true;
  }

  public function set($value) {
    if ($this->isLocked()) {
      throw new ImmutableAttributeException();
    }
    $this->value = $value;
    return $this;
  }

  public function identify(string $prefix = null, int $length = 16) {
    if (!$this->isLocked()) {
      if ($prefix === null) {
        $prefix = $this->getName();
      }
      $randLength = $length - mb_strlen($prefix);
      $storage = IdStorage::get($this->getName());
      $value = $storage->generateRandom($prefix, $randLength);
      $this->lock($value);
    }
    return $this->getValue();
  }

}
