<?php

/**
 * FigureSlide.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\Media\Img as Img;
use Sphp\Html\Media\FigCaption as FigCaption;

/**
 * Class implements a slide for Foundation {@link Orbit} components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-04-07
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FigureSlide extends AbstractSlide {

  /**
   * Constructs a new instance
   *
   * @param  string|URL|Img $img the image path or the image component
   * @param  mixed|FigCaption $caption the caption content or the caption component
   */
  public function __construct($img = null, $caption = null) {
    parent::__construct();
    if (!($img instanceof Img)) {
      $img = new Img($img);
    }
    if (!($caption instanceof FigCaption)) {
      $caption = new FigCaption($caption);
    }
    $caption->cssClasses()->lock("orbit-caption");
    $this->content()->set("img", $img);
    $this->content()->set("caption", $caption);
  }

  /**
   * Returns the image component
   *
   * @return Img the image component
   */
  public function getImg() {
    $this->content()->get("img");
    return $this;
  }

  /**
   * Returns the caption component
   *
   * @return FigCaption the caption component
   */
  public function getCaption() {
    $this->content()->get("caption");
    return $this;
  }

}
