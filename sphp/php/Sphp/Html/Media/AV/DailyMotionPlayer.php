<?php

/**
 * DailyMotionPlayer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\AV;

/**
 * Class models an embeddable Dailymotion Video component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @link    http://developer.vimeo.com/player/embedding Vimeo embedding
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class DailyMotionPlayer extends AbstractVideoPlayer {

  /**
   * Constructs a new instance
   *
   * @param  string $videoId the id of the Vimeo video
   */
  public function __construct($videoId = null) {
    parent::__construct('//www.dailymotion.com/embed/video/', $videoId);
  }

}
