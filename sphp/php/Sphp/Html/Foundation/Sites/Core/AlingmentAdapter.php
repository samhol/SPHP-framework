<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Stdlib\Arrays;

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
class AlingmentAdapter extends AbstractLayoutManager {

  /**
   * @var string[] 
   */
  private static $vertical = [
      'align-top',
      'align-middle',
      'align-bottom',
      'align-stretch',
  ];

  /**
   * @var string[] 
   */
  private static $horizontal = [
      'align-right',
      'align-center',
      'align-justify',
      'align-spaced'
  ];

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
  public function setVerticalAlignment(string $alignment = null) {
    $this->setOneOf(self::$vertical, $alignment);
    return $this;
  }

  /**
   * 
   * @param  string|null $alignment
   * @return $this for a fluent interface
   */
  public function setHorizontalAlignment(string $alignment = null) {
    $this->setOneOf(self::$horizontal, $alignment);
    return $this;
  }

  /**
   * 
   * @param  string|null $alignment
   * @return $this for a fluent interface
   */
  public function setSelfAlignment(string $alignment = null) {
    $this->setOneOf(self::$self, $alignment);
    return $this;
  }

  public function setLayouts(...$layouts) {
    $flatten = Arrays::flatten($layouts);
    foreach ($flatten as $value) {
      if (in_array($value, self::$vertical)) {
        $this->setVerticalAlignment($value);
      } else if (in_array($value, self::$horizontal)) {
        $this->setVerticalAlignment($value);
      } else if (in_array($value, self::$self)) {
        $this->setSelfAlignment($value);
      }
    }
    return $this;
  }

  /**
   * 
   * @return $this for a fluent interface
   */
  public function unsetLayouts() {
    $this
            ->setVerticalAlignment()
            ->setHorizontalAlignment()
            ->setSelfAlignment();
    return $this;
  }

}
