<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Ecommerce\Data;

use VismaPay\VismaPay;

/**
 * The Visma class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Visma {

  private VismaPay $vp;

  public function __construct(VismaPay $vp) {
    $this->vp = $vp;
  }

  public function __destruct() {
    unset($this->vp);
  }

  public function addCustomer(Customer $customer) {
    $this->vp->addCustomer([
        'firstname' => $customer->getFname(),
        'lastname' => $customer->getLname(),
        'address_street' => $customer->getAddress()->getStreetAddress(),
        'address_city' => $customer->getAddress()->getCity(),
        'address_zip' => $customer->getAddress()->getZipcode()
    ]);
  }

  public function addProduct(Product $product) {
    $this->vp->addProduct([
        'id' => $product->getId(),
        'title' => $product->getName(),
        'count' => 1,
        'pretax_price' => $product->getPrice(),
        'tax' => 24,
        'price' => (int) $product->getPrice() * 124 / 100,
        'type' => 1
    ]);
  }

}
