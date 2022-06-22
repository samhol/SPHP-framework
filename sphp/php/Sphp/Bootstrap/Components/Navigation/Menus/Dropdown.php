<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Navigation\Menus;

use Sphp\Html\AbstractContent;
use Sphp\Html\Lists\Li;
use Sphp\Html\ContainerTag;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Tags;

/**
 * Class Dropdown
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Dropdown extends AbstractContent {

  private li $li;
  private Ul $ul;
  private ContainerTag $toggler;

  public function __construct(string $toggler) {
    $this->li = new Li();
    $this->li->addCssClass('nav-item dropdown');
    $this->toggler = new ContainerTag('a');
    $this->toggler->addCssClass('nav-link dropdown-toggle')
            ->setAttribute('data-bs-toggle', "dropdown")
            ->setAttribute('href', "#")
            ->setAttribute('role', "button")
            ->setAttribute('aria-expanded', "false");
    $this->toggler->append($toggler);
    $this->ul = new Ul();
    $this->ul->addCssClass('dropdown-menu');
    $this->li->append($this->toggler);
    $this->li->append($this->ul);
  }

  public function __destruct() {
    unset($this->ul);
  }

  public function __clone() {
    $this->li = clone $this->li;
  }

  public function setToggler(string $content) {
    $this->toggler->resetContent($content);
    return $this;
  }

  public function appendLink(?string $href = null, $content = null, ?string $target = null): NavLink {
    $link = new NavLink($href, $content, $target);
    $link->addCssClass('dropdown-item');
    $link->removeCssClass('nav-link');
    $this->ul->append($link);
    return $link;
  }

  /**
   * Appends a divider
   * 
   * @return Div the divider appended
   */
  public function appendDivider() {
    $hr = Tags::hr()->addCssClass("dropdown-divider");
    $this->ul->append($hr);
    return $hr;
  }

  public function getHtml(): string {
    return $this->li->getHtml();
  }

}
