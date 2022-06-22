<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Ecommerce\Data;

/**
 * Class AbstractProduct
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractProduct implements Product {

  public function toArray(): array {
    $out = [];
    $out['id'] = $this->getId();
    $out['photo'] = $this->getImgPath();
    $out['name'] = $this->getName();
    $out['price'] = $this->getPrice();
    return $out;
  }

}
