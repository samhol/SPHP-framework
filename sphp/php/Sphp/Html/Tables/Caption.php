<?php

/**
 * Caption.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Html\SimpleContainerTag as SimpleContainerTag;

/**
 * Implements an HTML &lt;caption&gt; tag
 *
 * **Note:** You can specify only one caption per table.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_caption.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Caption extends SimpleContainerTag implements TableContent {

  /**
   * Constructs a new instance
   *
   * @param string $content caption content
   */
  public function __construct($content = null) {
    parent::__construct('caption', $content);
  }

}
