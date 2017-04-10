<?php

/**
 * TableBuilder.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

use Sphp\Stdlib\CsvFile;

/**
 * Description of TableBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-04-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TableBuilder implements \Sphp\Html\ContentInterface {

  use \Sphp\Html\ContentTrait;

  const USE_LINENUMBERS = 0b1;
  const LINENUMBERS_LEFT = 0b1;

  private $lineNumbers = [];
  private $theadData = [];
  private $tbodyData = [];
  private $tfootData = [];

  public function __construct() {
    $this->setLineNumbers();
    $this->setLineNumbersVisibility(false);
  }

  /**
   * 
   * @return array 
   */
  public function getLineNumbers() {
    return $this->lineNumbers;
  }

  /**
   * 
   * @return array 
   */
  public function getTheadData() {
    return $this->theadData;
  }

  public function getTbodyData() {
    return $this->tbodyData;
  }

  public function getTfootData() {
    return $this->tfootData;
  }

  /**
   * 
   * @param  boolean $visibility
   * @return self for a fluent interface
   */
  public function setLineNumbersVisibility($visibility) {
    $this->lineNumbers['visibility'] = (bool) $visibility;
    return $this;
  }

  /**
   * 
   * @param  int $start
   * @param  string $position
   * @return self for a fluent interface
   */
  public function setLineNumbers($start = 1, $position = 'none') {
    $this->lineNumbers = ['start' => (int) $start, 'position' => $position];
    return $this;
  }

  public function getFirstLineNumber() {
    return $this->lineNumbers['start'];
  }

  public function lineNumbersVisible() {
    return $this->lineNumbers['position'] !== 'none';
  }

  /**
   * 
   * @param  array $data
   * @return self for a fluent interface
   */
  public function setTheadData($data) {
    $this->theadData = $data;
    return $this;
  }

  /**
   * 
   * @param  array $data
   * @return self for a fluent interface
   */
  public function setTbodyData($data) {
    $this->tbodyData = $data;
    return $this;
  }

  /**
   * 
   * @param  array $data
   * @return self for a fluent interface
   */
  public function setTfootData($data) {
    $this->tfootData = $data;
    return $this;
  }

  /**
   * 
   * @param  boolean $use truefor visible linenumbes, otherwise false
   * @return self for a fluent interface
   */
  public function useLineNumbers($use) {
    $this->lineNumbers['use'] = (bool) $use;
    return $this;
  }

  /**
   * 
   * @return Thead
   */
  public function buildThead() {
    return $this->buildHeadingComponent(new Thead(), $this->theadData);
  }

  /**
   * 
   * @return Tbody
   */
  public function buildTbody() {
    $tbody = new Tbody();
    $lineNumber = $this->getFirstLineNumber();
    foreach ($this->tbodyData as $row) {
      if ($this->lineNumbersVisible()) {
        $th = new Th(($lineNumber++) . '.', 'row');
        array_unshift($row, $th);
      }
      $tbody->appendBodyRow($row);
    }
    return $tbody;
  }

  /**
   * 
   * @return Tfoot
   */
  public function buildTfoot() {
    return $this->buildHeadingComponent(new Tfoot(), $this->tfootData);
  }

  /**
   * 
   * @return TableRowContainer
   */
  protected function buildHeadingComponent(TableRowContainer $cont, array $data) {
    foreach ($data as $row) {
      if ($this->lineNumbersVisible()) {
        array_unshift($row, new Th('#', 'col'));
      }
      $cont->appendHeaderRow($row);
    }
    return $cont;
  }

  /**
   * 
   * @return Table
   */
  public function buildTable() {
    $table = new Table();
    if (!empty($this->theadData)) {
      $table->thead($this->buildThead());
    }
    if (!empty($this->tbodyData)) {
      $table->tbody($this->buildTbody());
    }
    if (!empty($this->tfootData)) {
      $table->tfoot($this->buildTfoot());
    }
    return $table;
  }

  public function getHtml() {
    return $this->buildTable();
  }

  /**
   * 
   * @param  CsvFile $file
   * @param  int $offset optional offset of the limit
   * @param  int $count optional count of the limit
   * @return TableBuilder
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public static function fromCsvFile(CsvFile $file, $offset = 0, $count = -1) {
    $builder = new TableBuilder();
    if ($offset > 0 || $count !== -1) {
      $data = $file->getChunk($offset, $count);
    } else {
      $data = $file->toArray();
    }
    if ($offset > 0) {
      $headData = $file->getHeaderRow();
    } else {
      $headData = array_shift($data);
    }
    $builder->setTheadData([$headData]);
    $builder->setTbodyData($data);
    $builder->setLineNumbers($offset + 1, 'left');
    return $builder;
  }

}
