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
 * Implements an embeddable Vimeo Video component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://developer.vimeo.com/player/embedding Vimeo embedding
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class VimeoPlayer extends AbstractVideoPlayer {

  /**
   * Constructor
   *
   * @param  string $videoId the id of the Vimeo video
   */
  public function __construct($videoId) {
    parent::__construct("https://player.vimeo.com/video/$videoId");
  }

  /**
   * Sets the color of the video controls
   * 
   * **Default:** the default color is `#00adef`
   * 
   * @param  string $color the hexadecimal color code string
   * @return $this for a fluent interface
   */
  public function setControlsColor(string $color) {
    $this->getUrl()->getQuery()->offsetSet('color', trim($color, '#'));
  }

  /**
   * Sets the visibility of the video title
   * 
   * **Default:** `true` the title is visible
   * 
   * @param  boolean $show true if the title is visible and false otherwise
   * @return $this for a fluent interface
   */
  public function showVideoTitle(bool $show) {
    $this->getUrl()->getQuery()->offsetSet('title', int($show));
  }

}
