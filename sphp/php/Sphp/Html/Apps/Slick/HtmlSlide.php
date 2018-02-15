<?php

/**
 * HtmlSlide.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Slick;


/**
 * Implements a slide for Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
