<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Media;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Media\Multimedia\Iframe;
use Sphp\Html\Media\ViewerJS;
use Sphp\Html\Media\Multimedia\DailyMotionPlayer;
use Sphp\Html\Media\Multimedia\VimeoPlayer;
use Sphp\Html\Media\Multimedia\YoutubePlayer;
use Sphp\Html\Content;

/**
 * Implements a Responsive embed component
 *
 * This component lets browsers automatically scale iframe objects in webpages. If a 
 * video is embedded from YouTube, Vimeo, or another site that uses iframe, 
 * embed or object elements, video can be wrap into {@link self} to create 
 * an intrinsic ratio that will properly scale the iframe based media on any device.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/responsive-embed.html Responsive Embed
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ResponsiveEmbed extends AbstractComponent implements ResponsiveEmbedInterface {

  /**
   * @var Content
   */
  private $embed;

  /**
   * Constructor
   *
   * @param Content $media the embeddable component
   */
  public function __construct(Content $media) {
    parent::__construct('div');
    $this->cssClasses()->protectValue('responsive-embed');
    $this->setEmbeddable($media);
  }

  public function __destruct() {
    unset($this->embed);
    parent::__destruct();
  }

  public function __clone() {
    $this->embed = clone $this->embed;
    parent::__clone();
  }

  /**
   * Sets the actual embeddable component
   * 
   * @param  Content $media embeddable component
   * @return $this for a fluent interface
   */
  protected function setEmbeddable(Content $media) {
    $this->embed = $media;
    return $this;
  }

  /**
   * Returns the actual embeddable component
   * 
   * @return Content the actual embeddable component
   */
  public function getEmbeddable(): Content {
    return $this->embed;
  }

  public function setAspectRatio(string $ratio) {
    $ratios = ['default', 'vertical', 'widescreen', 'square'];
    if ($ratio) {
      $this->cssClasses()->remove(...$ratios);
      $this->cssClasses()->add($ratio);
    }
    return $this;
  }

  public function contentToString(): string {
    return $this->getEmbeddable()->getHtml();
  }

  /**
   * Returns a new instance containing an Iframe instance
   * 
   * @param  string $src the path to the presented file
   * @return ResponsiveEmbed new instance containing a {@link Iframe} instance
   */
  public static function iframe(string $src): ResponsiveEmbed {
    return new static(new Iframe($src));
  }

  /**
   * Returns a new instance containing a ViewerJS instance
   * 
   * @param  string $src the path to the presented file
   * @return ResponsiveEmbed new instance containing a {@link \Sphp\Html\Media\ViewerJS ViewerJS} instance
   */
  public static function vieverJs(string $src): ResponsiveEmbed {
    return new static(new ViewerJS($src));
  }

  /**
   * Returns a new instance containing an Youtube video
   * 
   * @param  string $videoId the id of the YouTube video or playlist
   * @param  bool $isPlaylist whether the videoid is a playlist or a single video
   * @return ResponsiveEmbed new instance containing an Youtube video
   */
  public static function youtube(string $videoId, bool $isPlaylist = false): ResponsiveEmbed {
    return new static(new YoutubePlayer($videoId, $isPlaylist));
  }

  /**
   * Returns a new instance containing a Vimeo video
   * 
   * @param  string $videoId the id of the Vimeo video
   * @return ResponsiveEmbed new instance containing a Vimeo video
   */
  public static function vimeo(string $videoId): ResponsiveEmbed {
    $player = new static(new VimeoPlayer($videoId));
    $player->cssClasses()->protectValue('vimeo');
    return $player;
  }

  /**
   * Returns a new instance containing a DailyMotion video
   * 
   * @param  string $videoId the id of the DailyMotion video
   * @return ResponsiveEmbed new instance containing a DailyMotion video
   */
  public static function dailymotion(string $videoId): ResponsiveEmbed {
    return new static(new DailyMotionPlayer($videoId));
  }

}
