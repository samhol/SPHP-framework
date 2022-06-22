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

use IteratorAggregate;
use Traversable;
use Countable;
use Sphp\Data\Geographical\Address;

/**
 * The Cart class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Cart implements IteratorAggregate, Countable {

  private string $id;
  private ?Customer $customer = null;
  private ?Address $shippingAddress = null;

  /**
   * @var CartRow[]
   */
  private array $productData = [];

  /**
   * @var Product[]
   */
  private array $products;

  public function __construct(?string $id = null) {
    $this->products = [];
    if ($id === null) {
      $id = 'example_payment_' . time();
    }
    $this->id = $id;
  }

  public function __destruct() {
    unset($this->products, $this->customer, $this->shippingAddress);
  }

  public function getId(): string {
    return $this->id;
  }

  public function addProduct(Product $product) {
    $this->products[] = $product;
    if (array_key_exists($product->getId(), $this->productData)) {
      $this->productData[$product->getId()]->addProduct($product);
    } else {
      $this->productData[$product->getId()] = new CartRow($product);
    }
    return $this;
  }

  public function containsProduct(Product $product): bool {
    return array_key_exists($product->getId(), $this->productData);
  }

  public function getProductRow($id): ?CartRow {
    if (array_key_exists($id, $this->productData)) {
      $out = $this->productData[$id];
    } else {
      $out = null;
    }
    return $out;
  }

  public function removeProductsById($id) {
    $this->products = array_filter($this->products, function (Product $p) use ($id) {
      return $p->getId() !== $id;
    });
    return $this;
  }

  public function removeProductRow(int $row) {
    unset($this->products[$row]);
    return $this;
  }

  public function setCustomer(Customer $customer) {
    $this->customer = $customer;
    return $this;
  }

  public function getCustomer(): ?Customer {
    return $this->customer;
  }

  public function getShippingAddress(): ?Address {
    return $this->shippingAddress;
  }

  public function setShippingAddress(?Address $shippingAddress) {
    $this->shippingAddress = $shippingAddress;
    return $this;
  }

  public function getItems(): iterable {
    return $this->products;
  }

  public function getTotal(): int {
    $total = 0;
    foreach ($this->productData as $product) {
      $total += $product->getPrice();
    }
    return $total;
  }

  public function count(?Product $product = null): int {
    $count = 0;
    if ($product !== null) {
      if ($this->containsProduct($product)) {
        $id = $product->getId();
        $count = $this->productData[$id]->count();
      }
    } else {
      foreach ($this->productData as $productRow) {
        $count += $productRow->count();
      }
    }
    return $count;
  }

  public function isEmpty(): bool {
    return $this->count() === 0;
  }

  public function getGroups(): Traversable {
    yield from $this->productData;
  }

  public function getIterator(): Traversable {
    yield from $this->products;
  }

  public function toArray(): array {
    $out = [];
    $out['products'] = [];
    foreach ($this->products as $product) {
      if (!isset($out['products'][$product->getId()])) {
        $out['products'][$product->getId()]['product'] = $product->toArray();
        $out['products'][$product->getId()]['count'] = 1;
      } else {
        $out['products'][$product->getId()]['count'] += 1;
      }
    }
    $out['subtotal'] = $this->getTotal();
    $out['count'] = $this->count();
    return $out;
  }

  public static function fromSession(): Cart {
    //$_SESSION['cart'] = 'foo';
    //unset($_SESSION['cart']);
    if (!isset($_SESSION['cart'])) {
      $cart = new Cart();
      $_SESSION['cart'] = serialize($cart);
    } else {
      try {
        $cart = unserialize($_SESSION['cart']);
      } catch (\Error $ex) {
        $cart = new Cart();
      }
    }
    return $cart;
  }

}
