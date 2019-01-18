<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Media\Img;
use Sphp\Html\Media\FigCaption;

/**
 * Implements a figure slide for Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FigureSlide extends AbstractComponent implements Slide {

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
   * Constructor
   *
   * @param  string|URL|Img $img the image path or the image component
   * @param  mixed|FigCaption $caption the caption content or the caption component
   */
  public function __construct($img, $caption = null) {
    parent::__construct('li');
    $this->cssClasses()
            ->protectValue('orbit-slide');
    if (!($img instanceof Img)) {
      $img = new Img($img);
    }
    $this->img = $img;
    $this->img->cssClasses()
            ->protectValue('orbit-image');
    if (!($caption instanceof FigCaption)) {
      $caption = new FigCaption($caption);
    }
    $this->caption = $caption;
    $this->caption->cssClasses()
            ->protectValue('orbit-caption');
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
  public function getImg(): Img {
    return $this->img;
  }

  /**
   * Returns the caption component
   *
   * @return FigCaption the caption component
   */
  public function getCaption(): FigCaption {
    return $this->caption;
  }

  public function contentToString(): string {
    return $this->img . $this->caption;
  }

}
