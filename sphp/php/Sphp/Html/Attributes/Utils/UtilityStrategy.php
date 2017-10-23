<?php

/**
 * UtilityStrategy.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Utils;

use Zend\Di\Di;

/**
 * Description of InsertStrategy
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class UtilityStrategy {

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
    // $di->newInstance(\Sphp\Html\Attributes\Attribute::class);
    //$di->setInstanceManager($instanceManager);
    $this->di->instanceManager()->addAlias('class', ClassAttributeUtils::class);
    $this->di->instanceManager()->addAlias('style', PropertyAttributeUtils::class);
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

}