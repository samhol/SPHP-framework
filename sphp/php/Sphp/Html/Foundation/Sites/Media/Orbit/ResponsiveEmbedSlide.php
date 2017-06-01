<?php

/**
 * ResponsiveEmbedSlide.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Foundation\Sites\Media\ResponsiveEmbedInterface;
use Sphp\Html\Foundation\Sites\Media\ResponsiveEmbed;

/**
 * Implements a Responsive Embed slide for a Orbit component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-06-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ResponsiveEmbedSlide extends AbstractComponent implements SlideInterface, ResponsiveEmbedInterface {

  use ActivationTrait;

  /**
   * the flex component instance
   *
   * @var ResponsiveEmbed
   */
  private $flex;

  /**
   * Constructs a new instance
   *
   * @param ResponsiveEmbedInterface $embed the inner component
   */
  public function __construct(ResponsiveEmbedInterface $embed = null) {
    parent::__construct('li');
    $this->cssClasses()->lock('orbit-slide');
    if (!($embed instanceof ResponsiveEmbed)) {
      $embed = new ResponsiveEmbed($embed);
    }
    $this->flex = $embed;
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
   * @return ResponsiveEmbed the flex component
   */
  public function getFlex() {
    return $this->flex;
  }

  public function setAspectRatio($ratio) {
    $this->getFlex()->setAspectRatio($ratio);
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
    return new static(ResponsiveEmbed::youtube($videoId, $isPlaylist));
  }

  /**
   * Returns a new instance containing a {@link VimeoPlayer} instance
   * 
   * @param  string $videoId the id of the Vimeo video
   * @return self new instance containing a {@link VimeoPlayer} instance
   */
  public static function vimeo($videoId) {
    return new static(ResponsiveEmbed::vimeo($videoId));
  }

  /**
   * Returns a new instance containing a {@link DailyMotionPlayer} instance
   * 
   * @param  string $videoId the id of the DailyMotion video
   * @return self new instance containing a {@link DailyMotionPlayer} instance
   */
  public static function dailymotion($videoId) {
    return new static(ResponsiveEmbed::dailymotion($videoId));
  }

  public function contentToString(): string {
    return $this->flex->getHtml();
  }

}
