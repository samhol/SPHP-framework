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
use Sphp\Html\Lists\Ul;
use Sphp\Html\ContainerTag;
use IteratorAggregate;
use Countable;
use ArrayIterator;
use Sphp\Html\Iterator;
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
class Pagination extends AbstractComponent implements IteratorAggregate, Countable {

  /**
   * @var PageInterface
   */
  private $prev;

  /**
   * @var PageInterface
   */
  private $next;

  /**
   * @var PageInterface[] 
   */
  private $pages = [];

  /**
   *
   * @var string 
   */
  private $target;

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
  public function __construct(string $target = null) {
    parent::__construct('nav');
    $this->attributes()->setAria('label', 'Pagination');
    $this->pages = [];
    $this->target = $target;
    $this->setPrevious();
    $this->setNext();
  }

  public function __destruct() {
    unset($this->pages);
    parent::__destruct();
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
  public function setTarget(string $target = null) {
    $this->target = $target;
    foreach ($this->pages as $page) {
      $page->setTarget($target);
    }
    return $this;
  }

  /**
   * 
   * @param  PageInterface $page
   * @param  int $position
   * @return $this for a fluent interface
   */
  public function insertPage(PageInterface $page, int $position = null) {
    if ($position === null) {
      $this->pages[] = $page;
    } else {
      $this->pages[$position] = $page;
    }
    return $this;
  }

  /**
   * Sets a page component
   * 
   * @param  int $index the index of the page
   * @param  string $url the page object or an URL string
   * @param  string|null $content
   * @return PageInterface for a fluent interface
   */
  public function setPage(int $index, string $url = null, string $content = null): PageInterface {
    if ($content === null) {
      $content = (string) $index;
    }
    $page = new Page($url, $content, $this->target);
    $this->insertPage($page, $index);
    return $page;
  }

  /**
   * 
   * @param string $url
   * @param string $label
   * @return PageInterface
   */
  public function setPrevious(string $url = null, string $label = null): PageInterface {
    $this->prev = new Page($url, $label, $this->target);
    $this->prev->setRelationship('prev');
    $this->prev->cssClasses()->protectValue('pagination-previous');
    return $this->prev;
  }

  /**
   * 
   * @param  string $url
   * @param  string $label
   * @return PageInterface
   */
  public function setNext(string $url = null, string $label = null): PageInterface {
    $this->next = new Page($url, $label, $this->target);
    $this->next->setRelationship('next');
    $this->next->cssClasses()->protectValue('pagination-next');
    return $this->next;
  }

  /**
   * 
   * @return Li 
   */
  public function createEllipsis(): Li {
    $ellipsis = new Li();
    $ellipsis->cssClasses()->protectValue('ellipsis');
    $ellipsis->attributes()->protect('aria-hidden', 'true');
    return $ellipsis;
  }

  /**
   * Returns the page component at the specified index
   *
   * @param  int $index the index with the value
   * @return PageInterface|null the value at the specified index or null
   */
  public function getPage($index): ?PageInterface {
    $page = null;
    if (array_key_exists($index, $this->pages)) {
      $page = $this->pages[$index];
    }
    return $page;
  }

  /**
   * Returns a new iterator to iterate through inserted {@link Page} components 
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new Iterator($this->pages);
  }

  /**
   * Count the number of inserted Page components
   *
   * @return int number of inserted Page components
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return count($this->pages);
  }

  public function contentToString(): string {
    $prevIndex = null;
    ksort($this->pages);
    $ul = new Ul();
    $ul->cssClasses()->protectValue('pagination');
    $first = null;
    foreach ($this->pages as $index => $page) {
      if ($first === null) {
        $first = $index;
      }
      if ($prevIndex === null) {

        $prevIndex = $index;
      } else if (($index - $prevIndex) > 1) {
        $ul->append($this->createEllipsis());
      }
      $ul->append($page);
      $prevIndex = $index;
    }
    if ($first > 0) {
      $ul->prepend($this->createEllipsis());
    }
    if (true) {
      $ul->prepend($this->prev);
    }
    if (true) {
      $ul->append($this->next);
    }
    return $ul->getHtml();
  }

}
