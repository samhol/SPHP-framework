<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Ecommerce\Views;

use Sphp\Bootstrap\Layout\Container;
use Sphp\Ecommerce\Data\Product;
use Sphp\Ecommerce\Data\Cart;
use Sphp\Html\AbstractContent;
use Sphp\Bootstrap\Layout\Col;

/**
 * Class ProductsView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ProductsView extends AbstractContent {

  /**
   * @var Product[]
   */
  private iterable $products;
  private ?Cart $cart;

  public function __construct(iterable $products, ?Cart $cart = null) {
    $this->products = $products;
    $this->cart = $cart;
  }

  public function buildView(): string {
    $container = new Container();
    $container->addCssClass('product-list p-2');
    $row = $container->appendRow()->default(1)->sm(2)->md(3)->xl(4);
    $row->addCssClass('g-3 px-lg-3');

    foreach ($this->products as $product) {
      $view = new ProductView($product);
      $col = $view->buildCol();
      $row->appendColumn($col);
    }
    $count = count($this->products);
    while ($count < 4) {
      $dummy = new Col();
      $dummy->addCssClass('d-flex')->content()->appendDiv()->addCssClass('dummy flex-fill');
      $row->appendColumn($dummy);
      $count++;
    }
    $container->appendDiv('Total ' . count($this->products) . ' products');
    return $container->getHtml();
  }

  public function getHtml(): string {
    return $this->buildView();
  }

}
