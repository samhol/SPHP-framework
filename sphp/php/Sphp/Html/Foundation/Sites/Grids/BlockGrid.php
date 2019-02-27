<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use IteratorAggregate;
use Traversable;
use Sphp\Html\AbstractComponent;
use Sphp\Html\TraversableContent;
use Sphp\Html\ContentParser;
use Sphp\Html\PlainContainer;
use Sphp\Exceptions\RuntimeException;

/**
 * Implements an XY Block Grid
 *
 * **Important!**
 *
 * This component is mobile-first. Code for small screens first,
 * and larger devices will inherit those styles. Customize for
 * larger screens as necessary.
 *
 * If you use the small block grid only, the grid will keep its spacing and
 * configuration no matter the screen size. If you use large block grid
 * only, the list items will stack on top of each other for small devices.
 * If you use both of those classes combined, you can control the
 * configuration and layout separately for each breakpoint.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html#block-grids Block Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BlockGrid extends AbstractComponent implements IteratorAggregate, ContentParser, TraversableContent {

  use \Sphp\Html\TraversableTrait,
      \Sphp\Html\ContentParserTrait;

  /**
   * @var PlainContainer
   */
  private $columns;

  /**
   * @var BlockGridLayout 
   */
  private $layoutManager;

  /**
   * Constructor
   *
   * @param  string $layout,... block grid layout parameters
   */
  public function __construct(...$layout) {
    $this->columns = [];
    parent::__construct('div');
    $this->layoutManager = new BlockGridLayout($this);
    $this->layout()->setLayouts($layout);
  }

  public function __destruct() {
    unset($this->columns, $this->layoutManager);
    parent::__destruct();
  }

  public function layout(): BlockGridLayout {
    return $this->layoutManager;
  }

  /**
   * Sets the Column to the container
   * 
   * @param  array $columns columns or column contents
   * @return $this for a fluent interface
   */
  public function setColumns(array $columns) {
    $this->columns = [];
    foreach ($columns as $column) {
      if (!($column instanceof BlockGridColumnInterface)) {
        $column = new DivBlock($column);
      }
      $this->append($column);
    }
    return $this;
  }

  /**
   * Appends new Columns to the container
   * 
   * @param  mixed $column column or column content
   * @return BlockGridColumn new column
   */
  public function append($column): Block {
    if (!$column instanceof BlockGridColumn) {
      $column = new DivBlock($column);
    }
    $this->columns[] = $column;
    return $column;
  }

  /**
   * Appends a parsed Mark Down string to the container
   * 
   * @param  string $md the path to the file
   * @return DivBlock new column
   * @throws RuntimeException if the parsing fails for any reason
   */
  public function appendMd(string $md): DivBlock {
    try {
      $column = new DivBlock();
      $column->appendMd($md);
      $this->append($column);
      return $column;
    } catch (\Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

  /**
   * Appends a parsed Mark Down file to the container
   * 
   * @param  string $path  the path to the file
   * @return DivBlock new column
   * @throws RuntimeException if the parsing fails for any reason
   */
  public function appendMdFile(string $path): DivBlock {
    try {
      $column = new DivBlock();
      $column->appendMdFile($path);
      $this->append($column);
    } catch (\Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $this;
  }

  /**
   * Appends a raw file to the container
   * 
   * @param  string $path path to the file
   * @return DivBlock new column
   * @throws RuntimeException if the parsing fails for any reason
   */
  public function appendRawFile(string $path): DivBlock {
    try {
      $column = new DivBlock();
      $column->appendRawFile($path);
      return $this->append($column);
    } catch (\Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

  /**
   * Appends an executed PHP file to the container
   * 
   * @param  string $path  the path to the file
   * @return DivBlock new column
   * @throws RuntimeException if the parsing fails for any reason
   */
  public function appendPhpFile(string $path): DivBlock {
    try {
      $column = new DivBlock();
      $column->appendPhpFile($path);
      return $this->append($column);
    } catch (\Exception $ex) {
      throw new RuntimeException($ex->getMessage(), $ex->getCode(), $ex);
    }
    return $this;
  }

  /**
   * Appends a new Column to the container
   * 
   * @param  int $index column or column content
   * @return BlockGridColumn|null
   */
  public function getColumn($index) {
    return $this->columns->offsetGet($index);
  }

  public function getIterator(): Traversable {
    return new \Sphp\Html\Iterator($this->columns);
  }

  public function count(): int {
    return count($this->columns);
  }

  public function contentToString(): string {
    return implode($this->columns);
  }

}
