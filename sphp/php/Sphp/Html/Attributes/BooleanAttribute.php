<?php

/**
 * BooleanAttribute.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

/**
 * Description of BooleanAttribute
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-10-24
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BooleanAttribute extends Attribute {

  /**
   * @var bool
   */
  private $val;

  public function __construct(string $name, $value = true) {
    parent::__construct($name);
    $this->set($value);
  }

  public function set($value) {
    parent::set((bool)$value);
  }

}
