<?php

/**
 * MediaTagInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\TagInterface;

/**
 * Defines properties HTML multimedia tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface MediaTagInterface extends TagInterface {

  /**
   * Adds multimedia source or track
   *
   * @param  MultimediaContentInterface $src a video sources
   * @return self for a fluent interface
   */
  public function addMediaSrc(MultimediaContentInterface $src);

  /**
   * Sets (replaces) one of the video sources
   *
   * @param  string|URL $src the URL of the media file
   * @param  string $type the media type of the media resource
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_source_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_source_type.asp type attribute
   */
  public function addSource($src, $type = null);

  /**
   * Returns all the source components associated with the component
   * 
   * @return Source all the source components
   */
  public function getSources();

  /**
   * Sets (replaces) one of the video sources
   *
   * @param  string $src the URL of the media file
   * @param  string $srclang the language of the track text data
   * @link   http://www.w3schools.com/tags/att_track_src.asp src attribute
   * @link   http://www.w3schools.com/tags/att_track_srclang.asp srclang attribute
   */
  public function addTrack($src, $srclang = null);

  /**
   * Returns all the track components associated with the component
   * 
   * @return Track all the track components
   */
  public function getTracks();

  /**
   * Sets whether the video will automatically start playing as soon as it can 
   *  do so without stopping
   *
   * @param  boolean $autoplay true if the video will automatically start playing, false otherwise
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_audio_autoplay.asp autoplay attribute for audio element
   * @link   http://www.w3schools.com/tags/att_video_autoplay.asp autoplay attribute for video element
   */
  public function autoplay($autoplay = true);

  /**
   * Sets whether the video will start over again, every time it is finished
   *
   * @param  boolean $loop true if the video loops, false otherwise
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_audio_loop.asp loop attribute for audio element
   * @link   http://www.w3schools.com/tags/att_video_loop.asp loop attribute for video element
   */
  public function loop($loop = true);

  /**
   * Sets whether the audio output of the video should be muted
   *
   * @param  boolean $muted true if the audio output should be muted, false otherwise
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_audio_muted.asp muted attribute for audio element
   * @link   http://www.w3schools.com/tags/att_video_muted.asp muted attribute for video element
   */
  public function mute($muted = true);

  /**
   * Sets whether the video controls should be displayed
   *
   * @param  boolean $show true if video controls should be displayed, false otherwise
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_audio_controls.asp controls attribute for audio element
   * @link   http://www.w3schools.com/tags/att_video_controls.asp controls attribute for video element
   */
  public function showControls($show = true);
}
