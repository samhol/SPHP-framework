<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

/**
 * Implementation of an HTML table labeller
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

  private function insertLabelsToRow(Row $row) {
    foreach ($this->labels as $column => $label) {
      $cell = $row[$column];
      if ($cell !== null) {
        $row[$column]->setAttribute('data-label', $label);
      }
    }
  }

  public function __invoke(Table $table): void {
    $this->useInTable($table);
  }

  public function useInTable(Table $table): void {
    $table->addCssClass('responsive-card-table');
    foreach ($table->tbody() as $row) {
      $this->insertLabelsToRow($row);
    }
  }

}
