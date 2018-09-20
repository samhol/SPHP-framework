<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use Sphp\Html\SimpleTag;

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
class Caption extends SimpleTag implements TableContent {

  /**
   * Constructor
   *
   * @param string $content caption content
   */
  public function __construct($content = null) {
    parent::__construct('caption', $content);
  }

}
