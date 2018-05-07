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
 * Implements an embeddable Dailymotion Video component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://developer.vimeo.com/player/embedding Vimeo embedding
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DailyMotionPlayer extends AbstractVideoPlayer {

  /**
   * Constructor
   *
   * @param string $videoId the id of the Dailymotion video
   */
  public function __construct($videoId = null) {
    parent::__construct('//www.dailymotion.com/embed/video/', $videoId);
  }

}
