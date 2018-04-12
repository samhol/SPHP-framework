<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use Sphp\Html\AbstractContainerComponent;
use IteratorAggregate;
use Sphp\Html\TraversableContent;
use Traversable;
use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Implements an HTML table row collection namely (&lt;thead&gt;, &lt;tbody&gt; or &lt;tfoot&gt;)
 *
 * @author Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class TableRowContainer extends AbstractContainerComponent implements IteratorAggregate, TraversableContent, TableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * Constructs a new instance
   * 
   * @param string $tagname
   * @param HtmlAttributeManager|null $m
   */
  public function __construct(string $tagname, HtmlAttributeManager $m = null) {
    parent::__construct($tagname, $m);
  }

  /**
   * Appends a {@link RowInterface} object to the container object
   *
   * **Notes:**
   * 
   *  * A mixed `$row` can be of any type that converts to a PHP string
   *  * Any `$row` not implementing {@link RowInterface} is wrapped within a {@link Tr} component
   *
   * @param  Row $row the row being appended
   * @return $this for a fluent interface
   */
  public function append(Row $row) {
    $this->getInnerContainer()->append($row);
    return $this;
  }

  /**
   * Appends a &lt;tr&gt; object containing &lt;th&gt; objects
   *
   * **Notes:**
   * 
   *  * A `$cells` array can contain anything that converts to a PHP string
   *
   * @param  array $cells the row being appended
   * @return Tr appended table row component
   */
  public function appendHeaderRow(array $cells): Tr {
    $row = Tr::fromThs($cells);
    $this->append($row);
    return $row;
  }

  /**
   * Appends a &lt;tr&gt; object containing &lt;td&gt; objects
   *
   * **Notes:**
   * 
   *  * A `$cells` array can contain anything that converts to a PHP string
   *
   * @param  array $cells the row being appended
   * @return Tr appended table row component
   */
  public function appendBodyRow(array $cells): Tr {
    $row = Tr::fromTds($cells);
    $this->append($row);
    return $row;
  }

  /**
   * Prepends a &lt;tr&gt object
   *
   * @param  Row $row the row(s) being appended
   * @return $this for a fluent interface
   */
  public function prepend(Row $row) {
    $this->getInnerContainer()->prepend($row);
    return $this;
  }

  /**
   * Count the number of inserted rows in the table
   *
   * @return int number of elements in the HTML table
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return $this->getInnerContainer()->count();
  }

  /**
   * Create a new iterator to iterate through content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->getInnerContainer();
  }

}
