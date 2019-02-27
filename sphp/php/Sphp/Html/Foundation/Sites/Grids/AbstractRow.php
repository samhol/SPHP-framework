<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\AbstractComponent;
use Sphp\Html\PlainContainer;
use Traversable;

/**
 * Implements an XY Grid Row
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractRow extends AbstractComponent implements \IteratorAggregate, Row {

  /**
   * @var PlainContainer
   */
  private $columns;

  /**
   * @var RowLayout 
   */
  private $layoutManager;

  /**
   * Constructor
   * 
   * @param string $tagname
   */
  public function __construct(string $tagname = 'div') {
    parent::__construct($tagname);
    $this->layoutManager = new RowLayout($this);
    $this->columns = new PlainContainer();
  }

  public function layout(): RowLayout {
    return $this->layoutManager;
  }

  public function setCells($columns, array $sizes = ['auto']) {
    if (!is_array($columns)) {
      $columns = [$columns];
    }

    $this->columns->clear();
    //print_r($sType);
    foreach ($columns as $column) {
      if ($column instanceof Cell) {
        $this->append($column);
      } else {
        $this->appendCell($column, $sizes);
      }
    }
    return $this;
  }

  public function append(Cell $column) {
    $this->columns->append($column);
    return $this;
  }

  public function prepend(Cell $column) {
    $this->columns->prepend($column);
    return $this;
  }

  public function appendCell($content, array $sizes = ['auto']): Cell {
    $cell = new DivCell($content, $sizes);
    $this->append($cell);
    return $cell;
  }

  public function appendMdColumn($md, array $sizes = ['auto']): Cell {
    $cell = new DivCell();
    $cell->layout()->setLayouts($sizes);
    $cell->appendMd($md);
    $this->append($cell);
    return $cell;
  }

  /**
   * Create a new iterator to iterate through Row content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->columns->getIterator();
  }

  public function contentToString(): string {
    return $this->columns->getHtml();
  }

}
