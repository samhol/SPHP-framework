<?php

/**
 * FlexVideo.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Media\LazyLoaderInterface as LazyLoaderInterface;
use Sphp\Html\Media\VideoPlayerInterface as VideoPlayerInterface;
use Sphp\Html\Media\DailyMotionPlayer as DailyMotionPlayer;
use Sphp\Html\Media\VimeoPlayer as VimeoPlayer;
use Sphp\Html\Media\YoutubePlayer as YoutubePlayer;

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
class FlexVideo extends AbstractComponent implements LazyLoaderInterface {

  /**
   *
   * @var VideoPlayerInterface 
   */
  private $player;

  /**
   * Constructs a new instance
   *
   * @param  string|int $videoId the id of the provided video
   * @param  int $provider the provider of the embedded video
   */
  public function __construct(VideoPlayerInterface $player) {
    parent::__construct("div");
    $this->cssClasses()->lock("flex-video");
    $this->player = $player;
  }

  /**
   * {@inheritdoc}
   */
  public function __destruct() {
    unset($this->player);
    parent::__destruct();
  }

  /**
   * {@inheritdoc}
   */
  public function __clone() {
    $this->player = clone $this->player;
    parent::__clone();
  }

  /**
   * Sets the actual video player component
   * 
   * @param  VideoPlayerInterface $player video player component
   * @return self for PHP Method Chaining
   */
  protected function setPlayer(VideoPlayerInterface $player) {
    $this->player = $player;
    return $this;
  }

  /**
   * Returns the actual video player component
   * 
   * @return VideoPlayerInterface the actual video player component
   */
  public function getPlayer() {
    return $this->player;
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
    return $this->getPlayer()->isLazy();
  }

  /**
   * {@inheritdoc}
   */
  public function setLazy($lazy = true) {
    $this->getPlayer()->setLazy($lazy);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function autoplay($autoplay = true) {
    $this->getPlayer()->autoplay($autoplay);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function loop($loop = true) {
    return $this->getPlayer()->loopsetParam($loop);
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return $this->player->getHtml();
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
    return new static(new VimeoPlayer($videoId));
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
