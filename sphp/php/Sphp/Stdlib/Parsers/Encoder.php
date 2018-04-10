<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

/**
 * Description of Encoder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2018-02-13
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface Encoder {

  public function encode(array $config): string;
}
