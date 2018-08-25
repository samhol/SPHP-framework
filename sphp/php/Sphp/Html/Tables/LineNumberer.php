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
class LineNumberer {

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
  private $left = false;

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
   * Checks whether the line numbers are prepended 
   * 
   * @return bool true if line numbers are prepended to rows, false otherwise
   */
  public function prependsLineNumbers(): bool {
    return $this->left;
  }

  /**
   * Checks whether the line numbers are appended 
   * 
   * @return bool true if line numbers are appended to rows, false otherwise
   */
  public function appendsLineNumbers(): bool {
    return $this->right;
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

  protected function generateTh(int $rowSpan): Th {
    return (new Th($this->getLabel()))->setRowspan($rowSpan)->setScope('col');
  }

  /**
   * 
   * @param  Table $table
   * @return bool
   */
  public function manipulateHead(Table $table): bool {
    try {
      $first = $table->thead()->getRow(0);
      $rowSpan = $table->thead()->count();
      if ($this->prependsLineNumbers()) {
        $first->prepend($this->generateTh($rowSpan));
      }
      if ($this->appendsLineNumbers()) {
        $first->append($this->generateTh($rowSpan));
      }
      return true;
    } catch (\Exception $ex) {
      return false;
    }
  }

  /**
   * 
   * @param  Table $table
   * @return bool
   */
  public function manipulateFooter(Table $table): bool  {
   try {
      $first = $table->tfoot()->getRow(0);
      $rowSpan = $table->tfoot()->count();
      if ($this->prependsLineNumbers()) {
        $first->prepend($this->generateTh($rowSpan));
      }
      if ($this->appendsLineNumbers()) {
        $first->append($this->generateTh($rowSpan));
      }
      return true;
    } catch (\Exception $ex) {
      return false;
    }
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
    $tbody = $table->tbody();
    $lineNumber = $this->getFirstLineNumber();
    foreach ($tbody as $row) {
      if ($row instanceof Row) {
        $row->append($this->generateLineNumberCell($lineNumber++));
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
    $tbody = $table->tbody();
    $lineNumber = $this->getStart();
    foreach ($tbody as $row) {
      if ($row instanceof Row) {
        $row->prepend($this->generateLineNumberCell($lineNumber++));
      }
    }
    return $table;
  }

  /**
   * 
   * @param  Table $table
   * @return Table
   */
  public function setLineNumbers(Table $table): Table {
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
