<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\AbstractComponent;
use IteratorAggregate;
use Sphp\Html\TraversableContent;
use Sphp\Html\Attributes\AttributeContainer;
use Sphp\Html\ContentIterator;

/**
 * Class AbstractMediaTag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class MediaTag extends AbstractComponent implements MediaPlayer, IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  public const SOURCES = 0b01;
  public const TRACKS = 0b10;
  public const ALL = 0b11;

  /**
   * @var MultimediaSource[]
   */
  private array $sources;

  /**
   * Constructor
   *
   * @param string $tagName the name of the tag
   * @param AttributeContainer|null $attrManager optional attribute manager to use in the component
   */
  public function __construct(string $tagName, AttributeContainer $attrManager = null) {
    parent::__construct($tagName, $attrManager);
    $this->sources = [];
  }

  public function __destruct() {
    unset($this->sources);
    parent::__destruct();
  }

  public function contentToString(): string {
    return implode('', $this->sources)
            . "Your browser does not support the "
            . $this->getTagName() . " tag!";
  }

  protected function addMultimediaSource(MultimediaSource $source) {
    $this->sources[] = $source;
    return $this;
  }

  /**
   * Adds a video/audio/image source which the browser may choose from
   *
   * @param  string $src the URL of the media file
   * @param  string $type the media type of the media resource
   * @return Source added instance
   * @link   https://www.w3schools.com/tags/att_source_src.asp src attribute
   * @link   https://www.w3schools.com/tags/att_source_type.asp type attribute
   */
  public function addSource(string $src, ?string $type = null): Source {
    $source = new Source($src, $type);
    $this->addMultimediaSource($source);
    return $source;
  }

  /**
   * Adds a text track for the media element
   *
   * @param  string $src the URL of the media file
   * @return Track added instance
   * @link   https://www.w3schools.com/tags/att_track_src.asp src attribute
   */
  public function addTrack(string $src): Track {
    $track = new Track($src);
    $this->addMultimediaSource($track);
    return $track;
  }

  public function autoplay(bool $autoplay = true) {
    $this->attributes()->setAttribute('autoplay', (bool) $autoplay);
    return $this;
  }

  public function displayControls(bool $visible = true) {
    $this->attributes()->setAttribute('controls', (bool) $visible);
    return $this;
  }

  public function loop(bool $loop = true) {
    $this->attributes()->setAttribute('loop', (bool) $loop);
    return $this;
  }

  public function mute(bool $muted = true) {
    $this->attributes()->setAttribute('muted', (bool) $muted);
    return $this;
  }

  /**
   * Counts source and/or track components
   * 
   * @param  int $mode
   * @return int number of source and/or track components
   */
  public function count(int $mode = self::ALL): int {
    $num = 0;
    if (($mode & self::ALL) === self::ALL) {
      $num = count($this->sources);
    } else if (($mode & self::SOURCES) === self::SOURCES) {
      $num = $this->getSources()->count();
    } else if (($mode & self::TRACKS) === self::TRACKS) {
      $num = $this->getTracks()->count();
    }
    return $num;
  }

  /**
   * Create a new iterator to iterate through content
   *
   * @return ContentIterator<int, Source|Track> iterator
   */
  public function getIterator(): ContentIterator {
    return new ContentIterator($this->sources);
  }

  /**
   * Returns all the source components associated with the component
   * 
   * @return ContentIterator<int, Source> all the source components
   */
  public function getSources(): ContentIterator {
    return $this->getIterator()->getComponentsByObjectType(Source::class);
  }

  /**
   * Returns all the track components associated with the component
   * 
   * @return ContentIterator<int, Track> all the track components
   */
  public function getTracks(): ContentIterator {
    return $this->getIterator()->getComponentsByObjectType(Track::class);
  }

  /**
   * Specifies how the audio file should be loaded when the page loads
   * 
   * **Note:** Note: The preload attribute is ignored if the audio is on autoplay
   * 
   * **Attribute Values:**
   * 
   * * `auto`: The browser should load the entire audio file when the page loads
   * * `metadata`: The browser should load only metadata when the page loads
   * * `none`: The browser should NOT load the audio file when the page loads
   * 
   * @param  string|null $preload the value of the preload attribute
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_audio_preload.asp preload attribute
   */
  public function setPreload(?string $preload) {
    $this->setAttribute('preload', $preload);
    return $this;
  }

}
