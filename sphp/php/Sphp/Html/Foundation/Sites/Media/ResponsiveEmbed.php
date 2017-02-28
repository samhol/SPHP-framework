<?php

/**
 * ResponsiveEmbed.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Media\LazyLoaderInterface;
use Sphp\Html\Media\IframeInterface;
use Sphp\Stdlib\URL;
use Sphp\Html\Media\Iframe;
use Sphp\Html\Media\ViewerJS;
use Sphp\Html\Media\Multimedia\DailyMotionPlayer;
use Sphp\Html\Media\Multimedia\VimeoPlayer;
use Sphp\Html\Media\Multimedia\YoutubePlayer;
use ReflectionClass;
use BadMethodCallException;

/**
 * Implements a Responsive embed component
 *
 * This component lets browsers automatically scale iframe objects in webpages. If a 
 * video is embedded from YouTube, Vimeo, or another site that uses iframe, 
 * embed or object elements, video can be wrap into {@link self} to create 
 * an intrinsic ratio that will properly scale the iframe based media on any device.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/responsive-embed.html Responsive Embed
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ResponsiveEmbed extends AbstractComponent implements ResponsiveEmbedInterface, LazyLoaderInterface {

  /**
   *
   * @var IframeInterface
   */
  private $iframe;

  /**
   *
   * @var ReflectionClass 
   */
  private $reflector;

  /**
   * Constructs a new instance
   *
   * @param  IframeInterface $media the iframe component
   */
  public function __construct(IframeInterface $media) {
    parent::__construct('div');
    $this->cssClasses()->lock('responsive-embed');
    $this->iframe = $media;
  }

  public function __destruct() {
    unset($this->iframe);
    parent::__destruct();
  }

  public function __clone() {
    $this->iframe = clone $this->iframe;
    parent::__clone();
  }

  /**
   * Invokes the given method of {@link self} with the rest of the passed arguments.
   * 
   * @param  string $name the name of the called method
   * @param  mixed $arguments
   * @return mixed
   * @throws BadMethodCallException
   */
  public function __call($name, $arguments) {
    if ($this->reflector === null) {
      $this->reflector = new ReflectionClass($this->iframe);
    }
    if (!$this->reflector->hasMethod($name)) {
      throw new BadMethodCallException($name . ' is not a valid method');
    }
    $result = \call_user_func_array(array($this->iframe, $name), $arguments);
    if ($result === $this->iframe) {
      return $this;
    } else {
      return $result;
    }
  }

  /**
   * Sets the actual iframe component
   * 
   * @param  IframeInterface $media iframe component
   * @return self for a fluent interface
   */
  protected function setIframe(IframeInterface $media) {
    $this->iframe = $media;
    return $this;
  }

  /**
   * Returns the actual iframe component
   * 
   * @return IframeInterface the actual iframe component
   */
  public function getIframe() {
    return $this->iframe;
  }

  public function setAspectRatio($ratio) {
    $ratios = ['default', 'vertical', 'widescreen', 'square'];
    if ($ratio) {
      $this->cssClasses()->remove($ratios);
      $this->cssClasses()->add($ratio);
    }
    return $this;
  }

  public function isLazy() {
    return $this->getIframe()->isLazy();
  }

  public function setLazy($lazy = true) {
    $this->getIframe()->setLazy($lazy);
    return $this;
  }

  public function contentToString() {
    return $this->iframe->getHtml();
  }

  /**
   * Returns a new instance containing an {@link Iframe} instance
   * 
   * @param  URL|string $src the path to the presented file
   * @return self new instance containing a {@link Iframe} instance
   */
  public static function fromSrc($src) {
    return new static(new Iframe($src));
  }

  /**
   * Returns a new instance containing a {@link ViewerJS} instance
   * 
   * @param  URL|string $src the path to the presented file
   * @return self new instance containing a {@link ViewerJS} instance
   */
  public static function vieverJs($src) {
    return new static(new ViewerJS($src));
  }

  /**
   * Returns a new instance containing a {@link YoutubePlayer} instance
   * 
   * @param  string $videoId the id of the YouTube video or playlist
   * @param  boolean $isPlaylist whether the videoid is a playlist or a single video
   * @return self new instance containing a {@link YoutubePlayer} instance
   */
  public static function youtube($videoId, $isPlaylist = false) {
    return new static(new YoutubePlayer($videoId, $isPlaylist));
  }

  /**
   * Returns a new instance containing a {@link VimeoPlayer} instance
   * 
   * @param  string $videoId the id of the Vimeo video
   * @return self new instance containing a {@link VimeoPlayer} instance
   */
  public static function vimeo($videoId) {
    $player = new static(new VimeoPlayer($videoId));
    $player->cssClasses()->lock('vimeo');
    return $player;
  }

  /**
   * Returns a new instance containing a {@link DailyMotionPlayer} instance
   * 
   * @param  string $videoId the id of the DailyMotion video
   * @return self new instance containing a {@link DailyMotionPlayer} instance
   */
  public static function dailymotion($videoId) {
    return new static(new DailyMotionPlayer($videoId));
  }

}
