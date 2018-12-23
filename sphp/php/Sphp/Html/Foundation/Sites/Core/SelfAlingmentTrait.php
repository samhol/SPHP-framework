<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

/**
 * Implements an alignment manger for Flexbox components
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @link    http://foundation.zurb.com/grid.html Foundation grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
trait SelfAlingmentTrait {

  /**
   * @var string[] 
   */
  private static $self = [
      'align-self-top',
      'align-self-middle',
      'align-self-bottom',
      'align-self-stretch',
  ];

  /**
   * 
   * @param  string|null $alignment
   * @return $this for a fluent interface
   */
  public function setSelfAlignment(string $alignment = null) {
    $this->setOneOf(self::$self, $alignment);
    return $this;
  }

}
