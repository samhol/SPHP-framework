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

use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * The Product class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
interface Product extends Arrayable {

  public function getImgPath(): string;

  public function getId();

  public function getName(): string;

  public function getCategory(): string;

  public function getPrice(): int;

  public function getTax(): int;

  public function getPretaxPrice(): int;

  public function getDescription(): string;
}
