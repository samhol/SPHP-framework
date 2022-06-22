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

use Countable;

/**
 * Class CartRow
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CartRow implements Countable {

  private string $id;

  /**
   * @var Product[]
   */
  private array $products = [];

  public function __construct(Product $product) {
    $this->id = $product->getId();
    $this->products[] = $product;
  }

  public function getId(): string {
    return $this->id;
  }

  public function addProduct(Product $product): void {
    if ($product->getId() === $this->getId()) {
      $this->products[] = $product;
    }
  }

  public function count(): int {
    return count($this->products);
  }

  public function getTitle(): string {
    return $this->getProduct()->getName();
  }

  public function getProductId(): string {
    return $this->getProduct()->getId();
  }
  public function getProduct(): Product {
    return $this->products[0];
  }

  public function getPrice(): int {
    return $this->getProduct()->getPrice() * $this->count();
  }

  public function getTax(): int {
    return $this->getProduct()->getTax();
  }

  public function getPretaxPrice(): int {
    return $this->getProduct()->getPretaxPrice() * $this->count();
  }

}
