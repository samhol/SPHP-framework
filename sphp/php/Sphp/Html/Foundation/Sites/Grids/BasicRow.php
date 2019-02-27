<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Grids;

/**
 * Implements an XY Grid Row
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class BasicRow extends AbstractRow {

  /**
   * Constructor
   *
   * **Notes:**
   * 
   * * `mixed $columns` can be of any type that converts to a string or to a string[]
   * * all values of `$columns` not extending {@link ColumnInterface} are wrapped with {@link Column} component
   * 
   * @param  mixed|mixed[] $cells row columns
   * @param  string[] $layoutParams
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($cells = null, array $layoutParams = []) {
    parent::__construct('div');
    if ($cells !== null) {
      $this->setCells($cells, $layoutParams);
    }
  }

  /**
   * Creates a new Row from a collection of cells
   * 
   * @param  iterable $cells
   * @return BasicRow new instance
   */
  public static function from(iterable $cells): BasicRow {
    $row = new static();
    foreach ($cells as $cell) {
      if ($cell instanceof Cell) {
        $row->append($cell);
      } else {
        $row->appendCell($cell);
      }
    }
    return $row;
  }

}
