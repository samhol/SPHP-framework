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
use Sphp\Ecommerce\Data\Customer;

/**
 * The CartToVismaPAy class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class VismaConverter {

  private VismaPay $vismaPay;

  public function __construct(VismaPay $vismaPay) {
    $this->vismaPay = $vismaPay;
  }

  public function convert(Cart $cart): void {
    $this->vismaPay->addCharge(array(
        'order_number' => $cart->getId(),
        'amount' => $cart->getTotal(),
        'currency' => 'EUR'
    ));

    $this->addProductsFrom($cart);
    $customer = $cart->getCustomer();
    if ($customer !== null) {
      $this->addCustomerFrom($cart->getCustomer());
    }
  }

  private function addProductsFrom(Cart $cart) {
    foreach ($cart->getItems() as $product) {

      $this->vismaPay->addProduct(array(
          'id' => $product->getId(),
          'title' => $product->getName(),
          'count' => 1,
          'pretax_price' => $product->getPretaxPrice(),
          'tax' => $product->getTax(),
          'price' => $product->getPrice(),
          'type' => 1
      ));
    }
  }

  private function addCustomerFrom(Customer $customer) {
    $this->vismaPay->addCustomer(array(
        'firstname' => $customer->getFname(),
        'lastname' => $customer->getLname(),
        'address_street' => $customer->getAddress()->getStreetAddress(),
        'address_city' => $customer->getAddress()->getCity(),
        'address_zip' => $customer->getAddress()->getZipcode()
    ));
  }

}
