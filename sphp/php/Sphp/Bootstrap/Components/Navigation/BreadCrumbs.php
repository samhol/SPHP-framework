<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components\Navigation;

use IteratorAggregate;
use Countable;
use Sphp\Html\AbstractContent;
use Sphp\Html\Lists\Ol;
use Sphp\Html\Lists\Li;
use Traversable;
use Sphp\Html\Lists\HyperlinkListItem;
use Sphp\Html\Navigation\Nav;

/**
 * Implements a Breadcrumbs component
 *
 * The graphical control element {@link self} is a navigation aid used in user 
 * interfaces. It allows users to keep track of their locations 
 * within programs or documents.
 * 
 * This component shows a navigation trail for users clicking through a 
 * site or app. They'll fill out 100% of the width of their parent container.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/breadcrumbs.html Foundation Breadcrumbs
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class BreadCrumbs extends AbstractContent implements IteratorAggregate, Countable {

  private Nav $nav;
  private Ol $items;

  /**
   * Constructor
   *
   * @param string|null $ariaLabel
   */
  public function __construct(?string $ariaLabel = null) {
    $this->nav = new Nav();
    $this->nav->setAttribute('aria-label', $ariaLabel);
    $this->items = new Ol();
    $this->items->cssClasses()->protectValue('breadcrumb');
    $this->nav->append($this->items);
  }

  public function __destruct() {
    unset($this->nav, $this->items);
  }

  public function __clone() {
    $this->nav = clone $this->nav;
    $this->items = clone $this->items;
  }

  /**
   * Sets the ARIA label
   * 
   * @param  string|null $ariaLabel the ARIA label
   * @return $this
   */
  public function setAriaLabel(?string $ariaLabel = null) {
    $this->nav->setAttribute('aria-label', $ariaLabel);
    return $this;
  }

  /**
   * Creates and appends new Breadcrumb link
   *
   * **Notes:**
   * 
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   * * If the $content is empty, the $href is also the content of the object.
   *
   * @param  string $href the URL of the link
   * @param  string $content link text
   * @param  string|null $target optional target frame of the hyperlink
   * @return HyperlinkListItem appended instance
   * @link   https://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   https://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendLink(string $href, $content = null, ?string $target = null): HyperlinkListItem {
    $item = $this->items->appendLink($href, $content, $target)
            ->addCssClass('breadcrumb-item');
    return $item;
  }

  /**
   * 
   * @param  mixed $content
   * @return Li
   */
  public function appendActive($content): Li {
    $li = $this->items->append($content)
            ->addCssClass('breadcrumb-item active')
            ->setAttribute('aria-current', 'page');
    return $li;
  }

  public function getIterator(): Traversable {
    return $this->items->getIterator();
  }

  public function count(): int {
    return $this->items->count();
  }
public function buildNav():Nav {
  return clone $this->nav;
}
  public function getHtml(): string {
    return $this->nav->getHtml();
  }

}
