<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Lists;

use Sphp\Html\AbstractComponent;
use Sphp\Html\TraversableContent;
use IteratorAggregate;
use Sphp\Html\Attributes\HtmlAttributeManager;
use Sphp\Html\Iterator;
use Traversable;

/**
 * Implements an HTML &lt;dl&gt; tag
 *
 * The {@link self} component is used in conjunction with &lt;dt&gt; (defines the item in the list)
 * and &lt;dd&gt; (describes the item in the list).
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_dl.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Dl extends AbstractComponent implements IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var DlContent[] 
   */
  private $items = [];

  /**
   * Constructor
   *
   * @param  HtmlAttributeManager|null $attrManager the attribute manager of the component
   */
  public function __construct(HtmlAttributeManager $attrManager = null) {
    parent::__construct('dl', $attrManager);
  }

  /**
   * Appends elements to the object
   *
   * @param  DlContent $it list elements
   * @return $this for a fluent interface
   */
  public function append(DlContent $it) {
    $this->items[] = $it;
    return $this;
  }

  /**
   * Creates and appends a term to the list
   *
   * @param  mixed $content the term content
   * @return Dt appended instance
   */
  public function appendTerm($content): Dt {
    $dt = new Dt($content);
    $this->append($dt);
    return $dt;
  }

  /**
   * Creates and appends a description to the list
   *
   * @param  mixed $content the description content
   * @return Dt appended instance
   */
  public function appendDescription($content): Dd {
    $dd = new Dd($content);
    $this->append($dd);
    return $dd;
  }

  /**
   * Prepends an item to the object
   * 
   * @param  DlContent $it list element
   * @return $this for a fluent interface
   */
  public function prepend(DlContent $it) {
    array_unshift($this->items, $it);
    return $this;
  }

  /**
   * 
   * @param  DlContent $item
   * @return bool
   */
  public function contains(DlContent $item): bool {
    return in_array($item, $this->items, true);
  }

  public function count(): int {
    return count($this->items);
  }

  public function getIterator(): Traversable {
    return new Iterator($this->items);
  }

  public function contentToString(): string {
    return implode($this->items);
  }

}
