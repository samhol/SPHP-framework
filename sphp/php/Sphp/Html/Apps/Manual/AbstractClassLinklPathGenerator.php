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
 abstract class AbstractClassLinklPathGenerator extends ApiLinkPathGenerator implements ClassLinkPathGenerator {

  /**
   *
   * @var ReflectionClass
   */
  private $ref;

  /**
   * 
   * @param string|object $class
   * @param ApiLinkPathGeneratorInterface $gen
   */
  public function __construct($class, $root = '', $target = 'blank') {
    parent::__construct($root, $target);
    $this->ref = new ReflectionClass($class);
  }

  public function setClass($class) {
    $this->ref = new ReflectionClass($class);
    return $this;
  }

  /**
   * 
   * @return ReflectionClass
   */
  protected function reflector() {
    return $this->ref;
  }

}
