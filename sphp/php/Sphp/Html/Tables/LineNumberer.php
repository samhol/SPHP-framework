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
 * Implementation of a line numberer for HTML tables
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class LineNumberer implements TableFilter {

  public const NONE = 0b0;
  public const LEFT = 0b1;
  public const RIGHT = 0b10;

  /**
   * @var int
   */
  private int $start = 1;

  /**
   * @var string
   */
  private string $label;
  private int $flags = 0;

  /**
   * Constructor
   * 
   * @param int $side
   * @param int $start
   * @param string $label
   */
  public function __construct(int $side = self::LEFT, int $start = 1, string $label = '#') {
    $this->setSide($side);
    $this->setFirstLineNumber($start);
    $this->setLabel($label);
  }

  public function getSide(): int {
    return $this->flags;
  }

  public function setSide(int $flags) {
    $this->flags = $flags;
    return $this;
  }

  /**
   * Returns the label for the line numbers
   * 
   * @return string the label for the line numbers
   */
  public function getLabel(): string {
    return $this->label;
  }

  /**
   * Sets the label for the line numbers
   * 
   * @param  string $label the label for the line numbers
   * @return $this for a fluent interface
   */
  public function setLabel(string $label) {
    $this->label = $label;
    return $this;
  }

  /**
   * Sets the first line number
   * 
   * @param  int $start the first line number
   * @return $this for a fluent interface
   */
  public function setFirstLineNumber(int $start) {
    $this->start = $start;
    return $this;
  }

  public function getStart(): int {
    return $this->start;
  }

  /**
   * Returns the first line number in the table body
   * 
   * @return int the first line number in the table body
   */
  public function getFirstLineNumber(): int {
    return $this->start;
  }

  private function generateTh(int $rowSpan): Th {
    return (new Th($this->getLabel()))->setRowspan($rowSpan)->setScope('col');
  }

  /**
   * 
   * @param  RowContainer $rowContainer
   * @return bool
   */
  private function modifyHeadings(RowContainer $rowContainer): bool {
    $result = false;
    $first = $rowContainer->getRow(0);
    if ($first !== null) {
      $rowSpan = $rowContainer->count();
      if ($this->getSide() & self::LEFT) {
        $first->prepend($this->generateTh($rowSpan));
      }
      if ($this->getSide() & self::RIGHT) {
        $first->append($this->generateTh($rowSpan));
      }
      $result = true;
    }
    return $result;
  }

  protected function generateLineNumberCell(int $number): Th {
    $th = new Th("$number.");
    $th->setScope('row');
    return $th;
  }

  /**
   * 
   * @param  Tbody $tbody
   * @return void
   */
  protected function manipulateTbody(Tbody $tbody): void {
    $lineNumber = $this->getStart();
    foreach ($tbody as $row) {
      if ($this->getSide() & self::LEFT) {
        $row->prepend($this->generateLineNumberCell($lineNumber));
      }
      if ($this->getSide() & self::RIGHT) {
        $row->append($this->generateLineNumberCell($lineNumber));
      }
      $lineNumber++;
    }
  }

  public function __invoke(Table $table): void {
    $this->useInTable($table);
  }

  public function useInTable(Table $table): void {
    if ($table->tbody() !== null) {
      $this->manipulateTbody($table->tbody());
    }
    if ($table->thead() !== null) {
      $this->modifyHeadings($table->thead());
    }
    if ($table->tfoot() !== null) {
      $this->modifyHeadings($table->tfoot());
    }
  }

}
