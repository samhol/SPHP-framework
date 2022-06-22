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
use Sphp\Html\Lists\Ul;

/**
 * Class Menu
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Menu extends AbstractContent {

  private Ul $ul;

  public function __construct() {
    $this->ul = new Ul();
    $this->ul->addCssClass('nav');
  }

  public function __destruct() {
    unset($this->ul);
  }

  public function __clone() {
    $this->ul = clone $this->ul;
  }

  public function addCssClass($class) {
    $this->ul->addCssClass($class);
  }

  public function append(mixed  $content) { 
    $this->ul->append($content)->addCssClass('nav-item');
    return $this;
  }
  public function appendLink(?string $href = null, $content = null, ?string $target = null): NavLink {
    $link = new NavLink($href, $content, $target);
    $this->ul->append($link)->addCssClass('nav-item');
    return $link;
  }

  public function appendDropdown(?string $content): Dropdown {
    $dropdown = new Dropdown($content);
    $this->ul->append($dropdown)->addCssClass('nav-item dropdown');
    return $dropdown;
  }
  public function getHtml(): string {
    return $this->ul->getHtml();
  }

}
