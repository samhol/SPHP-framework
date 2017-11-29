<?php

/**
 * AbstractRow.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Grids;

use Sphp\Html\AbstractContainerTag;
use Sphp\Html\WrappingContainer;
use Sphp\Html\NonVisualContent;

/**
 * Implements an abstract Foundation framework based XY Row
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/xy-grid.html XY Grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractRow extends AbstractContainerTag implements RowInterface {

  /**
   * @var RowLayoutManager 
   */
  private $layoutManager;

  public function __construct($tagname, RowLayoutManager $layoutManager = null) {
    $wrapToCol = function($c) {
      if ($c instanceof NonVisualContent || $c instanceof ColumnInterface) {
        return $c;
      } else {
        return new Column($c);
      }
    };
    parent::__construct($tagname, null, new WrappingContainer($wrapToCol));
    $this->layoutManager = new RowLayoutManager($this);
  }

  public function layout(): RowLayoutManager {
    return $this->layoutManager;
  }

  public function setColumns($columns, array $sizes = null) {
    if (!is_array($columns)) {
      $columns = [$columns];
    }

    if ($sizes === null) {
      $sizes = ['auto'];
    }

    $this->clear();
    //print_r($sType);
    foreach ($columns as $column) {
      if ($column instanceof ColumnInterface) {
        $this->append($column);
      } else {
        $this->appendColumn($column, $sizes);
      }
    }
    return $this;
  }

  public function appendColumn($content, array $sizes = ['auto']) {
    $this->append(new Column($content, $sizes));
    return $this;
  }

  public function appendMdColumn($content, array $sizes = ['auto']) {
    $p = new \ParsedownExtraPlugin();
    $this->append(new Column($p->parse($content), $sizes));
    return $this;
  }

  /**
   * 
   * @param  array $rows
   * @return self new instance
   */
  public static function from(array $rows) {
    return new Static($rows);
  }

}
