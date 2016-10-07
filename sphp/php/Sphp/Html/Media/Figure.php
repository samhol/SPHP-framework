<?php

/**
 * Figure.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\AbstractComponent;
use Sphp\Net\URL;

/**
 * Class Models an HTML &lt;figure&gt; tag
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-02-15
 * @link    http://www.w3schools.com/tags/tag_figure.asp w3schools API link
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

  /**
   * {@inheritdoc}
   */
  public function __destruct() {
    parent::__destruct();
    unset($this->img, $this->caption);
  }

  /**
   * {@inheritdoc}
   */
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

  /**
   * {@inheritdoc}
   */
  public function getAlt() {
    return $this->img->getAlt();
  }

  /**
   * {@inheritdoc}
   */
  public function getHeight() {
    return $this->img->getHeight();
  }

  /**
   * {@inheritdoc}
   */
  public function getSize() {
    return $this->img->getSize();
  }

  /**
   * {@inheritdoc}
   */
  public function getSrc() {
    return $this->img->getSrc();
  }

  /**
   * {@inheritdoc}
   */
  public function getWidth() {
    return $this->img->getWidth();
  }

  /**
   * {@inheritdoc}
   */
  public function setAlt($alt) {
    $this->img->setAlt($alt);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setHeight($height) {
    $this->img->setHeight($height);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setSize(Size $size) {
    $this->img->setSize($size);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setSrc($src) {
    $this->img->setSrc($src);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setWidth($width) {
    $this->img->setWidth($width);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function useMap($map) {
    $this->img->useMap($map);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function setLazy($lazy = true) {
    $this->img->setLazy($lazy);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isLazy() {
    return $this->img->isLazy();
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return $this->img . $this->caption;
  }

}
