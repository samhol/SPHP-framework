<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Throwable;

/**
 * Abstract implementation of the Content interface
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractContent implements Content {

  public function __toString(): string {
    try {
      $output = $this->getHtml();
    } catch (Throwable $e) {
      $output = "$e";
    }
    return $output;
  }

  public function printHtml() {
    echo $this;
    return $this;
  }

}
