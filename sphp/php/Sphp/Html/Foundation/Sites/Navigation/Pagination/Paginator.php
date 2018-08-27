<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Navigation\Pagination;

use Sphp\Html\AbstractComponent;
use IteratorAggregate;
use Countable;
use ArrayIterator;
use Sphp\Html\PlainContainer;
use Sphp\Html\Lists\Li;
use Sphp\Stdlib\Arrays;
use Sphp\Exceptions\OutOfRangeException;
use Traversable;

/**
 * Implements a Pagination component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/pagination.html Foundation Pagination
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Paginator extends AbstractComponent implements IteratorAggregate, Countable {

  /**
   * @var PageInterface
   */
  private $previousPageButton;

  /**
   * @var PageInterface
   */
  private $nextPageButton;

  /**
   * @var Page[] 
   */
  private $pages = [];

  /**
   * @precondition $before >= 0 && $after >= 0
   * @var int
   */
  private $before = PHP_INT_MAX, $after = PHP_INT_MAX;

  /**
   *
   * @var int 
   */
  private $current = 0;

  /**
   *
   * @var string 
   */
  private $target = '_self';

  /**
   *
   * @var string 
   */
  private $linkLabelPattern = 'Page %d';

  /**
   * Constructor
   * 
   * @param string $target
   */
  public function __construct(string $target = '_self') {
    parent::__construct('ul');
    $this->cssClasses()
            ->protect('pagination');
    $this->attributes()
            ->protect('role', 'menubar')
            ->setAria('label', 'Pagination');
    $this->target = $target;
    $this->setPreviousPageButton();
    $this->setNextPageButton();
  }

  /**
   * Sets the default pattern for the Aria label of each pagination link
   *
   * @param  string $format the format string containing 
   * @return $this for a fluent interface
   */
  public function setLinkAriaLabelPattern($format) {
    $this->linkLabelPattern = $format;
    foreach ($this->pages as $index => $page) {
      $this->setAriaLabelForPage($page, $index);
    }
    return $this;
  }

  private function setAriaLabelForPage($page, $index) {
    $page->setAriaLabel(sprintf($this->linkLabelPattern, $index));
    return $this;
  }

  /**
   * Sets the default target of each pagination links
   *
   * **Notes:**
   *
   * * The `target` attribute specifies where to open the linked document.
   * * Only used if the `href` attribute is present.
   *
   * @param  string $target the value of the target attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function setTarget(string $target) {
    $this->target = $target;
    foreach ($this->pages as $page) {
      $page->setTarget($target);
    }
    return $this;
  }

  /**
   * 
   * @param  int $index 
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\OutOfRangeException
   */
  public function setCurrentPage(int $index) {
    if (!array_key_exists($index, $this->pages)) {
      throw new OutOfRangeException("Index '$index' does not exist in the pagination");
    }
    if (array_key_exists($this->current, $this->pages)) {
      $this->getPage($this->current)->setCurrent(false);
    }
    $this->getPage($index)->setCurrent(true);
    $this->current = $index;
    return $this;
  }

  public function append(PageInterface $page): int {
    if (empty($this->pages)) {
      $this->pages[1] = $page;
    } else {
      $this->pages[] = $page;
    }
    $index = count($this->pages);
    if ($page->isCurrent()) {
      $this->setCurrentPage($index);
    }
    return $index;
  }

  /**
   * 
   * @param array $pages containing page objects or URL strings
   * @return $this
   */
  public function setPages(array $pages) {
    foreach ($pages as $page) {
      $this->append($page);
    }
    return $this;
  }

  public function setPreviousPageButton(PageInterface $prev = null) {
    if ($prev === null) {
      $this->previousPageButton = new Page(null, $prev, $this->target);
    }
    $this->previousPageButton->cssClasses()->protect('pagination-previous');
    return $this;
  }

  public function setNextPageButton(PageInterface $prev = null) {
    if ($prev === null) {
      $this->nextPageButton = new Page(null, $prev, $this->target);
    }
    $this->nextPageButton->cssClasses()->protect('pagination-next');
    return $this;
  }

  /**
   * 
   * @return PageInterface
   */
  public function getPreviousPageButton(): PageInterface {
    Arrays::pointToKey($this->pages, $this->current);
    if (prev($this->pages)) {
      $current = current($this->pages);
      $this->previousPageButton
              ->disable(false)
              ->setHref($current->getHref())
              ->setTarget($current->getTarget());
    } else {
      $this->previousPageButton->disable(true);
    }
    return $this->previousPageButton;
  }

  /**
   * 
   * @return PageInterface
   */
  public function getNextPageButton(): PageInterface {
    Arrays::pointToKey($this->pages, $this->current);
    if (next($this->pages)) {
      $next = current($this->pages);
      $this->nextPageButton
              ->disable(false)
              ->setHref($next->getHref())
              ->setTarget($next->getTarget());
    } else {
      $this->nextPageButton->disable(true);
    }
    return $this->nextPageButton;
  }

  /**
   * 
   * @return Li 
   */
  public function getEllipsis(): Li {
    $ellipsis = new Li();
    $ellipsis->cssClasses()->protect('ellipsis');
    $ellipsis->attributes()->protect('aria-hidden', 'true');
    return $ellipsis;
  }

  /**
   * Sets the number of visible pagination items before active page
   * 
   * @return $this for a fluent interface
   */
  public function showAll() {
    $this->before = true;
    $this->after = true;
    return $this;
  }

  /**
   * Sets the number of visible pagination items before active page
   * 
   * @param  int $num number of visible pagination items before active page
   * @return $this for a fluent interface
   */
  public function visibleBeforeCurrent(int $num) {
    $this->before = $num;
    return $this;
  }

  /**
   * Sets the number of visible pagination items after active page
   * 
   * @param  int $num number of visible pagination items after active page
   * @return $this for a fluent interface
   */
  public function visibleAfterCurrent(int $num) {
    $this->after = $num;
    return $this;
  }

  /**
   * Returns the page component at the specified index
   *
   * @param  int $index the index with the value
   * @return Page|null the value at the specified index or null
   */
  public function getPage($index) {
    $page = null;
    if (array_key_exists($index, $this->pages)) {
      $page = $this->pages[$index];
    }
    return $page;
  }

  /**
   * 
   * @return Page|null
   */
  public function current() {
    return $this->get($this->current);
  }

  /**
   * Returns a new iterator to iterate through inserted {@link Page} components 
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversableb {
    return new ArrayIterator($this->pages);
  }

  /**
   * Count the number of inserted {@link Page} components
   *
   * @return int number of {@link Page} components
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return count($this->pages);
  }

  public function contentToString(): string {
    $cont = new PlainContainer();
    Arrays::pointToKey($this->pages, $this->current);
    $beforeKey = key($this->pages);
    $afterKey = key($this->pages);
    $cont->append(current($this->pages));
    $before = $this->before;
    while ($before > 0 && prev($this->pages)) {
      //echo "before: $before, ";
      $beforeKey = key($this->pages);
      $cont->prepend(current($this->pages));
      $before--;
    }
    Arrays::pointToKey($this->pages, $this->current);
    $after = $this->after + $before;
    while ($after > 0 && next($this->pages)) {
      //echo "after: $after, ";
      $afterKey = key($this->pages);
      $cont->append(current($this->pages));
      $after--;
    }
    Arrays::pointToKey($this->pages, $beforeKey);
    while ($after > 0 && prev($this->pages)) {
      //echo "before: $after, ";
      $beforeKey = key($this->pages);
      $cont->prepend(current($this->pages));
      $after--;
    }
    $cont->prepend($this->getPreviousPageButton());
    $cont->append($this->getNextPageButton());
    return $cont->getHtml();
  }

}
