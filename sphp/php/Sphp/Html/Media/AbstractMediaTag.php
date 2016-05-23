<?php

/**
 * AbstractMediaTag.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\AbstractComponent as AbstractComponent;

/**
 * Class models the HTML multimedia tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-20
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractMediaTag extends AbstractComponent {

  /**
   * Constructs a new instance
   *
   * @param  string $tagname defines a table caption
   * @param  mixed|mixed[] $sources defines the media sources
   */
  public function __construct($tagname, $sources = null) {
    parent::__construct($tagname);
    $adder = function($source) {
      if ($source instanceof Source) {
        $this->append($source);
      } else {
        $this->addSource($source);
      }
    };
    if (!is_array($sources)) {
      $sources = [$sources];
    }
    array_map($adder, $sources);
    $this->showControls(true);
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return parent::contentToString() . "<p>Your browser does not support the &lt;" .
            $this->getTagName() . "&gt; tag!</p>";
  }

  /**
   * Sets (replaces) one of the video sources
   *
   * @param  MultimediaContentInterface $src the given part of a table
   * @return self for PHP Method Chaining
   */
  public function append(MultimediaContentInterface $src) {
    $this->content()->append($src);
    return $this;
  }

  /**
   * Sets (replaces) one of the video sources
   *
   * @param  string|URL $src the URL of the media file
   * @param  string $type the media type of the media resource
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_source_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_source_type.asp type attribute
   */
  public function addSource($src, $type = null) {
    return $this->append(new Source($src, $type));
  }

  /**
   * Returns all the source components associated with the component
   * 
   * @return Source all the source components
   */
  public function getSources() {
    return $this->content()->getComponentsByObjectType(Source::class);
  }

  /**
   * Sets (replaces) one of the video sources
   *
   * @param  string $src the URL of the media file
   * @param  string $srclang the language of the track text data
   * @link   http://www.w3schools.com/tags/att_track_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_track_srclang.asp srclang attribute
   */
  public function addTrack($src, $srclang = null) {
    return $this->append(new Track($src, $srclang));
  }

  /**
   * Returns all the track components associated with the component
   * 
   * @return Track all the track components
   */
  public function getTrack() {
    return $this->content()->getComponentsByObjectType(Track::class);
  }

  /**
   * Sets whether the video will automatically start playing as soon as it can 
   *  do so without stopping
   *
   * @param  boolean $autoplay true if the video will automatically start playing, false otherwise
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_video_autoplay.asp autoplay attribute
   */
  public function autoplay($autoplay = true) {
    return $this->setAttr("autoplay", $autoplay);
  }

  /**
   * Sets whether the video will start over again, every time it is finished
   *
   * @param  boolean $loop true if the video loops, false otherwise
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_video_loop.asp loop attribute
   */
  public function loop($loop = true) {
    return $this->setAttr("loop", $loop);
  }

  /**
   * Sets whether the audio output of the video should be muted
   *
   * @param  boolean $muted true if the audio output should be muted, false otherwise
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_video_muted.asp muted attribute
   */
  public function mute($muted = true) {
    return $this->setAttr("muted", $muted);
  }

  /**
   * Sets whether the video controls should be displayed
   *
   * @param  boolean $show true if video controls should be displayed, false otherwise
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_video_controls.asp controls attribute
   */
  public function showControls($show = true) {
    return $this->setAttr("controls", $show);
  }

}
