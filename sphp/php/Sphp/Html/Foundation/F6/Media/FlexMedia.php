<?php

/**
 * FlexMedia.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Media\LazyLoaderInterface as LazyLoaderInterface;
use Sphp\Html\Media\VideoPlayerInterface as VideoPlayerInterface;
use Sphp\Html\Media\IframeInterface as IframeInterface;

/**
 * Class models a Foundation 6 Flex Video component
 *
 * Flex Video lets browsers automatically scale video objects in webpages. If a 
 * video is embedded from YouTube, Vimeo, or another site that uses iframe, 
 * embed or object elements, video can be wrap into {@link self} to create 
 * an intrinsic ratio that will properly scale the video on any device.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/flex_video.html Flex Video
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FlexMedia extends AbstractComponent implements LazyLoaderInterface {

  /**
   *
   * @var IframeInterface
   */
  private $iframe;

  /**
   * Constructs a new instance
   *
   * @param  IframeInterface $media the iframe component
   */
  public function __construct(IframeInterface $media) {
    parent::__construct("div");
    $this->cssClasses()->lock("flex-video");
    $this->iframe = $media;
  }

  /**
   * {@inheritdoc}
   */
  public function __destruct() {
    unset($this->iframe);
    parent::__destruct();
  }

  /**
   * {@inheritdoc}
   */
  public function __clone() {
    $this->iframe = clone $this->iframe;
    parent::__clone();
  }

  /**
   * Sets the actual video player component
   * 
   * @param  IframeInterface $media media component
   * @return self for PHP Method Chaining
   */
  protected function setMedia(IframeInterface $media) {
    $this->iframe = $media;
    return $this;
  }

  /**
   * Returns the actual video player component
   * 
   * @return IframeInterface the actual media component
   */
  public function getMedia() {
    return $this->iframe;
  }

  /**
   * Sets/unsets the widescreen property
   * 
   * @param  boolean $widescreen true for widescreen
   * @return self for PHP Method Chaining
   */
  public function setWidescreen($widescreen = true) {
    if ($widescreen) {
      $this->addCssClass("widesreen");
    } else {
      $this->removeCssClass("widesreen");
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function isLazy() {
    return $this->getMedia()->isLazy();
  }

  /**
   * {@inheritdoc}
   */
  public function setLazy($lazy = true) {
    $this->getMedia()->setLazy($lazy);
    return $this;
  }


  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return $this->iframe->getHtml();
  }
  
  public static function fromSrc($src) {
    return new static(new \Sphp\Html\Media\Iframe($src));
  }

}
