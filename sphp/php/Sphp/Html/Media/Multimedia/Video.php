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
 * Implementation of an HTML video tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_video.asp w3schools HTML API
 * @link    https://www.w3.org/html/wg/drafts/html/master/embedded-content.html#the-img-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Video extends MediaTag implements VideoPlayer {

  public const SOURCES = 0b01;
  public const TRACKS = 0b10;
  public const ALL = 0b11;

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('video');
  }

  public function setSize(int $width = null, int $height = null) {
    $this->attributes()->setAttribute('width', $width);
    $this->attributes()->setAttribute('height', $height);
    return $this;
  }

  /**
   * Sets the poster image for the video component
   * 
   * **Note:** The poster attribute specifies an image to be shown while 
   * the video is downloading, or until the user hits the play button. If 
   * this is not included, the first frame of the video will be used instead.
   * 
   * @param  string|null $poster the poster image for the video component
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_video_poster.asp poster attribute
   */
  public function setPoster(string $poster = null) {
    $this->attributes()->setAttribute('poster', $poster);
    return $this;
  }

}
