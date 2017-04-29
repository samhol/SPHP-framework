<?php

/**
 * Breadcrumbs.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation;

use IteratorAggregate;
use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\Lists\Ul;
use Sphp\Html\TraversableInterface;
use Sphp\Html\TraversableTrait;

/**
 * Implements a Breadcrumbs component
 *
 * The graphical control element {@link self} is a navigation aid used in user 
 * interfaces. It allows users to keep track of their locations 
 * within programs or documents.
 * 
 * {@link self} component shows a navigation trail for users clicking through a 
 * site or app. They'll fill out 100% of the width of their parent container.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-12-01
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/breadcrumbs.html Foundation Breadcrumbs
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BreadCrumbs extends AbstractContainerComponent implements IteratorAggregate, TraversableInterface {

  use TraversableTrait;

  /**
   * Constructs a new instance
   *
   * @param mixed $content the value of the target attribute
   */
  public function __construct($content = null) {
    $ul = new Ul();
    $ul->cssClasses()->lock('breadcrumbs');
    parent::__construct('nav', null, $ul);
    $this->cssClasses()->lock('breadcrumbs');
    //$this->attrs()->lock('role', 'navigation');
    $this->attrs()->set('aria-label', 'breadcrumbs');
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
   * @param  string $target the value of the target attribute
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function prependNew($href = '', $content = null, $target = '_self') {
    $this->prepend(new BreadCrumb($href, $content, $target));
    return $this;
  }

  /**
   * Creates and appends new {@link BreadCrumb} to the container
   *
   * **Notes:**
   * 
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   * * If the $content is empty, the $href is also the content of the object.
   *
   * @param  string $href the URL of the link
   * @param  string $content link text
   * @param  string $target the value of the target attribute
   * @return self for a fluent interface
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendNew($href = '', $content = null, $target = '') {
    $this->append(new BreadCrumb($href, $content, $target));
    return $this;
  }

  /**
   * Prepends a {@link BreadCrumb} component to the container
   *
   * @param  BreadCrumb $breadcrumb component to append
   * @return self for a fluent interface
   */
  public function prepend(BreadCrumb $breadcrumb) {
    $this->getInnerContainer()->prepend($breadcrumb);
    return $this;
  }

  /**
   * Appends a BreadCrumb to the container
   *
   * @param  BreadCrumb $breadcrumb component to append
   * @return self for a fluent interface
   */
  public function append(BreadCrumb $breadcrumb) {
    $this->getInnerContainer()->append($breadcrumb);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function getIterator() {
    return $this->getInnerContainer()
                    ->getComponentsByObjectType(BreadCrumb::class)
                    ->getIterator();
  }

  /**
   * {@inheritdoc}
   */
  public function count() {
    return $this->getInnerContainer()->count();
  }

}
