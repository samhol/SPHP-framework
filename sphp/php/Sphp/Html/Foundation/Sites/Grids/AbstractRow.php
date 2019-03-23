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
   * Constructor
   * 
   * @param string $tagname
   */
  public function __construct(string $tagname = 'div') {
    parent::__construct($tagname);
    $this->columns = new PlainContainer();
    $this->cssClasses()->protectValue('grid-x');
  }

  public function setLayouts(...$layout) {
    foreach (is_array($layout) ? $layout : [$layout] as $width) {
      $parts = explode('-', $width);
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
      $this->reset($screenSize);
    }
    return $this;
  }

  /**
   * 
   * @param  bool $margin
   * @return $this for a fluent interface
   */
  public function useMargin(bool $margin = true) {
    if ($margin) {
      $this->cssClasses()->add('grid-margin-x');
    } else {
      $this->cssClasses()->remove('grid-margin-x');
    }
    return $this;
  }

  /**
   * 
   * @param  bool $padding
   * @return $this for a fluent interface
   */
  public function usePadding(bool $padding = true) {
    if ($padding) {
      $this->cssClasses()->add('grid-padding-x');
    } else {
      $this->cssClasses()->remove('grid-padding-x');
    }
    return $this;
  }

  /**
   * Sets the block grid value of the given target screen types
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function collapse(string $screenSize) {
    $this->reset($screenSize);
    $this->cssClasses()->add("$screenSize-collapse");
    return $this;
  }

  /**
   * Sets the block grid value of the given target screen types
   *
   * @precondition `$screenSize` == `small|medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function uncollapse(string $screenSize) {
    $this->reset($screenSize);
    $this->cssClasses()->add("$screenSize-uncollapse");
    return $this;
  }

  /**
   * Unsets the block grid setting for the given screen widths
   *
   * @precondition `$screenSize` == `medium|large|xlarge|xxlarge`
   * @param  string $screenSize the target screen size
   * @return $this for a fluent interface
   */
  public function reset(string $screenSize) {
    $classes = [];
    $classes[] = "$screenSize-collapse";
    $classes[] = "$screenSize-uncollapse";
    $this->cssClasses()->remove($classes);
    return $this;
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
    $cell = new ContainerCell($content, $sizes);
    $this->append($cell);
    return $cell;
  }

  public function appendMdColumn($md, array $sizes = ['auto']): Cell {
    $cell = new ContainerCell();
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
