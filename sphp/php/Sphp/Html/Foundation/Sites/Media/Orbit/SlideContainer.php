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
use Sphp\Html\Media\Multimedia\VideoPlayer;
use Sphp\Html\Foundation\Sites\Media\ResponsiveEmbed;
use Traversable;

/**
 * Implements a slide container for Foundation Orbit
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/orbit.html Foundation Orbit slider
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SlideContainer extends AbstractComponent implements \IteratorAggregate, \Countable {

  private $active = 0;

  /**
   * @var Slide[]
   */
  private $slides = [];

  /**
   * Constructor
   *
   */
  public function __construct() {
    parent::__construct('ul');
    $this->cssClasses()
            ->protectValue('orbit-container');
  }

  /**
   * Appends a slide to the orbit
   *
   * **Notes:**
   *
   * 1. `mixed $slides` can be of any type that converts to a PHP string
   * 2. Any `mixed $slides` not extending {@link Slide} is wrapped within {@link Slide} component
   * 3. All items of an array are treated according to note (2)
   *
   * @param  mixed|Slide $slide
   * @return Slide appended instance
   */
  public function append($slide): Slide {

    if (!($slide instanceof Slide)) {
      $slide = new HtmlSlide($slide);
    }
    $this->slides[] = $slide;
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
   * Appends a new slide component containing a {@link VimeoPlayer} instance
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

  /**
   * Returns the number of the slides in this orbit
   * 
   * @return int number of the slides in this orbit
   */
  public function count(): int {
    return count($this->slides);
  }

  public function getIterator(): Traversable {
    return new \Sphp\Html\Iterator($this->slides);
  }

  /**
   * Appends the given slide to the orbit component
   *
   * @param  int $slideNo
   * @return Bullet
   */
  public function getSlide(int $slideNo): Slide {
    return $this->slides[$slideNo];
  }

  /**
   * Sets the bullet of given index active
   *
   * @param  int $slideNumber
   * @return $this for a fluent interface
   */
  public function setActive(int $slideNumber) {
    $this->active = $slideNumber;
    foreach ($this->slides as $no => $slide) {
      if ($no == $slideNumber) {
        $slide->setActive(true);
      } else {
        $slide->setActive(false);
      }
    }
    return $this;
  }

  public function contentToString(): string {
    return implode('', $this->slides);
  }

  /**
   * Returns generated bullets
   * 
   * @return BulletContainer generated bullets
   */
  public function generateBullets(): BulletContainer {
    $bullets = new BulletContainer($this->count());
    $bullets->setActive($this->active);
    return $bullets;
  }

}
