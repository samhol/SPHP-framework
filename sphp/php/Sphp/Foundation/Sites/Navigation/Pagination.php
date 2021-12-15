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

use Sphp\Html\AbstractComponent;
use IteratorAggregate;
use Sphp\Html\ContentIterator;
use Traversable;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Li;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Lists\HyperlinkListItem;

/**
 * Implements a Pagination component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/docs/components/pagination.html Foundation Pagination
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Pagination extends AbstractComponent implements IteratorAggregate {

  /**
   * @var HyperlinkListItem|Li|null
   */
  private $prev;

  /**
   * @var HyperlinkListItem|Li|null
   */
  private $next;

  /**
   * @var Ul
   */
  private $pages;

  /**
   * Constructor
   * 
   * @param string $ariaLabel
   */
  public function __construct(string $ariaLabel = null) {
    parent::__construct('nav');
    $this->attributes()->setAria('label', $ariaLabel);
    $this->pages = [];
  }

  public function __destruct() {
    unset($this->pages, $this->prev, $this->next);
    parent::__destruct();
  }

  /**
   * Creates and appends new pagination link
   *
   * **Notes:**
   * 
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a tag is not a hyperlink.
   * * If the $content is empty, the $href is also the content of the object.
   *
   * @param  string $href the URL of the link
   * @param  string $content link text
   * @param  string|null $ariaLabel optional target frame of the hyperlink
   * @return Hyperlink appended instance
   * @link   https://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   https://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendLink(string $href, string $content = null, string $ariaLabel = null): Hyperlink {
    $item = new HyperlinkListItem($href, $content);
    $item->getHyperlink()->attributes()->setAria('label', $ariaLabel);
    $this->pages[] = $item;
    return $item;
  }

  /**
   * 
   * @param  string $content
   * @param  string $ariaLabel
   * @return Li
   */
  public function appendDisabled(string $content, string $ariaLabel = null) {
    $item = new Li($content);
    $item->addCssClass('disabled');
    $item->attributes()->setAria('label', $ariaLabel);
    $this->pages[] = $item;
    return $item;
  }

  /**
   * 
   * @param string $content
   * @param string $ariaLabel
   * @return Li
   */
  public function appendCurrent(string $content, string $ariaLabel = null) {
    $item = new Li($content);
    $item->attributes()->setAria('label', $ariaLabel);
    $this->pages[] = $item;
    return $item;
  }

  /**
   * 
   * @return mixed 
   */
  public function appendEllipsis() {
    $ellipsis = new Li();
    $ellipsis->cssClasses()->protectValue('ellipsis');
    $ellipsis->attributes()->protect('aria-hidden', 'true');
    $this->pages[] = $ellipsis;
    return $ellipsis;
  }

  /**
   * 
   * @param string $ariaLabel
   * @param string $label
   * @return type
   */
  public function usePreviousNextPageButton(string $ariaLabel = null, string $label = null) {
    $this->prev = new Li($label);
    $this->prev->addCssClass('pagination-previous disabled');
    $this->prev->attributes()->setAria('label', $ariaLabel);
    return $this->prev;
  }

  /**
   * 
   * @param string $url
   * @param string $ariaLabel
   * @param string $label
   * @return Hyperlink
   */
  public function usePreviousPageButton(string $url = null, string $ariaLabel = null, string $label = null): Hyperlink {
    $this->prev = new HyperlinkListItem($url, $label);
    $this->prev->setRelationship('prev');
    $this->prev->cssClasses()->protectValue('pagination-previous');
    $this->prev->getHyperlink()->attributes()->setAria('label', $ariaLabel);
    return $this->prev;
  }

  /**
   * 
   * @param  string $ariaLabel
   * @param  string $label
   * @return type
   */
  public function useDisabledNextPageButton(string $ariaLabel = null, string $label = null) {
    $this->next = new Li($label);
    $this->next->addCssClass('pagination-next disabled');
    $this->next->attributes()->setAria('label', $ariaLabel);
    return $this->next;
  }

  /**
   * 
   * @param  string $url
   * @param  string $label
   * @return Hyperlink
   */
  public function useNextPageButton(string $url = null, string $ariaLabel = null, string $label = null): Hyperlink {
    $this->next = new HyperlinkListItem($url, $label);
    $this->next->setRelationship('next');
    $this->next->cssClasses()->protectValue('pagination-next');
    $this->next->getHyperlink()->attributes()->setAria('label', $ariaLabel);
    return $this->next;
  }

  /**
   * Returns a new iterator to iterate through pagination components
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    $items = $this->pages;
    if ($this->prev !== null) {
      array_unshift($items, $this->prev);
    }
    if ($this->next !== null) {
      $items[] = $this->next;
    }
    return new ContentIterator($items);
  }

  public function contentToString(): string {
    $ul = new Ul($this->pages);
    $ul->addCssClass('pagination');
    if ($this->prev !== null) {
      $ul->prepend($this->prev);
    }
    if ($this->next !== null) {
      $ul->append($this->next);
    }
    return $ul->getHtml();
  }

}
