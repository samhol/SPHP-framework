<?php

/**
 * VideoJs.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Media\SizeableInterface;
use Sphp\Html\Media\SizeableTrait;

/**
 * Implements an VideoJs component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-20
 * @link    http://videojs.com/ VIDEOJS
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class VideoJs extends AbstractMultimediaTag implements SizeableInterface {

  use SizeableTrait;

  /**
   * Constructs a new instance
   *
   * @param  Source|Source[] $sources defines a table caption
   */
  public function __construct($sources = null) {
    parent::__construct('video', null, $sources);
    $this->cssClasses()->lock(['video-js']);
    $this->identify();
    $this->attrs()->demand('data-setup');
  }

  /**
   * Sets the poster image for the video component
   * 
   * **Note:** The poster attribute specifies an image to be shown while 
   * the video is downloading, or until the user hits the play button. If 
   * this is not included, the first frame of the video will be used instead.
   * 
   * @param  string|URL $poster the poster image for the video component
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_video_poster.asp poster attribute
   */
  public function setPoster($poster) {
    $this->attrs()->set('poster', $poster);
    return $this;
  }

  /**
   * Sets the ratio of the video component
   * 
   * @precondition `$ratio` == `16-9|4-3`
   * @param  string $ratio the ratio of the video
   * @return self for a fluent interface
   */
  public function setRatio($ratio) {
    $this->cssClasses()->remove(['vjs-16-9', 'vjs-4-3']);
    if ($ratio === '16-9' || $ratio === '4-3') {
      $this->cssClasses()->add("vjs-$ratio");
    }
    return $this;
  }

  /**
   * Sets the ratio of the video component to `16:9` wide screen
   * 
   * @return self for a fluent interface
   */
  public function setWideScreen() {
    $this->setRatio('16-9');
    return $this;
  }

  /**
   * Sets the ratio of the video component to `4:3`
   * 
   * @return self for a fluent interface
   */
  public function setTraditionalScreen() {
    $this->setRatio('4-3');
    return $this;
  }

}
