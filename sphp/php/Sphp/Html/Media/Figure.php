<?php

/**
 * Figure.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\AbstractComponent;
use Sphp\Core\Types\URL;

/**
 * Class Models an HTML &lt;figure&gt; tag
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-02-15
 * @link    http://www.w3schools.com/tags/tag_figure.asp w3schools API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Figure extends AbstractComponent implements ImgInterface {

  /**
   *
   * @var Img 
   */
  private $img;

  /**
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
    parent::__construct('figure'); 
    if (!($img instanceof Img)) {
      $img = new Img($img);
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
   * @return self for PHP Method Chaining
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
  public function getImg() {
    return $this->img;
  }

  /**
   * Sets the caption component
   *
   * @param  FigCaption $caption the caption content or the caption component
   * @return self for PHP Method Chaining
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

  public function getAlt() {
    return $this->img->getAlt();
  }

  public function getHeight() {
    return $this->img->getHeight();
  }

  public function getSize() {
    return $this->img->getSize();
  }

  public function getSrc() {
    return $this->img->getSrc();
  }

  public function getWidth() {
    return $this->img->getWidth();
  }

  public function setAlt($alt) {
    $this->img->setAlt($alt);
    return $this;
  }

  public function setHeight($height) {
    $this->img->setHeight($height);
    return $this;
  }

  public function setSize(Size $size) {
    $this->img->setSize($size);
    return $this;
  }

  public function setSrc($src) {
    $this->img->setSrc($src);
    return $this;
  }

  public function setWidth($width) {
    $this->img->setWidth($width);
    return $this;
  }

  public function useMap($map) {
    $this->img->useMap($map);
    return $this;
  }

  public function setLazy($lazy = true) {
    $this->img->setLazy($lazy);
    return $this;
  }

  public function isLazy() {
    return $this->img->isLazy();
  }

  public function contentToString() {
    return $this->img . $this->caption;
  }

}
