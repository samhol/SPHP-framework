<?php

/**
 * FigureSlide.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Media\Img;
use Sphp\Html\Media\FigCaption;

/**
 * Implements a figure slide for Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FigureSlide extends AbstractComponent implements SlideInterface {

  use ActivationTrait;

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
    parent::__construct('li');
    $this->cssClasses()
            ->lock('orbit-slide fig-wrapper');
    if (!($img instanceof Img)) {
      $img = new Img($img);
    }
    $this->img = $img;
    $this->img->cssClasses()
            ->lock('float-center');
    if (!($caption instanceof FigCaption)) {
      $caption = new FigCaption($caption);
    }
    $this->caption = $caption;
    $this->caption->cssClasses()
            ->lock('orbit-caption');
  }

  public function __destruct() {
    unset($this->img, $this->caption);
    parent::__destruct();
  }

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

  public function contentToString() {
    return $this->img . $this->caption;
  }

}
