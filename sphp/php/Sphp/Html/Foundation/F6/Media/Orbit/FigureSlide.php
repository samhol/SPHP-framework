<?php

/**
 * FigureSlide.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\AbstractComponent as AbstractComponent;
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
   * the image component
   *
   * @var Img 
   */
  private $img;

  /**
   * the caption component
   *
   * @var FigCaption
   */
  private $caption;

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
    $this->img = $img;
    $this->img->cssClasses()->lock("float-center");
    if (!($caption instanceof FigCaption)) {
      $caption = new FigCaption($caption);
    }
    $this->caption = $caption;
    $this->caption->cssClasses()->lock("orbit-caption");
  }

  /**
   * {@inheritdoc}
   */
  public function __destruct() {
    unset($this->img, $this->caption);
    parent::__destruct();
  }

  /**
   * {@inheritdoc}
   */
  public function __clone() {
    $this->img = clone $this->img;
    $this->caption = clone $this->caption;
    parent::__clone();
  }

  /**
   * Returns the image component
   *
   * @return Img the image component
   */
  public function getImg() {
    return $this->img;
  }

  /**
   * Returns the caption component
   *
   * @return FigCaption the caption component
   */
  public function getCaption() {
    return $this->caption;
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return $this->img . $this->caption;
  }

}
