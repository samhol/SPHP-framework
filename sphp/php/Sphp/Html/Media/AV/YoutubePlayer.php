<?php

/**
 * YoutubePlayer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\AV;

/**
 * Class models an embeddable Youtube Video palyer component
 * 
 * **Requirements:**
 * The user's browser must support the HTML5 `postMessage` feature. Most modern 
 * browsers support `postMessage`, though Internet Explorer 7 does not support it.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class YoutubePlayer extends AbstractVideoPlayer {

  /**
   * Constructs a new instance
   *
   * @param string $videoId the id of the YouTube video or playlist
   * @param boolean $isPlaylist whether the videoid is a playlist or a single video
   */
  public function __construct($videoId = null, $isPlaylist = false) {
    parent::__construct('https://www.youtube.com/embed/', $videoId);
    if ($isPlaylist) {
      $this->loadPlaylist($videoId);
    } else {
      
    }
    $this->cssClasses()->lock('youtube-player');
    $this->attrs()->lock('type', 'text/html');
  }

  /**
   * 
   * @param  string $playlistId
   * @return self for PHP Method Chaining
   */
  protected function loadPlaylist($playlistId) {
    $this->getUrl()
            ->setPath('embed')
            ->setParam('listType', 'playlist')
            ->setParam('list', $playlistId);
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
   * @return self for PHP Method Chaining
   */
  public function autohide($autohide = 2) {
    return $this->setParam('autohide', (int) $autohide);
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
   * @param  int|boolean $start the start time measured from the beginning of the  
   *                     video or `false` for playing the full video
   * @return self for PHP Method Chaining
   */
  public function setStartTime($start = false) {
    if ($start === false) {
      $this->getUrl()->unsetParam('start');
    } else {
      $this->getUrl()->setParam('start', (int) $start);
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
   * @param  int|boolean $end the end time measured from the beginning of the  
   *                     video or `false` for playing the full video
   * @return self for PHP Method Chaining
   */
  public function setEndTime($end = false) {
    if ($end === false) {
      $this->getUrl()->unsetParam('end');
    } else {
      $this->getUrl()->setParam('end', (int) $end);
    }
    return $this;
  }

}
