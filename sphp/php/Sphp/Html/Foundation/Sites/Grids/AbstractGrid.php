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
use Sphp\Html\TraversableContent;
use IteratorAggregate;
use Traversable;

/**
 * Implements an abstract XY Grid Row container (a Grid)
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html#grid-container XY Grid Container
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AbstractGrid extends AbstractComponent implements IteratorAggregate, Grid {

  use \Sphp\Html\TraversableTrait;

  /**
   * @var PlainContainer 
   */
  private $content;

  /**
   * Constructor
   *
   * @param  string $tagname the tag name of the component
   */
  public function __construct(string $tagname) {
    parent::__construct($tagname);
    $this->content = new PlainContainer();
    $this->cssClasses()->protectValue('grid-container');
  }

  public function __destruct() {
    unset($this->content);
    parent::__destruct();
  }

  public function __clone() {
    $this->content = clone $this->content;
    parent::__clone();
  }

  public function setFluid(bool $fluid = false) {
    if ($fluid) {
      $this->cssClasses()->remove('full')->add('fluid');
    } else {
      $this->cssClasses()->remove('fluid');
    }
    return $this;
  }

  public function setFull(bool $full = false) {
    if ($full) {
      $this->cssClasses()->remove('fluid')->add('full');
    } else {
      $this->cssClasses()->remove('full');
    }
    return $this;
  }

  public function setLayouts(...$layouts) {
    $this->cssClasses()->add($layouts);
    $this->cssClasses()->add('grid-container');
    return $this;
  }

  public function unsetLayouts() {
    $this->setFluid(false)->setFull(false);
    return $this;
  }

  public function getCells(): TraversableContent {
    return $this->getComponentsByObjectType(Cell::class);
  }

  public function append($row): Row {
    if (!($row instanceof Row)) {
      $row = new BasicRow($row);
    }
    $this->content->append($row);
    return $row;
  }

  public function contentToString(): string {
    return $this->content->getHtml();
  }

  public function prepend($row): Row {
    if (!($row instanceof Row)) {
      $row = new BasicRow($row);
    }
    $this->content->prepend($row);
    return $this;
  }

  /**
   * Create a new iterator to iterate through Grid content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->content->getIterator();
  }

}
