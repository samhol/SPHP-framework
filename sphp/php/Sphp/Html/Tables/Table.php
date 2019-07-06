<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use IteratorAggregate;
use Sphp\Html\AbstractComponent;
use Sphp\Html\TraversableContent;
use Sphp\Html\PlainContainer;
use Traversable;

/**
 * Implements an HTML &lt;table&gt; tag.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_table.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Table extends AbstractComponent implements IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait;

  /**
   * Counts the {@link RowInterface} components in the table
   */
  const COUNT_ROWS = 1;

  /**
   * Counts the {@link CellInterface} components in the table
   */
  const COUNT_CELLS = 2;

  /**
   * @var Caption 
   */
  private $caption;

  /**
   * @var Colgroup 
   */
  private $colgroup;

  /**
   * @var Thead 
   */
  private $thead;

  /**
   * @var Tbody 
   */
  private $tbody;

  /**
   * @var Tfoot|null
   */
  private $tfoot;

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('table');
  }

  public function __destruct() {
    unset($this->caption, $this->colgroup, $this->thead, $this->tbody, $this->tfoot);
    parent::__destruct();
  }

  public function __clone() {
    if (is_object($this->caption)) {
      $this->caption = clone $this->caption;
    }
    if (is_object($this->colgroup)) {
      $this->colgroup = clone $this->colgroup;
    }
    if (is_object($this->thead)) {
      $this->thead = clone $this->thead;
    }
    if (is_object($this->tbody)) {
      $this->tbody = clone $this->tbody;
    }
    if (is_object($this->tfoot)) {
      $this->tfoot = clone $this->tfoot;
    }
    parent::__clone();
  }

  public function contentToString(): string {
    return $this->caption . $this->colgroup . $this->thead . $this->tbody . $this->tfoot;
  }

  /**
   * Sets the caption text of the table
   * 
   * @param  Caption|string|null $caption the caption object or the content of the caption
   * @return Caption table caption component
   */
  public function setCaption($caption): Caption {
    if (!$caption instanceof Caption && $caption !== null) {
      $caption = new Caption($caption);
    }
    $this->caption = $caption;
    return $this->caption;
  }

  /**
   * Sets (replaces) a part of a table with the given {@link TableContentInterface} component
   *
   * @param TableContent $content the given part of a table
   * @return $this for a fluent interface
   */
  public function setContent(TableContent $content) {
    if ($content instanceof Colgroup || $content instanceof Col) {
      $this->setCols($content);
    } else if ($content instanceof Caption) {
      $this->getInnerContainer()['caption'] = $content;
    } else if ($content instanceof Thead) {
      $this->thead = $content;
    } else if ($content instanceof Tbody) {
      $this->tbody = $content;
    } else if ($content instanceof Tfoot) {
      $this->tfoot = $content;
    } else if ($content instanceof Tr || $content instanceof AbstractCell) {
      $this->tbody->append($content);
    }
    return $this;
  }

  /**
   * Returns the colgroup component or null
   *
   * @param  Colgroup $colgroup
   * @return Colgroup colgroup component
   */
  public function colgroup(Colgroup $colgroup = null): Colgroup {
    if ($colgroup === null) {
      $colgroup = new Colgroup();
    }
    $this->colgroup = $colgroup;
    return $this->colgroup;
  }

  /**
   * Destroys the optional colgroup component
   * 
   * @return $this for a fluent interface
   */
  public function removeColgroup() {
    $this->colgroup = null;
    return $this;
  }

  /**
   * Sets the header component
   * 
   * @param  Thead|null $thead
   * @return Thead|null table header component or null if none set
   */
  public function setThead(Thead $thead = null): ?Thead {
    $this->thead = $thead;
    return $this->thead;
  }

  /**
   * Returns the table header component
   *
   * @return Thead|null table header component or null if none set
   */
  public function thead(): ?Thead {
    return $this->thead;
  }

  /**
   * Returns the table body component
   *
   * @param  Tbody $tbody
   * @return Tbody table body component
   */
  public function tbody(Tbody $tbody = null): Tbody {
    if ($tbody !== null) {
      $this->tbody = $tbody;
    } else if ($this->tbody === null) {
      $this->tbody = new Tbody();
    }
    return $this->tbody;
  }

  /**
   * Destroys the optional table body component
   * 
   * @return $this for a fluent interface
   */
  public function removeTbody() {
    $this->tbody = null;
    return $this;
  }

  /**
   * Sets the footer component
   * 
   * @param  Tfoot|null $tfoot
   * @return Tfoot|null for a fluent interface
   */
  public function setTfoot(Tfoot $tfoot = null): ?Tfoot {
    $this->tfoot = $tfoot;
    return $this->tfoot;
  }

  /**
   * Returns footer component
   * 
   * @return Tfoot|null
   */
  public function tfoot(): ?Tfoot {
    return $this->tfoot;
  }

  /**
   * Count the number of inserted elements in the table
   *
   * **`$mode` parameter values:**
   * 
   * * {@link self::COUNT_ROWS} counts the {@link RowInterface} components in the table
   * * {@link self::COUNT_CELLS} counts the {@link CellInterface} components in the table
   *
   * @param  int $mode defines the type of the objects to count
   * @return int number of elements in the html table
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(int $mode = self::COUNT_ROWS): int {
    $num = 0;
    if ($this->thead !== null) {
      $num += $this->thead->count($mode);
    }
    if ($this->tbody !== null) {
      $num += $this->tbody->count($mode);
    }
    if ($this->tfoot !== null) {
      $num += $this->tfoot->count($mode);
    }
    return $num;
  }

  /**
   * Create a new iterator to iterate through inserted elements in the table
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    $it = new PlainContainer();
    if ($this->caption !== null) {
      $it['caption'] = $this->caption;
    }
    if ($this->colgroup !== null) {
      $it['colgroup'] = $this->colgroup;
    }
    if ($this->thead !== null) {
      $it['thead'] = $this->thead;
    }
    if ($this->tbody !== null) {
      $it['tbody'] = $this->tbody;
    }
    if ($this->tfoot !== null) {
      $it['tfoot'] = $this->tfoot;
    }
    return $it;
  }

}
