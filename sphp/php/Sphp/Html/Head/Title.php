<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\SimpleTag;
use Sphp\Html\NonVisualContent;

/**
 * Implements an HTML &lt;title&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_title.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Title extends SimpleTag implements OverlappingHeadContent, NonVisualContent {

  /**
   * Constructor
   *
   * @param string $content tag's content
   */
  public function __construct(string $content = null) {
    parent::__construct('title');
    $this->setContent($content);
  }

  public function overlapsWith(HeadContent $other): bool {
    return $other instanceof Title;
  }

}
