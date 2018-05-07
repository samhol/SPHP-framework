<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

use Sphp\Html\AbstractComponent;

/**
 * Implements an HTML &lt;figure&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_figure.asp w3schools API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Figure extends AbstractComponent implements ImgInterface {

  /**
   * @var Img 
   */
  private $img;

  /**
   * @var FigCaption
   */
  private $caption;

  /**
   * Constructor
   *
   * @param  string|Img $img the image path or the image component
   * @param  mixed|FigCaption $caption the caption content or the caption component
   */
  public function __construct($img = null, $caption = null) {
    parent::__construct('figure');
    if (!($img instanceof Img)) {
      $img = new Img((string) $img);
    }
    $this->img = $img;
    if (!($caption instanceof FigCaption)) {
      $caption = new FigCaption($caption);
    }
    $this->caption = $caption;
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
  public function setCaption(FigCaption $caption) {
    $this->caption = $caption;
    return $this;
  }

  /**
   * Returns the caption component
   *
   * @return FigCaption the caption component
   */
  public function getCaption() {
    return $this->caption;
  }

  public function getAlt(): string {
    return $this->img->getAlt();
  }

  public function getSrc(): string {
    return $this->img->getSrc();
  }

  public function setAlt(string $alt) {
    $this->img->setAlt($alt);
    return $this;
  }

  public function setSrc(string $src) {
    $this->img->setSrc($src);
    return $this;
  }

  public function useMap($map) {
    $this->img->useMap($map);
    return $this;
  }

  public function setLazy(bool $lazy = true) {
    $this->img->setLazy($lazy);
    return $this;
  }

  public function isLazy(): bool {
    return $this->img->isLazy();
  }

  public function contentToString(): string {
    return $this->img . $this->caption;
  }

  public function setWidth(int $width) {
    $this->img->setWidth($width);
    return $this;
  }

  public function setHeight(int $height) {
    $this->img->setHeight($height);
    return $this;
  }

  public function getHeight(): int {
    return $this->img->getHeight();
  }

  public function getWidth(): int {
    return $this->img->getWidth();
  }

  public function hasHeight(): bool {
    return $this->img->hasHeight();
  }

  public function hasWidth(): bool {
    return $this->img->hasWidth();
  }

  public function unsetHeight() {
    $this->img->unsetHeight();
    return $this;
  }

  public function unsetWidth() {
    $this->img->unsetWidth();
    return $this;
  }

}
