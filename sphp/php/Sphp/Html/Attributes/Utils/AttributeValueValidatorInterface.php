<?php

/**
 * AttributeValueValidatorInterface.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Utils;

/**
 * Description of AttributeValueValidator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface AttributeValueValidatorInterface {

  /**
   * Checks whether the attribute value is valid
   * 
   * @param  mixed $value
   * @return boolean (the attribute value is valid)
   */
  public function __invoke($value): bool;
  
  
}
