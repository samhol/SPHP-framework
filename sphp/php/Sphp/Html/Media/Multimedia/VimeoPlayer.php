<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Network\URL;

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
    parent::__construct(new URL("https://player.vimeo.com/video/$videoId"));
  }

  /**
   * Sets the color of the video controls
   * 
   * **Default:** the default color is `#00adef`
   * 
   * @param  string $color the hexadecimal color code string
   * @return $this for a fluent interface
   */
  public function setControlsColor(string $color = null) {
    if ($color !== null) {
      $color = trim($color, '#');
    }
    $this->setOption('color', $color);
    return $this;
  }

  /**
   * Sets the visibility of the video title
   * 
   * **Default:** `true` the title is visible
   * 
   * @param  bool $show true if the title is visible and false otherwise
   * @return $this for a fluent interface
   */
  public function showVideoTitle(bool $show) {
    $this->setOption('title', (int) $show);
    return $this;
  }

}
