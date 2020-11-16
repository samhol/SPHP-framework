<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Network\Headers;

/**
 * Abstract base class for a single header
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class GenericHeader extends AbstractHeader {

  /**
   * @var mixed 
   */
  private $value;

  public function __construct(string $name, $value) {
    parent::__construct($name);
    $this->setValue($value);
  }

  public function getValue() {
    return $this->value;
  }

  /**
   * 
   * @param  mixed $value
   * @return $this for a fluent interface
   */
  public function setValue($value) {
    $this->value = $value;
    return $this;
  }

}
