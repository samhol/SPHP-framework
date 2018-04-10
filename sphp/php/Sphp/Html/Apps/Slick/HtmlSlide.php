<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Slick;


/**
 * Implements a slide for Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class HtmlSlide extends \Sphp\Html\Div implements Slide {


  /**
   * Constructs a new instance
   *
   * @param  mixed $content the content of the slide
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content = null) {
    parent::__construct();
    if ($content !== null) {
      $this->append($content);
    }
  }

}
