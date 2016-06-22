<?php

/**
 * Pagination.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Navigation\Pagination;

use Sphp\Html\AbstractComponent as AbstractComponent;
use IteratorAggregate;
use Countable;
use ArrayIterator;
use Sphp\Net\URL as URL;
use Sphp\Html\Container as Container;

/**
 * Class Models Foundation Pagination component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-05-20
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/pagination.html Foundation Pagination
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Pagination extends AbstractComponent implements IteratorAggregate, Countable {

  //private $current = -1;
  private $counter = 0;

  /**
   *
   * @var Page[] 
   */
  private $pages = [];
  private $show = 20;
  private $current = 1;
  private $target = "_self";

  /**
   * Constructs a new instance
   * <ul class="pagination" role="navigation" aria-label="Pagination">
   * @param mixed|mixed[] $urls the value of the target attribute
   */
  public function __construct(array $urls = null, $show = 20, $target = "_self") {
    parent::__construct("ul");
    $this->cssClasses()
            ->lock("pagination");
    $this->attrs()
            ->lock("role", "menubar")
            ->lock("aria-label", "Pagination");
    $this->target = $target;
    if ($urls !== null) {
      foreach ($urls as $page) {
        $this->addUrls($page);
      }
    }
  }

  public function setTarget($target) {
    $this->target = $target;
    foreach ($this->pages as $page) {
      $page->setTarget($target);
    }
    return $this;
  }

  public function setCurrent($current) {
    if (array_key_exists($current, $this->pages)) {
      $this->current = $current;
      foreach ($this->pages as $index => $page) {
        if ($index !== $current) {
          $page->setCurrent(false);
        } else {
          $page->setCurrent(true);
        }
      }
    }
    return $this;
  }

  public function setRange($current) {
    $this->show = $current;
    return $this;
  }

  public function addUrls($urls) {
    if (is_array($urls)) {
      foreach ($urls as $url) {
        $this->addUrls($url);
      }
    } else {
      $this->counter += 1;
      $page = new Page($this->counter, $urls, $this->target);
      if ($this->counter === $this->current) {
        $page->setCurrent(true);
      }
      $this->pages[$this->counter] = $page;

      //$this->urls[$this->counter] = $urls;
    }
    return $this;
  }

  /**
   * 
   * @return Page|null next page or null if there is no next page
   */
  private function prevPage() {
    $nextPage = null;
    if ($this->current > 1) {
      $prev = $this->current - 1;
      $nextPage = new Page("", $this->pages[$prev]->getHref(), $this->target);
    }
    else {
      $nextPage = (new Page("", $this->pages[$this->current]->getHref(), $this->target))->available(false);
    }
    $nextPage->addCssClass("pagination-previous");
    return $nextPage;
  }

  /**
   * 
   * @return Page|null next page or null if there is no next page
   */
  private function nextPage() {
    $count = $this->count();
    $nextPage = null;
    if ($this->current < $count) {
      $next = $this->current + 1;
      $nextPage = new Page("&raquo;", $this->pages[$next]->getHref(), $this->target);
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
  public function prev() {
    return $this->get($this->current - 1);
  }

  /**
   * 
   * @return Page|null
   */
  public function current() {
    return $this->get($this->current);
  }

  /**
   * 
   * @return Page|null
   */
  public function next() {
    return $this->get($this->current + 1);
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

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    $first = $this->current - $this->show / 2;
    if ($first < 1) {
      $first = 1;
    }
    return $this->prevPage() . $this->getRange($first, $this->show) . $this->nextPage();
  }

}
