<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Media\SizeableMedia;
use Sphp\Html\Media\SizeableMediaTrait;

/**
 * Implements an VideoJs component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://videojs.com/ VIDEOJS
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class VideoJs extends AbstractMultimediaTag implements SizeableMedia {

  use SizeableMediaTrait;

  /**
   * Constructor
   *
   * @param  Source|Source[] $sources defines a table caption
   */
  public function __construct($sources = null) {
    parent::__construct('video', null, $sources);
    $this->cssClasses()->protectValue(['video-js']);
    $this->identify();
    $this->attributes()->demand('data-setup');
  }

  /**
   * Sets the poster image for the video component
   * 
   * **Note:** The poster attribute specifies an image to be shown while 
   * the video is downloading, or until the user hits the play button. If 
   * this is not included, the first frame of the video will be used instead.
   * 
   * @param  string|URL $poster the poster image for the video component
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_video_poster.asp poster attribute
   */
  public function setPoster(string $poster = null) {
    $this->attributes()->setAttribute('poster', $poster);
    return $this;
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
