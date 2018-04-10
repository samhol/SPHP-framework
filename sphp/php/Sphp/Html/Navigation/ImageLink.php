<?php

/**
 * ImageLink.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Media\ImgInterface;
use Sphp\Html\Media\Img;

/**
 * Implements an image that acts as a hyperlink
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ImageLink extends AbstractComponent implements HyperlinkInterface, ImgInterface {

  use HyperlinkTrait;

  /**
   * @var Img
   */
  private $img;

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   * * The `href` attribute specifies the URL of the page the link goes to.
   * * If the `href` attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string $href the URL of the hyperlink
   * @param  string $target the value of the target attribute
   * @param  string|Img $src link tag's content
   * @param  string $alt
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct(string $href = null, string $target = null, $src = null, string $alt = '') {
    parent::__construct('a');
    if ($src instanceof Img) {
      $this->setImg($src);
    } else {
      $this->setImg(new Img($src, $alt));
    }
    if ($href !== null) {
      $this->setHref($href);
    }
    if ($target !== null) {
      $this->setTarget($target);
    }
  }

  public function __destruct() {
    unset($this->img);
    parent::__destruct();
  }

  public function __clone() {
    $this->img = clone $this->img;
    parent::__clone();
  }

  /**
   * Sets the path to the image source (The URL of the image file)
   * 
   * **Important:** if {@link LazyLoaderInterface::isLazy()} this method sets the value of the 
   * `data-src` attribute instead of the `src` attribute
   *
   * @param  string $src the path to the image source (The URL of the image file)
   * @return $this for a fluent interface
   */
  public function setSrc(string $src) {
    $this->img()->setSrc($src);
    return $this;
  }

  public function setAlt(string $src) {
    $this->img()->setAlt($src);
    return $this;
  }

  public function getAlt(): string {
    return $this->img()->getAlt();
  }

  public function getSrc(): string {
    return $this->img()->getSrc();
  }

  /**
   * Sets link image component
   * 
   * @param Img $img new link image component
   * @return $this for a fluent interface
   */
  public function setImg(Img $img) {
    $this->img = $img;
    return $this;
  }

  /**
   * Returns the image component
   *
   * @return Img the splitter component
   */
  public function img(): Img {
    return $this->img;
  }

  public function setLazy(bool $lazy = true) {
    $this->img->setLazy($lazy);
    return $this;
  }

  public function isLazy(): bool {
    return $this->img->isLazy();
  }

  public function contentToString(): string {
    return $this->img->getHtml();
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
