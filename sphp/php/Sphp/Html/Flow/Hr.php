<?php

declare(strict_types=1);

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Flow;

use Sphp\Html\EmptyTag;
use Sphp\Html\Attributes\AttributeContainer;

/**
 * Class Hr
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Hr extends EmptyTag {

  public function __construct(AttributeContainer $attrManager = null) {
    parent::__construct('hr', false, $attrManager);
  }

}
