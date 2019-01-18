<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use IteratorAggregate;
use Sphp\Html\AbstractComponent;
use Sphp\Html\Lists\Ul;
use Sphp\Html\TraversableContent;
use Sphp\Html\TraversableTrait;
use Traversable;

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
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/breadcrumbs.html Foundation Breadcrumbs
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class BreadCrumbs extends AbstractComponent implements IteratorAggregate, TraversableContent {

  use TraversableTrait;

  private $items;

  /**
   * Constructor
   *
   * @param mixed $content the value of the target attribute
   */
  public function __construct($content = null) {
    parent::__construct('nav', null);
    $this->cssClasses()->protectValue('breadcrumbs');
    $this->items = new Ul();
    $this->items->cssClasses()->protectValue('breadcrumbs');
    //$this->attributes()->lock('role', 'navigation');
    $this->attributes()->setAttribute('aria-label', 'breadcrumbs');
    if ($content !== null) {
      foreach (is_array($content) ? $content : [$content] as $breadcrumb) {
        $this->append($breadcrumb);
      }
    }
  }

  /**
   * Creates and prepends new {@link BreadCrumb} to the container
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
   * @return BreadCrumb prepended instance
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function prependNew(string $href, $content = null, string $target = null): BreadCrumb {
    $item = new BreadCrumb($href, $content, $target);
    $this->prepend($item);
    return $item;
  }

  /**
   * Creates and appends new BreadCrumb link
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
   * @return BreadCrumb appended instance
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendLink(string $href, $content = null, string $target = null): BreadCrumb {
    $item = new BreadCrumb($href, $content, $target);
    $this->append($item);
    return $item;
  }

  /**
   * Prepends a BreadCrumb component to the container
   *
   * @param  BreadCrumb $breadcrumb component to append
   * @return $this for a fluent interface
   */
  public function prepend(BreadCrumb $breadcrumb) {
    $this->items->prepend($breadcrumb);
    return $this;
  }

  /**
   * Appends a BreadCrumb to the container
   *
   * @param  BreadCrumb $breadcrumb component to append
   * @return $this for a fluent interface
   */
  public function append(BreadCrumb $breadcrumb) {
    $this->items->append($breadcrumb);
    return $this;
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
