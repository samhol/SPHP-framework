<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Sphp\Exceptions\RuntimeException;

/**
 * Abstract reader implementation
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractReader implements Reader {

  public function fromFile($filename) {
    if (!is_file($filename) || !is_readable($filename)) {
      throw new RuntimeException(sprintf("File '%s' doesn't exist or is not readable", $filename));
    }
    return $this->fromString(file_get_contents($filename));
  }

}
