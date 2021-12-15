<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components;

use Sphp\Html\AbstractContent;
use Sphp\Html\Component;
use Sphp\Stdlib\Arrays;
use Sphp\Html\Navigation\A;
use Sphp\Html\Forms\Buttons\Button;
use Sphp\Html\Div;

/**
 * The Dropdown class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Dropdown extends AbstractContent {

  /**
   * @var Component
   */
  private Component $toggler;

  /**
   * @var Component[]
   */
  private array $items;

  /**
   * Constructor
   * 
   * @param mixed $toggler
   * @param array $items
   */
  public function __construct($toggler, array $items = []) {
    if (!$toggler instanceof Component) {
      $toggler = new Button($toggler);
    }
    $this->initToggler($toggler);
    $this->items = $items;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->toggler, $this->items);
  }

  /**
   * Clones the object
   *
   * **Note:** Method cannot be called directly!
   *
   * @link https://www.php.net/manual/en/language.oop5.cloning.php#object.clone PHP Object Cloning
   */
  public function __clone() {
    $this->toggler = clone $this->toggler;
    $this->items = Arrays::copy($this->items);
  }

  protected function initToggler(Component $toggler): void {
    $toggler->addCssClass('dropdown-toggle');
    $toggler->setAttribute('data-bs-toggle', 'dropdown')
            ->setAttribute('aria-haspopup', 'true')
            ->setAttribute('aria-expanded', 'false');
    $this->toggler = $toggler;
  }

  /**
   * 
   * @param  string|null $type
   * @return $this
   */
  public function setAutoClose(?string $type) {
    $this->getToggler()->setAttribute('data-bs-auto-close', $type);
    return $this;
  }

  /**
   * 
   * @param  int $x
   * @param  int $y
   * @return $this
   */
  public function setOffset(int $x, int $y) {
    $this->getToggler()->setAttribute('data-bs-offset', "$x, $y");
    return $this;
  }

  public function getToggler(): Component {
    return $this->toggler;
  }

  /**
   * 
   * @param  Component $item
   * @return $this
   */
  public function appendContent(Component $item) {

    $this->items[] = $item;
    return $this;
  }

  /**
   * 
   * @param  Component $item
   * @return $this
   */
  public function appendItem(Component $item) {
    $item->addCssClass('dropdown-item');
    $this->items[] = $item;
    return $this;
  }

  /**
   * 
   * @param  string $href
   * @param  mixed $content
   * @param  string|null $target
   * @return A
   */
  public function appendLink(string $href, $content = null, ?string $target = null): A {
    $link = new A($href, $content, $target);
    $link->addCssClass('dropdown-item');
    $this->appendItem($link);
    return $link;
  }

  /**
   * Appends a divider
   * 
   * @return Div the divider appended
   */
  public function appendDivider(): Div {
    $div = new Div();
    $div->addCssClass('dropdown-divider');
    $this->appendItem($div);
    return Div;
  }

  public function getHtml(): string {
    $div = new Div();
    $div->addCssClass('dropdown');
    $div->append($this->toggler);
    $container = new Div($this->items);
    $div->append($container);
    $container->addCssClass('dropdown-menu');
    $container->setAttribute('aria-labelledby', $this->toggler->identify());
    return (string) $div;
  }

  public static function fromButton($content, string ...$class): Dropdown {
    $button = new Button($content);
    $button->addCssClass(...$class);
    return new static($button);
  }

}
