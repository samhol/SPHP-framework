<?php

/**
 * Video.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\Media\SizeableMedia;
use Sphp\Html\Media\SizeableTrait;
use Sphp\Html\Media\LazyMedia;

/**
 * Implements an HTML &lt;video&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_video.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Video extends AbstractMultimediaTag implements SizeableMedia, LazyMedia {

  use SizeableTrait;

  /**
   * Constructs a new instance
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
    $this->attributes()->set('poster', $poster);
    return $this;
  }

}
