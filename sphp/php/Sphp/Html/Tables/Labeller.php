<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Html\Tables;

/**
 * Description of Labeller
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Labeller {
  private $labels = [];
  /**
   * Constructor
   * 
   * @param int $start
   * @param string $label
   */
  public function __construct(array $labels = []) {
    $this->setLabels($labels);
  }
  public function setLabelForColumn(string $label, int $column) {
    $this->labels[$column] = $label;
    return $this;
  }

  /**
   * Checks whether the line numbers are prepended 
   * 
   * @return bool true if line numbers are prepended to rows, false otherwise
   */
  public function prependsLineNumbers(): bool {
    return $this->left;
  }
  //protected function insertLabel
  /**
   * 
   * @param  Table $table
   * @return Table
   */
  public function insertLabelsTo(Table $table): Table {
    foreach($this->labels as $column => $label) {
      
    }
    if ($this->prependsLineNumbers()) {
      $this->prependLineNumbersTo($table);
    }
    if ($this->appendsLineNumbers()) {
      $this->appendLineNumbersTo($table);
    }
    $this->manipulateHead($table);
    $this->manipulateFooter($table);
    return $table;
  }

}
