<?php

/**
 * AttributeParser.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes\Filters;

/**
 * Description of AttributeParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-10-02
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface AttributeDataParser {

  public function filter($rawData): array;
}
