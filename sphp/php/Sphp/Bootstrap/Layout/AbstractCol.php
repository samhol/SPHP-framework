<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Layout;

/**
 * The AbstractCol class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractCol extends AbstractResponsiveComponent {

  public function __construct(array $settings = ['prefix' => 'col']) {
    parent::__construct('div', $settings);
    $this->default(null);
  }

  /**
   * 
   * @param  string|int $size
   * @return $this for a fluent interface
   */
  public function default($size) {
    $this->unsetDefault();
    if ($size === null) {
      $this->cssClasses()->add($this->prefix);
    } else {
      $this->cssClasses()->add("$this->prefix-$size");
    }
    return $this;
  }

  public function unsetDefault() {
    $regex = "/^(";
    if ($this->prefix !== null) {
      $regex .= "$this->prefix";
    }
    $s = array_filter($this->getSizes(), function ($size) {
      return $size !== 'auto';
    });
    $sizes = implode('|', $s);
    $regex .= "(-($sizes))?)$/";
    $this->cssClasses()->removePattern($regex);
    return $this;
  }

}
