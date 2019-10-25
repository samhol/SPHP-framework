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
use Sphp\Html\Media\Figure;

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
class FigureSlide extends AbstractSlide {


  /**
   * the caption component
   *
   * @var Figure
   */
  private $figure;

  /**
   * Constructor
   *
   * @param  Figure $figure the caption content or the caption component
   */
  public function __construct(Figure $figure) {
    parent::__construct();
    $this->figure = $figure->addCssClass('orbit-figure');
    $this->figure->getImg()->addCssClass('orbit-image');
    $this->figure->getCaption()->cssClasses()
            ->protectValue('orbit-caption');
  }

  public function __destruct() {
    unset($this->figure);
    parent::__destruct();
  }

  public function __clone() {
    $this->figure = clone $this->figure;
    parent::__clone();
  }

  /**
   * Returns the image component
   *
   * @return Figure the image component
   */
  public function getFigure(): Figure {
    return $this->figure;
  }

  public function contentToString(): string {
    return $this->figure->getHtml();
  }

  /**
   * 
   * @param  string $img
   * @param  string $caption
   * @return FigureSlide
   */
  public static function create(string $img, string $caption): FigureSlide {
    $fig = new Figure($img, $caption);
    return new static($fig);
  }

}
