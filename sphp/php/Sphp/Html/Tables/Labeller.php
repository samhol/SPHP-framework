<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

/**
 * Description of Labeller
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Labeller implements TableFilter {

  private $labels = [];

  /**
   * Constructor
   * 
   * @param array $labels
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
      if ($cell instanceof \Sphp\Html\Component) {
        $row->getCell($column)->setAttribute('data-label', $label);
      }
    }
  }

  public function useInTable(Table $table): Table {
    $table->addCssClass('responsive-card-table');
    foreach ($table->tbody() as $row) {
      $this->insertLabelsToRow($row);
    }
    return $table;
  }

}
