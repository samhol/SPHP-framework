<?php

/**
 * ImageLink.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Navigation;

use Sphp\Html\AbstractContainerComponent as AbstractContainerComponent;
use Sphp\Html\Media\LazyLoaderInterface as LazyLoaderInterface;
use Sphp\Html\Media\SizeableInterface as SizeableInterface;
use Sphp\Html\Media\Img as Img;
use Sphp\Html\Media\Size as Size;
use Sphp\Core\Types\Strings as Strings;
use Sphp\Net\URL as URL;

/**
 * Class implements a Foundation Dropdown Button in PHP
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-22
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ImageLink extends AbstractContainerComponent implements HyperlinkInterface, LazyLoaderInterface, SizeableInterface {

  use HyperlinkTrait;

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "a";

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   * * The `href` attribute specifies the URL of the page the link goes to.
   * * If the `href` attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   *
   * @param  string|URL $href the URL of the hyperlink
   * @param  string $target the value of the target attribute
   * @param  string|Img $src link tag's content
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function __construct($href = null, $target = null, $src = null, $alt = "") {
    parent::__construct(self::TAG_NAME);
    if ($src instanceof Img) {
      $this->setImg($src);
    } else {
      $this->setImg(new Img($src, $alt));
    }
    if (Strings::notEmpty($href)) {
      $this->setHref($href);
    }
    if (Strings::notEmpty($target)) {
      $this->setTarget($target);
    }
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

  /**
   * 
   * @param type $src
	 * @return self for PHP Method Chaining
   */
  public function setAlt($src) {
    $this->img()->setAlt($src);
    return $this;
  }

  /**
   * Sets link image component
   * 
   * @param Img $img new link image component
	 * @return self for PHP Method Chaining
   */
  public function setImg(Img $img) {
    $this->content()->replaceContent($img);
    return $this;
  }

  /**
   * Returns the image component
   *
   * @return Img the splitter component
   */
  public function img() {
    return $this->content(0);
  }

  /**
   * {@inheritdoc}
   */
  public function setWidth($width) {
    $this->img()->setWidth($width);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getWidth() {
    return $this->img()->getWidth();
  }

  /**
   * {@inheritdoc}
   */
  public function setHeight($height) {
    $this->img()->setHeight($height);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getHeight() {
    return $this->img()->getHeight();
  }

  /**
   * {@inheritdoc}
   */
  public function setLazy($lazy = true) {
    $this->img()->setLazy($lazy);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isLazy() {
    return $this->img()->isLazy();
  }

  /**
   * {@inheritdoc}
   */
  public function setSize(Size $size) {
    $this->img()->setSize($size);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getSize() {
    return $this->img()->getSize();
  }

}
