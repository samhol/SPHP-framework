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
   * @var AttributeGenerator
   */
  private static $instance;

  /**
   * @var AttributeValueValidatorInterface 
   */
  private $default;

  /**
   * @var Di
   */
  private $di;

  /**
   * 
   * @param AttributeValueValidatorInterface $validator
   */
  public function __construct(AttributeValueValidatorInterface $validator = null) {
    $this->default = $validator;
    $this->di = new Di();
    $this->di->instanceManager()->addAlias('class-attribute', ClassAttribute::class, ['name' => 'class']);
    // $di->newInstance(\Sphp\Html\Attributes\Attribute::class);
    //$di->setInstanceManager($instanceManager);
    // \Zend\Di\Display\Console::export($this->di);
  }

  public function setUtilityFor($name) {
    // return $di->($name);
    // $this->di->
  }

  /**
   * 
   * @param  string $name
   * @return AttributeValueValidatorInterface
   */
  public function getUtilityFor(string $name) {
    return $this->di->get($name);
  }

  public function forceAttributeType(string $name, string $type) {
    $this->di->instanceManager()->addAlias($name, $type);
    return $this;
  }

  /**
   * 
   * @param  string $name
   * @return ClassAttribute
   */
  public function getClassAttribute(): ClassAttribute {
    return  $this->di->newInstance('class-attribute');
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
  public function createAttribute(string $name, string $type = Attribute::class): AttributeInterface {
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
