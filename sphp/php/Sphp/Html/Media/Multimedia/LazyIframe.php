<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

/**
 * Class LazyIframe
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LazyIframe extends Iframe {

  public function __construct(string $src) {
    parent::__construct($src);
    $this->attributes()->classes()->protectValue('lazy-hidden', 'lazy-loaded');
  }

  /**
   * Sets the path to the image source (The URL of the image file)
   * 
   * @param  string $src the path to the image source (The URL of the image file)
   * @return $this for a fluent interface
   */
  public function setSrc(string $src) {
    $this->attributes()->setAttribute('data-src', $src);
    return $this;
  }

  /**
   * Returns the path to the image source (The URL of the image file)
   *
   * @return string the path to the image source (The URL of the image file)
   */
  public function getSrc(): string {
    return (string) $this->attributes()->getValue('data-src');
  }

}
