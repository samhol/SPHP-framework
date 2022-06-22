<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Ecommerce\Views;

use Sphp\Html\AbstractContent;
use Sphp\Ecommerce\Data\Cart;
use Sphp\Html\Layout\Section;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Dl;
use Sphp\Ecommerce\Data\Customer;
use Sphp\Ecommerce\Data\CartRow;
use Sphp\Bootstrap\Layout\Container;
use Sphp\Bootstrap\Layout\Row;
use Shining\Store\Views\ProductView;
use Sphp\Html\Layout\Div;
use Shining\Store\Views\Utils;

/**
 * The FullCart class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FullCart extends AbstractContent {

  private Cart $cart;

  public function __construct(Cart $cart) {
    $this->cart = $cart;
  }

  public function __destruct() {
    unset($this->cart);
  }

  public function buildCustomerView(Customer $customer): Ul {
    $out = new Ul();
    $out->addCssClass('customer-data');
    $out->append('<strong>' . $customer->getFname() . ' ' . $customer->getLname() . '</strong>');
    $out->append('<strong>Sähköpostiosoite:</strong> ' . $customer->getEmail());
    $out->append('<strong>Puhelinnumero:</strong> ' . $customer->getPhonenumber());
    $addrul = new Dl();
    $out->append($addrul);
    $addrul->addCssClass('address-data');
    $addrul->appendTerm('Osoite: ');
    $addrul->appendDescription($customer->getAddress()->getStreetAddress());
    $addrul->appendDescription($customer->getAddress()->getZipcode() . ' ' . $customer->getAddress()->getCity());
    $addrul->appendDescription($customer->getAddress()->getCountry());
    return $out;
  }

  public function buildProductsView(): Container {

    $container = new Container;
    $container->appendH3('Ostoskorisi sisältää <span class="counter">' . count($this->cart->getItems()) . '</span> tuotetta')
            ->addCssClass('cart');
    $container->addCssClass('g-0 g-md-3 cart');
    foreach ($this->cart->getGroups() as $product) {
      $container->append($this->cartItemRow($product));
    }
    $container->append($this->buildTotalRow());
    // $container->append($this->buildTotalRow());
    return $container;
  }

  public function cartItemRow(CartRow $product): Row {
    $row = new Row();
    $row->addCssClass('product-row gx-0 p-1 mb-1');
    //$row->appendColumn('<strong>' . $product->count() . ' x </strong>')->default('auto');
    $img = ProductView::buildPhoto($product->getProduct())->setSize(100, 100)->addCssClass('rounded');
    $row->appendColumn($img)->default('auto');

    $nameDiv = new Div($product->getTitle());
    $nameDiv->addCssClass('product-title');
    $idDiv = new Div('<strong>tuotenumero:</strong><wbr> <var>' . $product->getId() . '</var>');
    $idDiv->addCssClass('product-id');
    $col = new \Sphp\Bootstrap\Layout\Col;
    $col->append($nameDiv);
    $col->append($idDiv);
    $col->append($this->buildPriceCell($product));
    $col->addCssClass('p-1');
    $row->appendColumn($col);
    return $row;
  }

  public function buildPriceCell(CartRow $product): Row {
    $row = new Row();
    $row->addCssClass('price g-0');
    $unitPrice = new Div();
    $unitPrice->appendSpan($product->count())
            ->addCssClass('product-count');
    $unitPrice->appendSpan(' x ')
            ->addCssClass('times');
    $unitPrice->append(Utils::formatPrice($product->getProduct()->getPrice()));
    $row->appendColumn($unitPrice)
            ->default(6)
            ->addCssClass('ps-3');
    $row->appendColumn(Utils::formatPrice($product->getPrice())->addCssClass('total-price'))
            ->default(6)
            ->addCssClass('text-end pe-3');

    return $row;
  }

  public function buildTotalRow(): Row {
    $row = new Row();
    $row->addCssClass('justify-content-end gx-0 p-1 mb-1 total-row');
    $row->appendColumn(Utils::formatPrice($this->cart->getTotal()))->default('auto price total pe-2');
    return $row;
  }

  public function getHtml(): string {
    $out = new Section();
    $out->addCssClass('cart-data');
    if ($this->cart->getCustomer() !== null) {
      $out->append($this->buildCustomerView($this->cart->getCustomer()));
    }
    $out->append($this->buildProductsView());
    return $out->getHtml();
  }

}
