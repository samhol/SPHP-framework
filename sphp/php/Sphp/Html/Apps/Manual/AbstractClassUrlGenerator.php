<?php

/**
 * AbstractClassPathParser.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use ReflectionClass;

/**
 * PHP class link generator pointing to an exising ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractClassUrlGenerator extends UrlGenerator implements ClassUrlGeneratorInterface {

  /**
   *
   * @var ReflectionClass
   */
  private $ref;

  /**
   * 
   * @param string|object $class
   * @param string $root
   */
  public function __construct($class, $root = '') {
    parent::__construct($root);
    $this->ref = new ReflectionClass($class);
  }

  public function setClass($class) {
    $this->ref = new ReflectionClass($class);
    return $this;
  }

  /**
   * 
   * @return ReflectionClass reflector to the linked class
   */
  protected function reflector() {
    return $this->ref;
  }

}
