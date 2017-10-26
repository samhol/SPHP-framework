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
 * Description of IdentityAttribute
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
   * @param type $value
   */
  public function __construct(string $name, $value = null) {
    parent::__construct($name, Factory::instance()->getUtil(IdValidator::class));
    if ($value !== null) {
      $this->set($value);
    }
  }

  /**
   * 
   * @param  int $length
   * @return string
   */
  public function identify(int $length = 16): string {
    if (!$this->isLocked()) {
      $storage = IdStorage::get($this->getName());
      $value = $storage->generateRandom($length);
      $this->lock($value);
    }
    return $this->getValue();
  }

}
