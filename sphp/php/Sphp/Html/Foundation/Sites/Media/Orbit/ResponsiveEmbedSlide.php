<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Media\Orbit;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Foundation\Sites\Media\ResponsiveEmbedInterface;
use Sphp\Html\Foundation\Sites\Media\ResponsiveEmbed;

/**
 * Implements a Responsive Embed slide for a Orbit component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/orbit.html Orbit
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ResponsiveEmbedSlide extends AbstractComponent implements Slide, ResponsiveEmbedInterface {

  use ActivationTrait;

  /**
   * the flex component instance
   *
   * @var ResponsiveEmbed
   */
  private $flex;

  /**
   * Constructor
   *
   * @param ResponsiveEmbedInterface $embed the inner component
   */
  public function __construct(ResponsiveEmbedInterface $embed = null) {
    parent::__construct('li');
    $this->cssClasses()->protectValue('orbit-slide');
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
   * Returns the inner component
   *
   * @return ResponsiveEmbed the inner component
   */
  public function getFlex(): ResponsiveEmbed {
    return $this->flex;
  }

  public function setAspectRatio(string $ratio) {
    $this->getFlex()->setAspectRatio($ratio);
    return $this;
  }

  public function contentToString(): string {
    return $this->flex->getHtml();
  }

  /**
   * Returns a new instance containing a {@link YoutubePlayer} instance
   * 
   * @param  string $videoId the id of the YouTube video or playlist
   * @param  boolean $isPlaylist whether the videoid is a playlist or a single video
   * @return ResponsiveEmbedSlide new instance containing a {@link YoutubePlayer} instance
   */
  public static function youtube(string $videoId, bool $isPlaylist = false): ResponsiveEmbedSlide {
    return new static(ResponsiveEmbed::youtube($videoId, $isPlaylist));
  }

  /**
   * Returns a new instance containing a {@link VimeoPlayer} instance
   * 
   * @param  string $videoId the id of the Vimeo video
   * @return ResponsiveEmbedSlide new instance containing a {@link VimeoPlayer} instance
   */
  public static function vimeo(string $videoId): ResponsiveEmbedSlide {
    return new static(ResponsiveEmbed::vimeo($videoId));
  }

  /**
   * Returns a new instance containing a {@link DailyMotionPlayer} instance
   * 
   * @param  string $videoId the id of the DailyMotion video
   * @return ResponsiveEmbedSlide new instance containing a {@link DailyMotionPlayer} instance
   */
  public static function dailymotion(string $videoId): ResponsiveEmbedSlide {
    return new static(ResponsiveEmbed::dailymotion($videoId));
  }

}
