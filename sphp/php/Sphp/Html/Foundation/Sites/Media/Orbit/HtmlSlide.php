<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\AbstractContainerTag;

/**
 * Implements a slide for Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class HtmlSlide extends AbstractContainerTag implements Slide {

  use ActivationTrait;

  /**
   * Constructor
   *
   * @param  mixed $content the content of the slide
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content = null) {
    parent::__construct('li');
    if ($content !== null) {
      $this->append($content);
    }
    $this->cssClasses()->protectValue('orbit-slide');
  }

}
