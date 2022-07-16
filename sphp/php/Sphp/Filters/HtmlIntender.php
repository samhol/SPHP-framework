<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

use Gajus\Dindent\Indenter;

/**
 * Filter formats an `HTML` code string
 * 
 * **IMPORTANT!** manipulates only string inputs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 * @see     https://github.com/gajus/dindent
 */
class HtmlIntender extends AbstractFilter {

  public function filter(mixed $input): mixed {
    $indenter = new Indenter();
    return $indenter->indent($input);
  }

}
