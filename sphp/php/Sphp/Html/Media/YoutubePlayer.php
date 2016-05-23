<?php

/**
 * YoutubePlayer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

/**
 * Class models an embeddable Youtube Video palyer component
 * 
 * **Requirements:**
 * The user's browser must support the HTML5 `postMessage` feature. Most modern 
 * browsers support `postMessage`, though Internet Explorer 7 does not support it.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class YoutubePlayer extends AbstractVideoPlayer {

  /**
   * Constructs a new instance
   *
   * @param  string $videoId the id of the YouTube video
   */
  public function __construct($videoId = null) {
    parent::__construct("http://www.youtube.com/embed/", $videoId);
    $this->lockCssClass("youtube-player")
            ->lockAttr("type", "text/html");
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
    return $this->setParam("autohide", (int) $autohide);
  }

}
