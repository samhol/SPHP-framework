<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Slick;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Media\Multimedia\VideoPlayer;
use Sphp\Html\Foundation\Sites\Media\ResponsiveEmbed;
use Sphp\Html\Attributes\JsonAttribute;

/**
 * Implements a Slick Carousel in PHP
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Carousel extends AbstractComponent {

  private $slides = [];

  /**
   * Constructor
   *
   * @param  array|null $properties optional carousel properties
   */
  public function __construct(array $properties = null) {
    parent::__construct('div');
    $this->slides = [];
    $this->attributes()
            ->setInstance(new JsonAttribute('data-slick'))->demand('data-slick');
    if ($properties !== null) {
      $this->setProperty($properties);
    }
  }

  /**
   * Sets the carousel properties
   * 
   * @param  array $props
   * @return $this for a fluent interface
   */
  public function setProperty(array $props) {
    $this->attributes()->getObject('data-slick')->set($props);
    return $this;
  }

  /**
   * Appends slide(s) to the orbit
   *
   * **Notes:**
   *
   * 1. `mixed $slides` can be of any type that converts to a PHP string
   * 2. Any `mixed $slides` not extending {@link Slide} is wrapped within {@link Slide} component
   * 3. All items of an array are treated according to note (2)
   *
   * @param  mixed|Slide,... $slide
   * @return $this for a fluent interface
   */
  public function append(...$slide) {
    foreach ($slide as $item) {
      if (!($item instanceof Slide)) {
        $item = new HtmlSlide($item);
      }
      $this->slides[] = $item;
    }
    return $this;
  }

  /**
   * Appends a new HTML slide component
   *
   * @param  string $md 
   * @return HtmlSlide appended instance
   */
  public function appendMd(string $md): HtmlSlide {
    $slide = new HtmlSlide();
    $slide->appendMd($md);
    $this->append($slide);
    return $slide;
  }

  /**
   * Appends a new figure slide component
   *
   * @param  string|Img $img the image path or the image component
   * @param  mixed|mixed[] $caption the caption of the slide
   * @return FigureSlide appended instance
   */
  public function appendFigure($img, $caption = null): FigureSlide {
    $slide = new FigureSlide($img, $caption);
    $this->append($slide);
    return $slide;
  }

  /**
   * Appends a new embed slide
   *
   * @param  VideoPlayer|FlexVideo $player the image path or the image component
   * @return ResponsiveEmbedSlide appended embeddable slide instance
   */
  public function appendEmbeddable($player): ResponsiveEmbedSlide {
    $slide = new ResponsiveEmbedSlide($player);
    $this->append($slide);
    return $slide;
  }

  /**
   * Appends a new slide component containing a {@link YoutubePlayer} instance
   * 
   * @param  string $videoId the id of the YouTube video or playlist
   * @param  boolean $isPlaylist whether the videoid is a playlist or a single video
   * @return ResponsiveEmbedSlide appended YouTube video slide instance
   */
  public function appendYoutubeVideo($videoId, $isPlaylist = false): ResponsiveEmbedSlide {
    return $this->appendEmbeddable(ResponsiveEmbed::youtube($videoId, $isPlaylist));
  }

  /**
   * Appends a new slide component containing a Vimeo video
   * 
   * @param  string $videoId the id of the Vimeo video
   * @return ResponsiveEmbedSlide appended Vimeo video slide instance
   */
  public function appendVimeoVideo($videoId): ResponsiveEmbedSlide {
    return $this->appendEmbeddable(ResponsiveEmbed::vimeo($videoId));
  }

  /**
   * Appends a new slide component containing a {@link DailyMotionPlayer} instance
   * 
   * @param  string $videoId the id of the DailyMotion video
   * @return ResponsiveEmbedSlide appended DailyMotion video slide instance
   */
  public function appendDailymotionVideo($videoId): ResponsiveEmbedSlide {
    return $this->appendEmbeddable(ResponsiveEmbed::dailymotion($videoId));
  }

  public function contentToString(): string {
    return implode('', $this->slides);
  }

  public function getHtml(): string {
    return '<div class="grid-x sphp-slick-container"><div class="cell auto">' . parent::getHtml() . '</div></div>';
  }

}
