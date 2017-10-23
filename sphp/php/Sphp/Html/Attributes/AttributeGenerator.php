<?php

/**
 * AttributeGenerator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

use Zend\Di\Di;

/**
 * Implements an attribute object generator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class AttributeGenerator {
  /**
   * attribute object type map as a (attribute name -> attribute object type) map
   *
   * @var string[]
   */
  //private $map = [];

  /**
   * @var AttributeGenerator
   */
  private static $instance;

  /**
   *
   * @var Di 
   */
  //private static $injector;

  /**
   * @var string 
   */
  //private $defaultType;

  /**
   * @var Di
   */
  private $di;

  //private static $c = 0;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    $this->di = new Di();
  }

  /**
   * 
   * @param  string $name
   * @return ClassAttribute
   */
  public function getClassAttribute(string $name = 'class'): ClassAttribute {
    return $this->createAttribute($name, ClassAttribute::class);
  }

  /**
   * 
   * @param  string $name
   * @return PropertyAttribute
   */
  public function createPropertyAttribute(string $name): PropertyAttribute {
    return $this->createAttribute($name, PropertyAttribute::class);
  }

  /**
   * 
   * @param  string $name
   * @param  string $type
   * @return AttributeInterface
   */
  public function createAttribute(string $name, string $type): AttributeInterface {
    return $this->di->newInstance($type, ['name' => $name]);
  }

  /**
   * Returns singleton instance of generator
   * 
   * @return AttributeGenerator singleton instance of generator
   */
  public static function instance(): AttributeGenerator {
    if (!isset(self::$instance)) {
      self::$instance = new static();
    }
    return self::$instance;
  }

}
