<?php

/**
 * Pagination.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Navigation\Pagination;

use Sphp\Html\AbstractComponent;
use IteratorAggregate;
use Countable;
use ArrayIterator;
use Sphp\Html\Container;
use Sphp\Html\Lists\Li as Li;

/**
 * Class Models Foundation Pagination component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-20
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/pagination.html Foundation Pagination
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Pagination extends AbstractComponent implements IteratorAggregate, Countable {

  /**
   *
   * @var int 
   */
  private $counter = 0;

  /**
   *
   * @var Page[] 
   */
  private $pages = [];

  /**
   *
   * @var int
   */
  private $range = 20;

  /**
   *
   * @var int 
   */
  private $current = 1;

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
   * Constructs a new instance
   * 
   * @param mixed|mixed[] $urls the value of the target attribute
   */
  public function __construct(array $urls = null, $range = 20, $target = '_self') {
    parent::__construct('ul');
    $this->cssClasses()
            ->lock('pagination');
    $this->attrs()
            ->lock('role', 'menubar')
            ->setAria('label', 'Pagination');
    $this->range = $range;
    $this->target = $target;
    if ($urls !== null) {
      foreach ($urls as $page) {
        $this->addUrls($page);
      }
    }
  }

  /**
   * Sets the default pattern for the Aria label of each pagination link
   *
   * @param  string $format the format string containing 
   * @return self for PHP Method Chaining
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
   * Sets the pattern for the default target of each pagination links
   *
   * **Notes:**
   *
   * * The `target` attribute specifies where to open the linked document.
   * * Only used if the `href` attribute is present.
   *
   * @param  string $target the value of the target attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function setTarget($target) {
    $this->target = $target;
    foreach ($this->pages as $page) {
      $page->setTarget($target);
    }
    return $this;
  }

  /**
   * 
   * @param  int $index
   * @return self for PHP Method Chaining
   */
  public function setCurrent($index) {
    if (array_key_exists($index, $this->pages)) {
      $this->current = $index;
      foreach ($this->pages as $id => $page) {
        if ($id !== $index) {
          $page->setCurrent(false);
        } else {
          $page->setCurrent(true);
        }
      }
    }
    return $this;
  }

  /**
   * 
   * @param  int $range
   * @return self for PHP Method Chaining
   */
  public function setRange($range) {
    $this->range = $range;
    return $this;
  }

  /**
   * 
   * @param  string|string[] $urls
   * @return self for PHP Method Chaining
   */
  public function addUrls($urls) {
    if (is_array($urls)) {
      foreach ($urls as $url) {
        $this->addUrls($url);
      }
    } else {
      $this->counter += 1;
      $page = new Page($this->counter, $urls, $this->target);
      $this->setAriaLabelForPage($page, $this->counter);
      if ($page->isCurrentUrl()) {
        $page->setCurrent(true);
        $this->current = $this->counter;
      }
      $this->pages[$this->counter] = $page;
    }
    return $this;
  }

  /**
   * 
   * @return Page|null next page or null if there is no next page
   */
  private function prevPage() {
    $backButton = null;
    if ($this->current > 1) {
      $backButton = new Page(null, $this->pages[$this->current - 1]->getHref(), $this->target);
      $backButton
              ->addCssClass('pagination-previous');
    }
    return $backButton;
  }

  /**
   * 
   * @return Li 
   */
  public function getEllipsis() {
    $ellipsis = new Li();
    $ellipsis->cssClasses()->lock('ellipsis');
    $ellipsis->attrs()->lock('aria-hidden', 'true');
    return $ellipsis;
  }

  /**
   * 
   * @return Page|null next page or null if there is no next page
   */
  private function nextPage() {
    $count = $this->count();
    $nextPage = null;
    if ($this->current < $count) {
      $nextPage = new Page(null, $this->pages[$this->current + 1]->getHref(), $this->target);
      $nextPage
              ->addCssClass('pagination-next');
    }
    return $nextPage;
  }

  /**
   * The {@link Page} container
   * 
   * @return Container
   */
  private function getRange($start, $length) {
    return new Container(array_slice($this->pages, $start - 1, $length, true));
  }

  /**
   * Returns the {@link Page} component at the specified index
   *
   * @param  int $index the index with the value
   * @return Page|null the value at the specified index or null
   */
  public function get($index) {
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
   * @return ArrayIterator iterator
   */
  public function getIterator() {
    return new ArrayIterator($this->pages);
  }

  /**
   * Count the number of inserted {@link Page} components
   *
   * @return int number of {@link Page} components
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count() {
    return count($this->pages);
  }

  public function contentToString() {
    $first = $this->current - $this->range / 2;
    $last = $this->current + $this->range / 2 - 1;
    if ($first < 1) {
      $first = 1;
    } if ($last > $this->count()) {
      $first = $this->count() - $this->range + 1;
    }
    return $this->prevPage() . $this->getRange($first, $this->range) . $this->nextPage();
  }

}
