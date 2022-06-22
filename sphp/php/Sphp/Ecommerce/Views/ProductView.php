<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Ecommerce\Views;

use Sphp\Html\AbstractContent;
use Sphp\Ecommerce\Data\Product;
use Sphp\Ecommerce\Data\Cart;
use Sphp\Bootstrap\Layout\Container;
use Sphp\Bootstrap\Layout\Col;
use Sphp\Html\Tags;
use Sphp\Html\Forms\Buttons\PushButton;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Layout\Aside;
use Sphp\Html\Navigation\A;
use Sphp\Html\Media\Img;

/**
 * Class CarView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ProductView extends AbstractContent {

  private Product $product;
  private ?Cart $cart;

  public function __construct(Product $product, ?Cart $cart = null) {
    $this->product = $product;
    if ($cart === null) {
      $cart = Cart::fromSession();
    }
    $this->cart = $cart;
  }

  public function __destruct() {
    unset($this->product, $this->cart);
  }

  public function buildCartCountBadge(int $param, ?string $hiddenText = null) {
    $badge = \Sphp\Html\Tags::span($param)->addCssClass('badge rounded-pill bg-danger');
    $badge->append($hiddenText)->addCssClass('visually-hidden');
    return $badge;
  }

  public function buildSelectProductButton(): PushButton {
    if ($this->product->available) {
      $btn = new PushButton('<i class="fas fa-shopping-basket fa-fw"></i> Lisää ostoskoriin');
      $btn->addCssClass('btn btn-success position-relative');
      $btn->setName('product');
      $btn->setValue($this->product->getId());
      //$btn->setAttribute('data-select-product', $this->product->getId());

      $cartCount = $this->cart->count($this->product);
      $btn->append($badge = Utils::createCounterBadge($cartCount)->addCssClass('product'));
      if ($this->cart->count($this->product) === 0) {
        $badge->addCssClass('hidden');
      }
    } else {
      $btn = new PushButton('<i class="fas fa-exclamation-triangle"></i> Ei Saatavilla');
      $btn->addCssClass('btn btn-outline-danger');
      $btn->disable(true);
    }
    return $btn;
  }

  public function buildCol(): Col {
    $out = new Col();
    $out->addCssClass('d-flex');
    $card = $out->content()->appendDiv()->addCssClass('card flex-fill');
    $img = $this->buildPhoto();
    $img->addCssClass('card-img-top')
            ->setLoading('lazy');
    $card->append($this->buildDetailsHyperlink($img));
    $cardBody = $card->appendDiv()->addCssClass('card-body');
    $cardBody->appendDiv($this->product->getName());
    $cardBody->appendDiv(Utils::formatPrice($this->product->getPrice()))->addCssClass('price mb-auto');
    $cardBody->append('<div class="d-grid gap-2">' . $this->buildSelectProductButton() . '</div>');

    return $out;
  }

  private function buildDetailsHyperlink($content): A {
    $infoBtn = new A('/tuote/' . $this->product->id, $content);
    $infoBtn->setRelationship('nofollow');
    return $infoBtn;
  }

  public function buildFullInfo(): Container {
    $out = new Container('fluid');
    $out->addCssClass('jewel-info');
    $row = $out->appendRow()->default(1)->md(2);
    $col1 = $row->appendColumn();
    $col2 = $row->appendColumn();
    $selectButton = new PushButton('Valitse');
    $selectButton->addCssClass('btn btn-sm btn-outline-secondary');
    $selectButton->setAttribute('data-select-jewelry', $this->product->id);
    $card = $col1->content()->appendDiv()->addCssClass('  flex-fill');
    $card->appendImg("/myynti/kuvat/{$this->product->photo}")->addCssClass('card-img-top')->setLoading('lazy');
    $cardBody = $col2->content()->appendDiv()->addCssClass('card-body');
    $cardBody->appendParagraph($this->product->getName());
    $cardBody->append($this->buildDetails($this->product->info));
    $cardBody->appendDiv(Utils::formatPrice($this->product->getPrice()))->addCssClass('price');
    return $out;
  }

  public function buildProductDetailView(): Container {
    $out = new Container();
    $out->addCssClass('p-1 p-md-2');
    //$out->appendH2("{$this->product->name}");
    $out->addCssClass('full-product-info');
    $row = $out->appendRow()->default(1)->md(2);
    $photoColumn = $row->appendColumn(); //->default(12)->md(6);
    $photoColumn->addCssClass('product-photo');
    $infoColumn = $row->appendColumn(); //->default(12)->md(6); 
    //
    $infoColumn->addCssClass('product-information');
    //$out->addCssClass('d-flex');
    $card = $photoColumn->content()->appendDiv();
    $card->appendImg("/myynti/kuvat/{$this->product->photo}")
            ->addCssClass('card-img-top img-thumbnail')
            ->setLoading('lazy');
    $productInfoAside = new Aside();
    $productInfoAside->appendDiv($this->buildProductName());
    //  $productInfoAside->appendDiv("Tuotetyyppi: ".$this->product->type)->addCssClass('product-type');
    $infoColumn->append($productInfoAside);
    $productInfoAside->appendDiv('Tuotetiedot:');
    $productInfoAside->append($this->buildDetails($this->product->info));
    $productInfoAside->appendDiv(Utils::formatPrice($this->product->getPrice()))->addCssClass('price');
    $productInfoAside->append($b = $this->buildSelectProductButton());
    $b->addCssClass('btn-lg');
    return $out;
  }

  public function buildPhoto(): Img {
    $img = new Img($this->product->getImgPath());
    $img->setLoading('lazy');
    return $img;
  }

  private function buildProductName() {
    $out = Tags::span($this->product->getName())->addCssClass('name') . ' - ';
    $out .= Tags::span($this->product->type)->addCssClass('type');
    return $out;
  }

  private function buildDetails(array $details): Ul {
    $ul = new Ul();
    foreach ($details as $type => $value) {
      $ul->append("<strong>$type:</strong> $value");
    }
    return $ul;
  }

  public function buildHeading(): string {
    $cat = ucfirst($this->product->category);
    return "<strong>{$cat}:</strong> {$this->product->name}";
  }

  public function getHtml(): string {
    return $this->buildProductDetailView()->getHtml();
  }

}
