<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

/**
 * Class LazyImage
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LazyImage extends Img implements LazyMediaSource {

  public function __construct(string $src, string $alt = '') {
    parent::__construct($src, $alt);
    $this->attributes()->classes()->protectValue('lazy-hidden', 'lazy-loaded');
  }

  public function setSrc(string $src = null) {
    $this->setAttribute('data-src', $src);
    return $this;
  }

  public function getSrc(): string {
    return (string) $this->attributes()->getValue('data-src');
  }

}
