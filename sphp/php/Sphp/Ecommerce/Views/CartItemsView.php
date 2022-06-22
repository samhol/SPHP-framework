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

use Sphp\Html\AbstractContent;
use Sphp\Bootstrap\Layout\Container;
use Sphp\Bootstrap\Components\ButtonGroup;
use Sphp\Bootstrap\Components\Modal;
use Sphp\Bootstrap\Layout\Row;
use Sphp\Html\Layout\Div;
use Sphp\Ecommerce\Data\Cart;
use Sphp\Ecommerce\Data\Product;
use Shining\Store\Views\Utils;
use Shining\Store\Views\ProductView;

/**
 * The CartItemsView class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CartItemsView extends AbstractContent {

  private Cart $cart;
  private Modal $modal;

  public function __construct(Cart $cart) {
    $this->cart = $cart;
    $this->modal = $this->buildInfoModal();
  }

  public function __destruct() {
    unset($this->cart, $this->modal);
  }

  private function buildInfoModal(): Modal {
    $modal = new Modal();
    $modal->setSize('lg');
    $modal->setScrollable(true);
    $modal->setFullScreen('lg-down');
    $modal->identify('jewel-info-modal');
    $modal->getHeader()->append('Ladataan tietoja...');
    $modal->getBody()->append('<strong>Ladataan tietoja...</strong>');
    // $modal->getFooter()->append($b = new Button('Valitse'));
    // $b->setAttribute('data-select-jewelry', true);
    return $modal;
  }

  public function buildView(): Container {
    $modal = $this->buildInfoModal();

    $container = new Container;
    $container->appendH3('Ostoskorisi sisältää <span class="counter">' . count($this->cart->getItems()) . '</span> tuotetta')
            ->addCssClass('cart');
    $container->addCssClass('g-0 g-md-3 cart');
    //$container->append($ul);
    $container->append($modal);
    foreach ($this->cart->getItems() as $rowNo => $product) {
      $container->append($this->cartItemRow($rowNo, $product));
    }
    $container->append($this->buildTotalRow());
    return $container;
  }

  public function cartItemRow(int $rowNo, Product $product): Row {
    $row = new Row();
    $row->addCssClass('product-row gx-0 p-1 mb-1');
    $img = ProductView::buildPhoto($product)->setSize(70, 70)->addCssClass('rounded');
    $row->appendColumn($img)->default('auto');

    $nameDiv = new Div($product->getName());
    $nameDiv->addCssClass('product-title');
    $idDiv = new Div('<strong>tuotenumero:</strong><wbr> <var>' . $product->getId() . '</var>');
    $idDiv->addCssClass('product-id');
    $col = new \Sphp\Bootstrap\Layout\Col;
    $col->append($nameDiv);
    $col->append($idDiv);
    $col->addCssClass('p-1');
    $row->appendColumn($col);
    $this->modal->createTrigger($col);
    $row->appendColumn(Utils::formatPrice($product->getPrice()))->default('auto price pe-2');
    $row->appendColumn($this->buildButtons($rowNo))->default('auto');
    return $row;
  }

  public function buildTotalRow(): Row {
    $row = new Row();
    $row->addCssClass('justify-content-end gx-0 p-1 mb-1 total-row');

    $row->appendColumn(Utils::formatPrice($this->cart->getTotal()))->default('auto price total pe-2');

    $group = new ButtonGroup();
    $removeBtn = $group->appendPushButton('<i class="fas fa-times fa-fw"></i><span class="sr-only">Poista</span>')
            ->setName('clear-cart')
            ->addCssClass('btn-sm btn-outline-danger');
    $removeBtn->setAttribute('data-ecommerce-cart-empty', true);
    $row->appendColumn($group)->default('auto');
    return $row;
  }

  public function buildProductInfo(Product $product) {
    return number_format($product->getPrice(), 2, ',', ' ') . " €";
  }

  public function buildButtons(int $rowNo) {
    $group = new ButtonGroup();
    $removeBtn = $group->appendPushButton('<i class="fas fa-times fa-fw"></i><span class="sr-only">Poista</span>')
            ->addCssClass('btn-sm btn-outline-danger');
    //$removeBtn->setAttribute('data-jewel-cart-del', $product->getId());
    $removeBtn->setName('del-product')->setValue($rowNo);
    return $group;
  }

  public function getHtml(): string {
    return $this->buildView()->getHtml();
  }

}
