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
 * Implements a line numberer for HTML tables
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class LineNumberer implements TableFilter {

  /**
   * @var int
   */
  private $start = 1;

  /**
   * @var string
   */
  private $label;

  /**
   * @var bool 
   */
  private $left = true;

  /**
   * @var bool 
   */
  private $right = false;

  /**
   * Constructor
   * 
   * @param int $start
   * @param string $label
   */
  public function __construct(int $start = 1, string $label = '#') {
    $this->setFirstLineNumber($start);
    $this->setLabel($label);
  }

  /**
   * Sets the numberer to prepend the line numbers to a HTML table
   * 
   * @param  bool $prepends true for prepending and false otherwise
   * @return $this
   */
  public function prependLineNumbers(bool $prepends) {
    $this->left = $prepends;
    return $this;
  }

  /**
   * Sets the numberer to append the line numbers to a HTML table
   * 
   * @param  bool $appends true for appending and false otherwise
   * @return $this for a fluent interface
   */
  public function appendLineNumbers(bool $appends) {
    $this->right = $appends;
    return $this;
  }

  public function getStart(): int {
    return $this->start;
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
   * 
   * @param  int $start
   * @return $this for a fluent interface
   */
  public function setFirstLineNumber(int $start) {
    $this->start = $start;
    return $this;
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
   * @param  Table $rowContainer
   * @return bool
   */
  private function manipulateHeaderAndFooter(RowContainer $rowContainer): bool {
    $result = false;
    $first = $rowContainer->getRow(0);
    if ($first !== null) {
      $rowSpan = $rowContainer->count();
      if ($this->left) {
        $first->prepend($this->generateTh($rowSpan));
      }
      if ($this->right) {
        $first->append($this->generateTh($rowSpan));
      }
      $result = true;
    }
    return $result;
  }

  protected function generateLineNumberCell(int $number): Th {
    $th = new Th($number . '.');
    $th->setScope('row');
    $th->setAttribute('data-label', $this->getLabel());
    return $th;
  }

  /**
   * 
   * @param  Table $table
   * @return Table
   */
  public function appendLineNumbersTo(Table $table): Table {
    if ($this->right) {
      $tbody = $table->tbody();
      $lineNumber = $this->getFirstLineNumber();
      foreach ($tbody as $row) {
        if ($row instanceof Row) {
          $row->append($this->generateLineNumberCell($lineNumber++));
        }
      }
    }
    return $table;
  }

  /**
   * 
   * @param  Table $table
   * @return Table
   */
  public function prependLineNumbersTo(Table $table): Table {
    if ($this->left) {
      $tbody = $table->tbody();
      if ($tbody !== null) {
        $lineNumber = $this->getStart();
        foreach ($tbody as $row) {
          if ($row instanceof Row) {
            $row->prepend($this->generateLineNumberCell($lineNumber++));
          }
        }
      }
    }
    return $table;
  }

  public function useInTable(Table $table): Table {
    if ($this->left) {
      $this->prependLineNumbersTo($table);
    }
    if ($this->right) {
      $this->appendLineNumbersTo($table);
    }
    if ($table->thead() !== null) {
      $this->manipulateHeaderAndFooter($table->thead());
    }
    if ($table->tfoot() !== null) {
      $this->manipulateHeaderAndFooter($table->tfoot());
    }
    return $table;
  }

}
