<?php

/**
 * VideoPlayerSlide.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Foundation\Sites\Media\FlexInterface as FlexInterface;
use Sphp\Html\Foundation\Sites\Media\Flex;

/**
 * Class implements a media Flex slide for Foundation Orbit components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class FlexSlide extends AbstractComponent implements SlideInterface, FlexInterface {

  use ActivationTrait;

  /**
   * the flex component instance
   *
   * @var Flex
   */
  private $flex;

  /**
   * Constructs a new instance
   *
   * @param FlexInterface $flex the inner component
   */
  public function __construct(FlexInterface $flex = null) {
    parent::__construct('li');
    $this->cssClasses()->lock('orbit-slide');
    if (!($flex instanceof Flex)) {
      $flex = new Flex($flex);
    }
    $this->flex = $flex;
  }

  public function __destruct() {
    unset($this->flex);
    parent::__destruct();
  }

  public function __clone() {
    $this->flex = clone $this->flex;
    parent::__clone();
  }

  /**
   * Returns the flex component
   *
   * @return Flex the flex component
   */
  public function getFlex() {
    return $this->flex;
  }

  /**
   * Sets/unsets the widescreen property
   * 
   * @param  boolean $widescreen true for widescreen
   * @return self for PHP Method Chaining
   */
  public function setWidescreen($widescreen = true) {
    $this->getFlex()->setWidescreen($widescreen);
    return $this;
  }

  public function isLazy() {
    return $this->getFlex()->isLazy();
  }

  public function setLazy($lazy = true) {
    $this->getFlex()->setLazy($lazy);
    return $this;
  }

  /**
   * Returns a new instance containing a {@link YoutubePlayer} instance
   * 
   * @param  string $videoId the id of the YouTube video or playlist
   * @param  boolean $isPlaylist whether the videoid is a playlist or a single video
   * @return self new instance containing a {@link YoutubePlayer} instance
   */
  public static function youtube($videoId, $isPlaylist = false) {
    return new static(Flex::youtube($videoId, $isPlaylist));
  }

  /**
   * Returns a new instance containing a {@link VimeoPlayer} instance
   * 
   * @param  string $videoId the id of the Vimeo video
   * @return self new instance containing a {@link VimeoPlayer} instance
   */
  public static function vimeo($videoId) {
    return new static(Flex::vimeo($videoId));
  }

  /**
   * Returns a new instance containing a {@link DailyMotionPlayer} instance
   * 
   * @param  string $videoId the id of the DailyMotion video
   * @return self new instance containing a {@link DailyMotionPlayer} instance
   */
  public static function dailymotion($videoId) {
    return new static(Flex::dailymotion($videoId));
  }

  public function contentToString() {
    return $this->flex->getHtml();
  }

}
