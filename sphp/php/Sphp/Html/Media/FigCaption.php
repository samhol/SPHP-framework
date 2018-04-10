<?php

/**
 * FigCaption.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;figcaption&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_figcaption.asp w3schools API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class FigCaption extends ContainerTag {

  /**
   * Constructs a new instance
   *
   * @param  mixed $caption the caption content
   */
  public function __construct($caption = null) {
    parent::__construct('figcaption', $caption);
  }

}
