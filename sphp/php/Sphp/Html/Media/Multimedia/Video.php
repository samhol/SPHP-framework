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
use Sphp\Html\Media\LazyMedia;

/**
 * Implements an HTML &lt;video&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_video.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Video extends AbstractMultimediaTag implements SizeableMedia, LazyMedia {

  use SizeableMediaTrait;

  /**
   * Constructor
   *
   * @param mixed $sources optional sources
   */
  public function __construct($sources = null) {
    parent::__construct('video', null, $sources);
    //$this->showControls(true);
  }

  public function isLazy(): bool {
    $lazy = false;
    foreach ($this->getSources() as $source) {
      $lazy &= $source->setLazy();
    }
    return $lazy;
  }

  public function setLazy(bool $lazy = true) {
    foreach ($this->getSources() as $source) {
      $source->setLazy($lazy);
    }
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
   * @link   http://www.w3schools.com/tags/att_video_poster.asp poster attribute
   */
  public function setPoster(string $poster = null) {
    $this->attributes()->setAttribute('poster', $poster);
    return $this;
  }

}
