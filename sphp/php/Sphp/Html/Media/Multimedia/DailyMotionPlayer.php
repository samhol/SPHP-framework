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
 * Implements an embeddable Dailymotion Video component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.dailymotion.com/ dailymotion
 * @link    https://developer.dailymotion.com/player/#player-parameters dailymotion Player Parameters
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class DailyMotionPlayer extends AbstractVideoPlayer {

  /**
   * Constructor
   *
   * @param string $videoId the id of the Dailymotion video
   */
  public function __construct(string $videoId) {
    parent::__construct(new URL('https://www.dailymotion.com/embed/video/' . $videoId));
  }

  public function displayControls(bool $visible = true) {
    $this->setOption('controls', (int) $visible);
    return $this;
  }

  public function autoplay(bool $autoplay = true) {
    $this->setOption('autoplay', (int) $autoplay);
    return $this;
  }

  public function mute(bool $mute = true) {
    $this->setOption('mute', (int) $mute);
    return $this;
  }

  public function loop(bool $loop = true) {
    $this->setOption('loop', (int) $loop);
    return $this;
  }

}
