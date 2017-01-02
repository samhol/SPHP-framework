<?php

/**
 * ImageLink.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Media\ImgInterface;
use Sphp\Html\Media\Img;
use Sphp\Html\Media\Size;
use Sphp\Core\Types\Strings;
use Sphp\Core\Types\URL;

/**
 * Implements an image that acts as a hyperlink
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-22
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ImageLink extends AbstractComponent implements HyperlinkInterface, ImgInterface {

  use HyperlinkTrait;

  /**
   *
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
   * @param  string|URL $href the URL of the hyperlink
   * @param  string $target the value of the target attribute
   * @param  string|Img $src link tag's content
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($href = null, $target = null, $src = null, $alt = '') {
    parent::__construct('a');
    if ($src instanceof Img) {
      $this->setImg($src);
    } else {
      $this->setImg(new Img($src, $alt));
    }
    if (!Strings::isEmpty($href)) {
      $this->setHref($href);
    }
    if (!Strings::isEmpty($target)) {
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
   * @param  string|URL $src the path to the image source (The URL of the image file)
   * @return self for PHP Method Chaining
   */
  public function setSrc($src) {
    $this->img()->setSrc($src);
    return $this;
  }

  public function setAlt($src) {
    $this->img()->setAlt($src);
    return $this;
  }

  public function getAlt() {
    return $this->img()->getAlt();
  }

  public function getSrc() {
    return $this->img()->getSrc();
  }

  /**
   * Sets link image component
   * 
   * @param Img $img new link image component
   * @return self for PHP Method Chaining
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
  public function img() {
    return $this->img;
  }

  public function setWidth($width) {
    $this->img->setWidth($width);
    return $this;
  }

  public function getWidth() {
    return $this->img->getWidth();
  }

  public function setHeight($height) {
    $this->img->setHeight($height);
    return $this;
  }

  public function getHeight() {
    return $this->img->getHeight();
  }

  public function setLazy($lazy = true) {
    $this->img->setLazy($lazy);
    return $this;
  }

  public function isLazy() {
    return $this->img->isLazy();
  }

  public function setSize(Size $size) {
    $this->img->setSize($size);
    return $this;
  }

  public function getSize() {
    return $this->img->getSize();
  }

  public function contentToString() {
    return $this->img->getHtml();
  }

}
