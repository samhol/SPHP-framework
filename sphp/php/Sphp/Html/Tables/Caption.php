<?php

/**
 * Caption.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\SimpleContainerTag as SimpleContainerTag;

/**
 * Class models an HTML &lt;caption&gt; tag
 *
 * **Note:** You can specify only one caption per table.
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-04
 * @link    http://www.w3schools.com/tags/tag_caption.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Caption extends SimpleContainerTag implements TableContentInterface {

  /**
   * Constructs a new instance
   *
   * @param string $content caption content
   */
  public function __construct($content = null) {
    parent::__construct('caption', $content);
  }

}
