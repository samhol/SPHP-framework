<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Pictures;

use Sphp\Html\AbstractComponent;

/**
 * Implementation of an HTML figure tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_figure.asp w3schools API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Figure extends AbstractComponent {

  /**
   * @var Img 
   */
  private Img $img;

  /**
   * @var FigCaption|null
   */
  private ?FigCaption $caption = null;

  /**
   * Constructor
   *
   * @param  string|Img $img the image path or the image component
   * @param  mixed|FigCaption $caption the caption content or the caption component
   */
  public function __construct(string|Img|null $img = null, mixed $caption = null) {
    parent::__construct('figure');
    if (!($img instanceof Img)) {
      $img = new Img((string) $img);
    }
    $this->setImg($img);
    if ($caption !== null && !$caption instanceof FigCaption) {
      $caption = new FigCaption($caption);
    }
    $this->setCaption($caption);
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->img, $this->caption);
  }

  public function __clone() {
    $this->img = clone $this->img;
    $this->caption = clone $this->caption;
  }

  /**
   * Sets the image component
   *
   * @param  Img $img the image path or the image component
   * @return $this for a fluent interface
   */
  public function setImg(Img $img) {
    $this->img = $img;
    return $this;
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
   * Sets the caption component
   *
   * @param  FigCaption $caption the caption content or the caption component
   * @return $this for a fluent interface
   */
  public function setCaption(FigCaption $caption = null) {
    $this->caption = $caption;
    return $this;
  }

  /**
   * Returns the caption component
   *
   * @return FigCaption|null the caption component
   */
  public function getCaption(): ?FigCaption {
    return $this->caption;
  }

  public function contentToString(): string {
    return $this->img . $this->caption;
  }

}
