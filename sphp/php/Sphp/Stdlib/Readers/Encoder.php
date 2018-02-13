<?php

/**
 * Encoder.php (UTF-8)
 * Copyright (c) 2018 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Readers;

/**
 * Description of Encoder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2018-02-13
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface Encoder {

  public function encode(array $config): string;
}
