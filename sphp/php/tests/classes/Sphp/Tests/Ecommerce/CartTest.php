<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Ecommerce;

use PHPUnit\Framework\TestCase;
use Sphp\Ecommerce\Data\Cart;
use Sphp\Ecommerce\Data\Product;

/**
 * The CartTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CartTest extends TestCase {

  public function createProduct($id, $name, $price): Product {
    $product = new Class() implements Product {

      public $id;
      public string $name;
      public float $price;

      public function getName(): string {
        return $this->name;
      }

      public function getPrice(): float {
        return $this->price;
      }

      public function getId() {
        return $this->id;
      }
    };
    $product->id = $id;
    $product->name = $name;
    $product->price = $price;
    return $product;
  }

  public function testConstructor(): Cart {
    $cart = new Cart();
    $this->assertSame(0.0, $cart->getTotal());
    $this->assertEmpty($cart->getItems());
    $this->assertNull($cart->getCustomer());
    $this->assertCount(0, $cart);
    return $cart;
  }

  /**
   * @depends testConstructor
   * 
   * @param Cart $cart
   */
  public function testAddProduct(Cart $cart): Cart {
    $p1 = $this->createProduct('foo', 'bar', 1.34);
    $this->assertSame(0, $cart->count($p1));
    $tot = 1.34;
    $cart->addProduct($p1);
    $this->assertSame(1, $cart->count($p1));
    $this->assertCount(1, $cart);
    $this->assertSame($p1->getPrice(), $cart->getTotal());
    $this->assertSame($tot, $cart->getTotal());
    return $cart;
  }

  /**
   * @depends testAddProduct
   * 
   * @param Cart $cart
   */
  public function testAddSameProductAgain(Cart $cart) {
    $p2 = $this->createProduct('baz', 'duh', 300.2);
    $tot = $cart->getTotal();
    $cart->addProduct($p2);
    $tot += $p2->getPrice();
    $this->assertSame(1, $cart->count($p2));
    $this->assertCount(2, $cart);
    $this->assertSame($tot, $cart->getTotal());
    $cart->addProduct($p2);
    $tot += $p2->getPrice();
    $this->assertSame(2, $cart->count($p2));
    $this->assertCount(3, $cart);
    $this->assertSame($tot, $cart->getTotal());
    //$this->assertEqualsCanonicalizing([$p1, $p2], iterator_to_array($cart));
  }

}
