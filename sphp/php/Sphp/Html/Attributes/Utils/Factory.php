<?php

/**
 * UtilityStrategy.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Utils;

/**
 * Description of InsertStrategy
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Factory {

  /**
   * @var Factory 
   */
  private static $instance;

  /**
   * @var mixed[]
   */
  private $utils;

  public function setUtility($instance) {
    $name = get_class($instance);
    $this->utils[$name] = $instance;
    return $this;
  }

  /**
   * 
   * @param  string $name
   * @return AttributeValueValidatorInterface
   */
  public function getUtil(string $name) {
    if (isset($this->utils[$name])) {
      return $this->utils[$name];
    }
    throw new \Sphp\Exceptions\OutOfBoundsException;
  }

  public static function instance(): Factory {
    if (!isset(self::$instance)) {
      static::$instance = new static();
    }
    return static::$instance;
  }

}

