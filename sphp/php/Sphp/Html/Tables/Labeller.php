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
  public function setLabels(array $labels) {
    $this->labels = $labels;
    return $this;
  }

  public function setLabelForColumn(string $label, int $column) {
    $this->labels[$column] = $label;
    return $this;
  }

  protected function insertLabelsToRow(Row $row) {
    foreach ($this->labels as $column => $label) {
      $cell = $row->getCell($column);
      if ($cell instanceof \Sphp\Html\ComponentInterface) {
        $row->getCell($column)->setAttribute('data-label', $label);
      }
    }
  }

  /**
   * 
   * @param  Table $table
   * @return Table
   */
  public function insertLabelsTo(Table $table): Table {
    foreach ($table->tbody() as $row) {
      $this->insertLabelsToRow($row);
    }
    return $table;
  }

}
