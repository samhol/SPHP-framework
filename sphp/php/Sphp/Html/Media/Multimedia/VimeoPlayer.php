<?php

/**
 * VimeoPlayer.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Multimedia;

/**
 * Implements an embeddable Vimeo Video component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @link    http://developer.vimeo.com/player/embedding Vimeo embedding
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class VimeoPlayer extends AbstractVideoPlayer {

  /**
   * Constructs a new instance
   *
   * @param  string $videoId the id of the Vimeo video
   */
  public function __construct($videoId) {
    parent::__construct("https://player.vimeo.com/video/$videoId");
  }

  /**
   * Sets the color of the video controls
   * 
   * **Default:** the default color is `00adef`
   * 
   * @param  string $color the hexadecimal color code string
   * @return self for a fluent interface
   */
  public function setControlsColor($color) {
    $this->setParam('color', trim($color, '#'));
  }

  /**
   * Sets the visibility of the video title
   * 
   * **Default:** `true` the title is visible
   * 
   * @param  boolean $show true if the title is visible and false otherwise
   * @return self for a fluent interface
   */
  public function showVideoTitle($show) {
    $this->setParam('title', int($show));
  }

}
