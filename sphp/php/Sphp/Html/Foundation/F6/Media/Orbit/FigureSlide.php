<?php

/**
 * FigureSlide.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\AbstractContainerComponent as AbstractComponent;
use Sphp\Html\Media\Img as Img;
use Sphp\Html\Media\FigCaption as FigCaption;

/**
 * Class implements a slide for Foundation {@link Orbit} components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FigureSlide extends AbstractComponent implements SlideInterface {

  /**
   * Constructs a new instance
   *
   * @param  string|URL|Img $img the image path or the image component
   * @param  mixed|FigCaption $caption the caption content or the caption component
   */
  public function __construct($img = null, $caption = null) {
    parent::__construct(self::TAG_NAME);
    $this->cssClasses()->lock("orbit-slide fig-wrapper");
    if (!($img instanceof Img)) {
      $img = new Img($img);
    }
    $img->cssClasses()->lock("float-center");
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
