<?php

/**
 * ApiLinkPathGenerator.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Navigation\HyperlinkInterface;

/**
 * Hyperlink generator pointing to an existing API documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ApiLinkPathGenerator {

  /**
   * Returns the url pointing to the API documentation
   *
   * @return string the url pointing to the API documentation
   */
  public function getApiRoot();
}
