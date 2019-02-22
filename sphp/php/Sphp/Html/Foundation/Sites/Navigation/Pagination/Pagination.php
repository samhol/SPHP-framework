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
  private $previousPageButton;

  /**
   * @var PageInterface
   */
  private $nextPageButton;

  /**
   * @var PageInterface[] 
   */
  private $pages = [];

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
   * @var Ul 
   */
  private $ul;

  /**
   * Constructor
   * 
   * @param string $target
   */
  public function __construct(string $target = '_self') {
    parent::__construct('nav');
    $this->attributes()->setAria('label', "Pagination");
    $this->ul = new Ul('ul');
    $this->ul->cssClasses()
            ->protectValue('pagination');
    $this->pages = [];
    $this->target = $target;
    $this->setPreviousPageButton(null);
    $this->setNextPageButton(null);
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

  public function append(PageInterface $page) {
    $this->pages[] = $page;
    return $this;
  }

  /**
   * Sets a page component
   * 
   * @param  int $index the index of the page
   * @param  string $$url the page object or an URL string
   * @return $this for a fluent interface
   */
  public function setPage(int $index, string $url): PageInterface {
    $page = new Page($url, $index, $this->target);
    $this->pages[$index] = $page;
    return $page;
  }

  public function setPreviousPageButton(string $url = null, string $label = null): PageInterface {
    $this->previousPageButton = new Page($url, $label, $this->target);
    $this->previousPageButton->cssClasses()->protectValue('pagination-previous');
    return $this->previousPageButton;
  }

  public function setNextPageButton(string $url = null, string $label = null): PageInterface {
    $this->nextPageButton = new Page($url, $label, $this->target);
    $this->nextPageButton->cssClasses()->protectValue('pagination-next');
    return $this->nextPageButton;
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
   * Count the number of inserted {@link Page} components
   *
   * @return int number of {@link Page} components
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return count($this->pages);
  }

  public function contentToString(): string {
    $prevIndex = null;
    ksort($this->pages);
    $this->ul->clear();
    $first = 0;
    foreach ($this->pages as $index => $page) {
      if ($prevIndex === null) {
        $prevIndex = $index;
      } else if (($index - $prevIndex) > 1) {
        $this->ul->append($this->createEllipsis());
      }
      $this->ul->append($page);
      $prevIndex = $index;
    }
    if (true) {
      $this->ul->prepend($this->previousPageButton);
    }
    if (true) {
      $this->ul->append($this->nextPageButton);
    }
    return $this->ul->getHtml();
  }

}
