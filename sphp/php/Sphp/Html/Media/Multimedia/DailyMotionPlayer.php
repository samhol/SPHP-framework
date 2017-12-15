<?php

/**
 * DailyMotionPlayer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Multimedia;

/**
 * Implements an embeddable Dailymotion Video component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://developer.vimeo.com/player/embedding Vimeo embedding
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class DailyMotionPlayer extends AbstractVideoPlayer {

  /**
   * Constructs a new instance
   *
   * @param string $videoId the id of the Dailymotion video
   */
  public function __construct($videoId = null) {
    parent::__construct('//www.dailymotion.com/embed/video/', $videoId);
  }

}
