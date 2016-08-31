<?php

/**
 * VideoJs.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

/**
 * Class models an HTML &lt;video&gt; tag
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-20
 * @link    http://www.w3schools.com/tags/tag_video.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class VideoJs extends Video {

  /**
   * Constructs a new instance
   *
   * @param  Source|Source[] $sources defines a table caption
   */
  public function __construct($sources = null) {
    parent::__construct($sources);
    $this->cssClasses()->lock("video-js vjs-default-skin vjs-paused vjs-controls-enabled");
    $this->identify();
    $this->attrs()->demand("data-setup");
  }

}
