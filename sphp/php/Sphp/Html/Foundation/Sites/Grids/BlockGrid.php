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
use Sphp\Stdlib\Arrays;
use Sphp\Html\Foundation\Foundation;

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
   * @var int 
   */
  private $maxSize = 8;

  /**
   * Constructor
   *
   * @param  string... $layout block grid layout parameters
   */
  public function __construct(...$layout) {
    $this->columns = [];
    parent::__construct('div');
    $this->setLayouts($layout);
    $this->maxSize = 8;
    $this->cssClasses()->protectValue('grid-x');
  }

  public function __destruct() {
    unset($this->columns);
    parent::__destruct();
  }

  /**
   * 
   * @return int
   */
  public function getColumnCount(): int {
    return $this->maxSize;
  }

  /**
   * Sets the number of columns within the row for different screen sizes
   * 
   * @param  string|string[]... $layouts individual layout settings
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException
   */
  public function setLayouts(...$layouts) {
    $this->setWidths($layouts);
    return $this;
  }

  /**
   * Sets the column width values for all screen sizes
   * 
   * @param  string|string[]... $widths column widths for different screens sizes
   * @return $this for a fluent interface
   */
  public function setWidths(... $widths) {
    $widths = Arrays::flatten($widths);
    $filtered = preg_grep('/^((small|medium|large|xlarge|xxlarge)-up-([1-9]|(1[0-2])))+$/', $widths);
    foreach ($filtered as $width) {
      $parts = explode('-', $width);
      $this->unsetGrid($parts[0]);
      $this->cssClasses()->add($width);
    }
    return $this;
  }

  /**
   * Unsets all layout settings 
   * 
   * @return $this for a fluent interface
   */
  public function unsetLayouts() {
    foreach (Foundation::sizes() as $screenSize) {
      $this->unsetGrid($screenSize);
    }
    return $this;
  }

  /**
   * Unsets the block grid setting for the given screen widths
   *
   * @precondition `$screenSize` == `medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  protected function unsetGrid(string $screenSize) {
    $classes = [];
    for ($i = 1; $i <= $this->getColumnCount(); $i++) {
      $classes[] = "$screenSize-up-$i";
    }
    $this->cssClasses()->remove($classes);
    return $this;
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
