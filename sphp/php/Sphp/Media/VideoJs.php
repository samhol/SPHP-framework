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

/**
 * Implements an VideoJs component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://videojs.com/ VIDEOJS
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class VideoJs extends Video {

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct();
    $this->cssClasses()->protectValue('video-js');
    $this->identify();
    $this->attributes()->forceVisibility('data-setup');
  }

  /**
   * Sets the ratio of the video component
   * 
   * @precondition `$ratio` == `16-9|4-3`
   * @param  string $ratio the ratio of the video
   * @return $this for a fluent interface
   */
  public function setRatio(string $ratio) {
    $this->cssClasses()->remove(['vjs-16-9', 'vjs-4-3']);
    if ($ratio === '16-9' || $ratio === '4-3') {
      $this->cssClasses()->add("vjs-$ratio");
    }
    return $this;
  }

  /**
   * Sets the ratio of the video component to `16:9` wide screen
   * 
   * @return $this for a fluent interface
   */
  public function setWideScreen() {
    $this->setRatio('16-9');
    return $this;
  }

  /**
   * Sets the ratio of the video component to `4:3`
   * 
   * @return $this for a fluent interface
   */
  public function setTraditionalScreen() {
    $this->setRatio('4-3');
    return $this;
  }

}
