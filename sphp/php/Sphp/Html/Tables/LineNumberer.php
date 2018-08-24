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

  public function prependsLineNumbers(): bool {
    return $this->left;
  }

  public function appendsLineNumbers(): bool {
    return $this->right;
  }

  public function prependLineNumbers(bool $left) {
    $this->left = $left;
    return $this;
  }

  public function appendLineNumbers(bool $right) {
    $this->right = $right;
    return $this;
  }

  public function getStart(): int {
    return $this->start;
  }

  public function getLabel(): string {
    return $this->label;
  }

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

  /**
   * 
   * @param  Table $table
   * @return Table
   */
  public function appendToThead(Table $table): Table {
    if ($table->containsThead()) {
      $thead = $table->thead();
      $rowSpan = $thead->count();
      $arr = iterator_to_array($thead, false);
      $firstRow = $arr[0];
      //foreach ($thead as $row) {
      $th = (new Th($this->getLabel()))->setRowspan($rowSpan)->setScope('col');
      //echo 'egaraegrgergag';
      if ($firstRow instanceof Row) {
        $firstRow->append($th);
      }
    }
    return $table;
  }

  /**
   * 
   * @param  Table $table
   * @return Table
   */
  public function prependToThead(Table $table): Table {
    if ($table->containsThead()) {
      $thead = $table->thead();
      $rowSpan = $thead->count();
      $arr = iterator_to_array($thead, false);
      $firstRow = $arr[0];
      //foreach ($thead as $row) {
      $th = (new Th($this->getLabel()))->setRowspan($rowSpan)->setScope('col');
      //echo 'egaraegrgergag';
      if ($firstRow instanceof Row) {
        $firstRow->prepend($th);
        //echo 'egaraegrgergag';
      }
      // }
      //echo 'egaragag';
    }
    return $table;
  }

  public function generateLineNumberCell(int $number): Th {
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
    $this->prependToThead($table);
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
    return $table;
  }

}
