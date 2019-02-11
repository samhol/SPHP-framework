<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Tag;
use Sphp\Html\TraversableContent;

/**
 * Defines properties HTML multimedia tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface MediaTag extends Tag {

  /**
   * Adds multimedia source or track
   *
   * @param  MultimediaSource $src a video sources
   * @return $this for a fluent interface
   */
  public function addMediaSrc(MultimediaSource $src);

  /**
   * Adds a video/audio/image source which the browser may choose from
   *
   * @param  string $src the URL of the media file
   * @param  string $type the media type of the media resource
   * @return Source added instance
   * @link   http://www.w3schools.com/tags/att_source_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_source_type.asp type attribute
   */
  public function addSource(string $src, string $type = null): Source;

  /**
   * Returns all the source components associated with the component
   * 
   * @return Source[] all the source components
   */
  public function getSources(): iterable;

  /**
   * Adds a text track for the media element
   *
   * @param  string $src the URL of the media file
   * @param  string $srclang the language of the track text data   
   * @return Track added instance
   * @link   http://www.w3schools.com/tags/att_track_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_track_srclang.asp srclang attribute
   */
  public function addTrack(string $src, string $srclang = null): Track;

  /**
   * Returns all the track components associated with the component
   * 
   * @return Track[] all the track components
   */
  public function getTracks(): iterable;

  /**
   * Sets whether the video will automatically start playing as soon as it can 
   *  do so without stopping
   *
   * @param  boolean $autoplay true if the video will automatically start playing, false otherwise
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_audio_autoplay.asp autoplay attribute for audio element
   * @link   http://www.w3schools.com/tags/att_video_autoplay.asp autoplay attribute for video element
   */
  public function autoplay(bool $autoplay = true);

  /**
   * Sets whether the video will start over again, every time it is finished
   *
   * @param  boolean $loop true if the video loops, false otherwise
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_audio_loop.asp loop attribute for audio element
   * @link   http://www.w3schools.com/tags/att_video_loop.asp loop attribute for video element
   */
  public function loop(bool $loop = true);

  /**
   * Sets whether the audio output of the video should be muted
   *
   * @param  boolean $muted true if the audio output should be muted, false otherwise
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_audio_muted.asp muted attribute for audio element
   * @link   http://www.w3schools.com/tags/att_video_muted.asp muted attribute for video element
   */
  public function mute(bool $muted = true);

  /**
   * Sets whether the video controls should be displayed
   *
   * @param  boolean $show true if video controls should be displayed, false otherwise
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_audio_controls.asp controls attribute for audio element
   * @link   http://www.w3schools.com/tags/att_video_controls.asp controls attribute for video element
   */
  public function showControls(bool $show = true);
}
