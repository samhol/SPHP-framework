<?php

/**
 * Tr.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

/**
 * Implements an HTML &lt;tr&gt; tag
 *
 *  This component represents a row of {@link CellInterface}
 *  components in a {@link Table}.
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-03
 * @link    http://www.w3schools.com/tags/tag_tr.asp w3schools API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-tr-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Tr extends AbstractRow {

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   *  mixed `$cells` can be of any type that converts to a PHP string or to a 
   *  PHP string[].
   *
   * `$cellType` parameter defines the type of the wrapper for`$cells` not instanceof  {@link CellInterface}
   *  
   * * `td` => all `$cells` not extending {@link CellInterface} are wrapped within a {@link Td} component
   * * `th` => all `$cells` not extending {@link CellInterface} are wrapped within a {@link Th} component
   *
   * @param  null|mixed|mixed[] $cells cell(s) of the table row or null for no content
   * @param  string $cellType the default type of the cell 
   *         (`td`|`th`)
   */
  public function __construct($cells = null) {
    parent::__construct();
    if (isset($cells)) {
      $this->appendTds($cells);
    }
  }

  /**
   * 
   * @param  mixed $tds
   * @return self
   */
  public static function fromTds($tds) {
    return (new static())->appendTds($tds);
  }

  /**
   * 
   * @param  mixed $ths
   * @return self
   */
  public static function fromThs($ths) {
    return (new static())->appendThs($ths);
  }

}
