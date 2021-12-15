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
 * Class LazyVideo
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @link    https://apoorv.pro/lozad.js/ Lozad.js
 * @filesource
 */
class LazyVideo extends Video {

  public function __construct() {
    parent::__construct();
    $this->cssClasses()->protectValue('lozad');
  }

  public function addSource(string $src, string $type = null): Source {
    $source = new LazySource($src, $type);
    $this->addMultimediaSource($source);
    return $source;
  }

  public function setPoster(string $poster = null) {
    $this->attributes()->setAttribute('data-poster', $poster);
    return $this;
  }

}
