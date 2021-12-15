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

use Sphp\Html\Content;

/**
 * Defines properties HTML multimedia tags
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface MediaPlayer extends Content {

  /**
   * Sets whether the video will automatically start playing as soon as it can 
   *  do so without stopping
   *
   * @param  bool $autoplay true if the video will automatically start playing, false otherwise
   * @return $this for a fluent interface
   */
  public function autoplay(bool $autoplay = true);

  /**
   * Sets whether the video will start over again, every time it is finished
   *
   * @param  bool $loop true if the video loops, false otherwise
   * @return $this for a fluent interface
   */
  public function loop(bool $loop = true);

  /**
   * Sets whether the audio output of the video should be muted
   *
   * @param  bool $muted true if the audio output should be muted, false otherwise
   * @return $this for a fluent interface
   */
  public function mute(bool $muted = true);

  /**
   * Sets whether the video controls should be displayed
   *
   * @param  bool $visible true if video controls should be displayed, false otherwise
   * @return $this for a fluent interface
   */
  public function displayControls(bool $visible = true);
}
