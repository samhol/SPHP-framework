<?php

/**
 * IdentityAttribute.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Sphp\Html\Attributes\Utils\IdStorage;
use Sphp\Html\Attributes\Utils\IdValidator;
use Sphp\Html\Attributes\Utils\Factory;

/**
 * Implements a unique id for an HTML element
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class IdentityAttribute extends Attribute {

  /**
   * Constructs a new instance
   *
   * @param string $name the name of the attribute
   * @param scalar $value
   */
  public function __construct(string $name, $value = null) {
    parent::__construct($name, $value, Factory::instance()->getUtil(IdValidator::class));
  }

  /**
   * Creates an unique identity value
   *
   * **Notes:**
   *
   * HTML id attribute is unique to every HTML-element. Therefore given id is checked for its uniqueness.
   * 
   * @param  int $length the length of the identity value
   * @return string the identifier
   * @link   http://www.w3schools.com/tags/att_global_id.asp default id attribute
   */
  public function identify(int $length = 16): string {
    if (!$this->isProtected()) {
      $storage = IdStorage::get($this->getName());
      $value = $storage->generateRandom($length);
      $this->protect($value);
    }
    return $this->getValue();
  }

}
