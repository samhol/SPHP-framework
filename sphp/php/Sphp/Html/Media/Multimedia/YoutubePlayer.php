<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

/**
 * Implements an embeddable Youtube Video palyer component
 * 
 * **Requirements:**
 * The user's browser must support the HTML5 `postMessage` feature. Most modern 
 * browsers support `postMessage`, though Internet Explorer 7 does not support it.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class YoutubePlayer extends AbstractVideoPlayer {

  /**
   * Constructor
   *
   * @param string $videoId the id of the YouTube video or playlist
   * @param boolean $isPlaylist whether the videoid is a playlist or a single video
   */
  public function __construct(string $videoId = null, bool $isPlaylist = false) {
    parent::__construct('https://www.youtube.com/embed/', $videoId);
    if ($isPlaylist) {
      $this->loadPlaylist($videoId);
    } else {
      
    }
    $this->cssClasses()->protectValue('youtube-player');
    $this->setTitle('Youtube video');
  }

  /**
   * 
   * @param  string $playlistId
   * @return $this for a fluent interface
   */
  protected function loadPlaylist(string $playlistId) {
    $this->getUrl()
            ->setPart(PHP_URL_PATH, 'embed');
    $this->getUrl()->getQuery()
            ->offsetSet('listType', 'playlist')
            ->offsetSet('list', $playlistId);
    return $this;
  }

  /**
   * Set the visibility of the player controls
   * 
   * * `0`: The player controls are always visible.
   * * `1`: The player controls hides automatically when the video plays.
   * * `2` (default): If the player has 16:9 or 4:3 ratio, same as `1`, otherwise same as `0`.
   * 
   * @param  int $autohide the value of the autohide parameter
   * @return $this for a fluent interface
   */
  public function autohide(int $autohide = 2) {
    $this->getUrl()->getQuery()->offsetSet('autohide', $autohide);
    return $this;
  }

  /**
   * Set the time when the video should stop
   * 
   * This causes the player to begin playing the video at the given number of 
   * seconds from the start of the video. The parameter value is a positive 
   * integer. Note that similar to the seekTo function, the player will look for 
   * the closest keyframe to the time you specify. This means that sometimes the 
   * play head may seek to just before the requested time, usually no more than 
   * around two seconds.
   * 
   * @param  int $start the start time measured from the beginning of the video
   * @return $this for a fluent interface
   */
  public function setStartTime(int $start = 0) {
    if ($start >= 0) {
      $this->getUrl()->getQuery()->offsetSet('start', $start);
    } else {
      $this->getUrl()->getQuery()->offsetUnset('start');
    }
    return $this;
  }

  /**
   * Set the time when the video should stop
   * 
   * This specifies the time, measured in seconds from the start of 
   * the video, when the player should stop playing the video. The parameter 
   * value is a positive integer.
   * 
   * **Note:** 
   * The time is measured from the beginning of the video and not from either 
   * the value of the start player parameter or the startSeconds parameter, 
   * which is used in YouTube Player API functions for loading or queueing a 
   * Wvideo.
   * 
   * @param  int $end the end time measured from the beginning of the  
   *                     video or `false` for playing the full video
   * @return $this for a fluent interface
   */
  public function setEndTime(int $end) {
    if ($end >= 0) {
      $this->getUrl()->getQuery()->offsetSet('end', $end);
    } else {
      $this->getUrl()->getQuery()->offsetUnset('end');
    }
    return $this;
  }

}
