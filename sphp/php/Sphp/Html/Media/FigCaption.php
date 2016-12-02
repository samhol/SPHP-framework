<?php

/**
 * FigCaption.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Media;

use Sphp\Html\ContainerTag;

/**
 * Class Models an HTML &lt;figcaption&gt; tag
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-02-15
 * @link    http://www.w3schools.com/tags/tag_figcaption.asp w3schools API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
