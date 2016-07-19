<?php

/**
 * VideoPlayerSlide.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Media\Orbit;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Foundation\F6\Media\FlexVideo as FlexVideo;
use Sphp\Html\Media\VideoPlayerInterface as VideoPlayerInterface;

/**
 * Class implements a slide for Foundation {@link Orbit} components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class VideoPlayerSlide extends AbstractComponent implements SlideInterface {

  use ActivationTrait;

  /**
   *
   * @var FlexVideo
   */
  private $player;

  /**
   * Constructs a new instance
   *
   * @param  VideoPlayerInterface $player the image path or the image component
   */
  public function __construct($player = null) {
    parent::__construct(self::TAG_NAME);
    $this->cssClasses()->lock("orbit-slide");
    if (!($player instanceof FlexVideo)) {
      $player = new FlexVideo($player);
    }
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
   * Returns the video player component
   *
   * @return FlexVideo the image component
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
    $this->getPlayer()->setWidescreen($widescreen);
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
   * Returns a new instance containing a {@link YoutubePlayer} instance
   * 
   * @param  string $videoId the id of the YouTube video or playlist
   * @param  boolean $isPlaylist whether the videoid is a playlist or a single video
   * @return self new instance containing a {@link YoutubePlayer} instance
   */
  public static function youtube($videoId, $isPlaylist = false) {
    return new static(FlexVideo::youtube($videoId, $isPlaylist));
  }

  /**
   * Returns a new instance containing a {@link VimeoPlayer} instance
   * 
   * @param  string $videoId the id of the Vimeo video
   * @return self new instance containing a {@link VimeoPlayer} instance
   */
  public static function vimeo($videoId) {
    return new static(FlexVideo::vimeo($videoId));
  }

  /**
   * Returns a new instance containing a {@link DailyMotionPlayer} instance
   * 
   * @param  string $videoId the id of the DailyMotion video
   * @return self new instance containing a {@link DailyMotionPlayer} instance
   */
  public static function dailymotion($videoId) {
    return new static(FlexVideo::dailymotion($videoId));
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return $this->player->getHtml();
  }

}
