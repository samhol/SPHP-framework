<?php

/**
 * VideoJs.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\AV;

use Sphp\Html\Media\SizeableInterface;
use Sphp\Html\Media\SizeableTrait;

/**
 * Class models an HTML &lt;video&gt; tag
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-20
 * @link    http://www.w3schools.com/tags/tag_video.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class VideoJs extends AbstractMediaTag implements SizeableInterface {

  use SizeableTrait;

  /**
   * Constructs a new instance
   *
   * @param  Source|Source[] $sources defines a table caption
   */
  public function __construct($sources = null) {
    parent::__construct('video', $sources);
    $this->cssClasses()->lock('video-js vjs-default-skin vjs-paused vjs-controls-enabled');
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
   * @return self for PHP Method Chaining
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
   * @return self for PHP Method Chaining
   */
  public function setRatio($ratio) {
    $this->cssClasses()->remove(['vjs-16-9', 'vjs-4-3']);
    if ($ratio === '16-9' || $ratio === '4-3') {
      $this->cssClasses()->add("vjs-$ratio");
    }
    return $this;
  }
  
  /**
   * Sets the ratio of the video component to `16:9` widescreen
   * 
   * @return self for PHP Method Chaining
   */
  public function setWideScreen() {
    $this->setRatio('16-9');
    return $this;
  }
  
  /**
   * Sets the ratio of the video component to `4:3`
   * 
   * @return self for PHP Method Chaining
   */
  public function setTraditionalScreen() {
    $this->setRatio('4-3');
    return $this;
  }

}
