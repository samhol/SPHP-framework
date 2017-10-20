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
class UtilityStrategy {

  /**
   * @var AttributeValueValidatorInterface 
   */
  private $default;

  /**
   * @var AttributeValueValidatorInterface[] 
   */
  private $map = [];

  /**
   * 
   * @param AttributeValueValidatorInterface $validator
   */
  public function __construct(AttributeValueValidatorInterface $validator) {
    $this->default = $validator;
  }
  
  public function setUtilityFor() {
    
  }

  public function getUtilityFor($name): AttributeValueValidatorInterface {

  }

}
