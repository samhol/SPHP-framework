<?php

/**
 * TableBuilder.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Tables;

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
  }

  public function getLineNumbers() {
    return $this->lineNumbers;
  }

  public function getTheadData() {
    return $this->theadData;
  }

  public function getTbodyData() {
    return $this->tbodyData;
  }

  public function getTfootData() {
    return $this->tfootData;
  }

  public function setLineNumbers($start = 1, $position = 'none') {
    $this->lineNumbers = ['start' => $start, 'position' => $position];
    return $this;
  }

  public function getFirstLineNumber() {
    return $this->lineNumbers['start'];
  }

  public function lineNumbersVisible() {
    return $this->lineNumbers['position'] !== 'none';
  }

  public function setTheadData($theadData) {
    $this->theadData = $theadData;
    return $this;
  }

  public function setTbodyData($tbodyData) {
    $this->tbodyData = $tbodyData;
    return $this;
  }

  public function setTfootData($tfootData) {
    $this->tfootData = $tfootData;
    return $this;
  }

  public function useLineNumbers($use) {
    $this->lineNumbers['use'] = (bool) $use;
    return $this;
  }

  /**
   * 
   * @return Tbody
   */
  public function buildThead() {
    $tbody = new Thead();
    foreach ($this->theadData as $row) {
      $tbody->appendHeaderRow($row);
    }
    return $tbody;
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
        array_unshift($row, $lineNumber++);
      }
      $tbody->appendBodyRow($row);
    }
    return $tbody;
  }

  /**
   * 
   * @param  array $data
   * @return Tbody|null
   */
  public function buildTfoot() {
    $tfoot = new Tfoot();
    foreach ($this->tfootData as $row) {
      $tfoot->appendBodyRow($row);
    }
    return $tfoot;
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

}
