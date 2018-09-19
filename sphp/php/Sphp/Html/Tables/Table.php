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
   * @var Tfoot 
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
    return $this->caption . $this->colgroup . $this->thead . $this->tfoot . $this->tbody;
  }

  /**
   * Sets the caption text of the table
   * 
   * @param  Caption|string|null $caption the caption object or the content of the caption
   * @return Caption table caption component
   */
  public function setCaption($caption): Caption {
    if (!$caption instanceof Caption) {
      $caption = new Caption($caption);
    }
    $this->caption = $caption;
    return $this->caption;
  }

  /**
   * Destroys the optional caption component
   * 
   * @return $this for a fluent interface
   */
  public function removeCaption() {
    $this->caption = null;
    return $this;
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
   * Returns the table header component
   *
   * @param  Thead|null $head
   * @return Thead table header component
   */
  public function thead(Thead $head = null): Thead {
    if ($head !== null) {
      $this->thead = $head;
    } else if ($this->thead === null) {
      $this->thead = new Thead();
    }
    return $this->thead;
  }

  /**
   * Destroys the optional table header component
   * 
   * @return $this for a fluent interface
   */
  public function removeThead() {
    $this->thead = null;
    return $this;
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
   * Returns footer component
   * 
   * @param  Tfoot $tfoot
   * @return Tfoot table footer component
   */
  public function tfoot(Tfoot $tfoot = null): Tfoot {
    if ($tfoot !== null) {
      $this->tfoot = $tfoot;
    } else if ($this->tfoot === null) {
      $this->tfoot = new Tfoot();
    }
    return $this->tfoot;
  }

  /**
   * Destroys the optional footer component
   * 
   * @return $this for a fluent interface
   */
  public function removeTfoot() {
    $this->tfoot = null;
    return $this;
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
    if ($this->tfoot !== null) {
      $num += $this->tfoot->count($mode);
    }
    if ($this->tbody !== null) {
      $num += $this->tbody->count($mode);
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
    if ($this->tfoot !== null) {
      $it['tfoot'] = $this->tfoot;
    }
    if ($this->tbody !== null) {
      $it['tbody'] = $this->tbody;
    }
    return $it;
  }

}
