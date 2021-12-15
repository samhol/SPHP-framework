<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Foundation\Sites\Navigation;

use IteratorAggregate;
use Sphp\Html\AbstractComponent;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Li;
use Sphp\Html\TraversableContent;
use Sphp\Html\TraversableTrait;
use Traversable;
use Sphp\Html\Lists\HyperlinkListItem;

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
class BreadCrumbs extends AbstractComponent implements IteratorAggregate, TraversableContent {

  use TraversableTrait;

  /**
   * @var Ul
   */
  private $items;

  /**
   * Constructor
   *
   * @param mixed $content the value of the target attribute
   */
  public function __construct($content = null) {
    parent::__construct('nav', null);
    $this->items = new Ul();
    $this->items->cssClasses()->protectValue('breadcrumbs');
    //$this->attributes()->lock('role', 'navigation');
    //$this->attributes()->setAttribute('aria-label', 'breadcrumbs');
    if ($content !== null) {
      foreach (is_array($content) ? $content : [$content] as $breadcrumb) {
        $this->append($breadcrumb);
      }
    }
  }

  public function __destruct() {
    unset($this->items);
    parent::__destruct();
  }

  /**
   * Creates and appends new Breadcrumb link
   *
   *
   * @param  mixed $content
   * @return HyperlinkListItem appended instance
   * @link   https://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   https://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function append($content): Li {
    $item = $this->items->append($content);
    return $item;
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
  public function appendLink(string $href, $content = null, string $target = null): HyperlinkListItem {
    // $item = new BreadCrumb($href, $content, $target);
    $item = $this->items->appendLink($href, $content, $target);
    return $item;
  }

  public function appendDisabled($content): Li {
    return $this->items->append($content)->addCssClass('disabled');
  }

  public function appendCurrent($content): Li {
    return $this->items->append($content)->addCssClass('active');
  }

  public function getIterator(): Traversable {
    return $this->items->getIterator();
  }

  public function count(): int {
    return $this->items->count();
  }

  public function contentToString(): string {
    return $this->items->getHtml();
  }

}
