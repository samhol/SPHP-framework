<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Media\Embeddable;
use Sphp\Html\Media\LazyMedia;
use Sphp\Html\Media\SizeableMedia;

/**
 * Defines properties for a videoplayer component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface VideoPlayer extends Embeddable, LazyMedia, SizeableMedia {

  /**
   * Allows or disallows the full screen mode of the video 
   * 
   * @param  boolean $allow
   * @return $this for a fluent interface
   */
  public function allowFullScreen(bool $allow = true);

  /**
   * Set auto playing on or off
   * 
   * @param  boolean $autoplay true for on and false for off
   * @return $this for a fluent interface
   */
  public function autoplay(bool $autoplay = true);

  /**
   * Set the looping on or off
   * 
   * @param  boolean $loop true for on and false for off
   * @return $this for a fluent interface
   */
  public function loop(bool $loop = true);

  /**
   * Setz the parameter name value pair
   * 
   * Parameters:
   * 
   * * **autoplay:**
   *   * `0` (default): The video will not play automatically when the player loads.
   *   * `1`: The video will play automatically when the player loads.
   * * **controls:**
   *   * `0`: Player controls does not display. The video loads immediately.
   *   * `1` (default): Player controls display. The video loads immediately.
   *   * `2`: Player controls display, but the video does not load before the user initiates playback. 
   * * **loop:**
   *   * `0` (default): The video will play only once.
   *   * `1`: The video will loop (forever).
   * 
   * @param  string $name the name of the parameter
   * @param  scalar $value the value of the parameter
   * @return $this for a fluent interface
   */
  public function setParam(string $name, $value);
}
