<?php

/**
 * Video.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media\AV;

use Sphp\Html\Media\SizeableInterface;
use Sphp\Html\Media\SizeableTrait;
use Sphp\Html\Media\LazyLoaderInterface;

/**
 * Implements an HTML &lt;video&gt; tag
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-20
 * @link    http://www.w3schools.com/tags/tag_video.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Video extends AbstractMediaTag implements SizeableInterface, LazyLoaderInterface {

  use SizeableTrait;

  /**
   * Constructs a new instance
   *
   * @param  Source|Source[] $sources defines a table caption
   */
  public function __construct($sources = null) {
    parent::__construct('video', $sources);
  }

  public function isLazy() {
    foreach ($this->getInnerContainer()->getComponentsByObjectType(Source::class) as $source) {
      $source->setLazy();
    }
  }

  public function setLazy($lazy = true) {
    foreach ($this->getInnerContainer()->getComponentsByObjectType(Source::class) as $source) {
      $source->setLazy($lazy);
    }
    return$this;
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

}
