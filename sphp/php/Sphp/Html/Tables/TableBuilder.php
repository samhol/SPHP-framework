<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use Sphp\Html\AbstractContent;
use Sphp\Stdlib\Parsers\CsvFile;
use Sphp\Stdlib\Arrays;

/**
 * Description of TableBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TableBuilder extends AbstractContent {

  /**
   * @var array 
   */
  private $theadData;

  /**
   * @var array 
   */
  private $tbodyData;

  /**
   * @var array 
   */
  private $tfootData;

  /**
   * @var TableFilter 
   */
  private $tableFilters = [];

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->tableFilters);
  }

  public function addTableFilter(TableFilter $filter) {
    $this->tableFilters[] = $filter;
    return $this;
  }

  /**
   * Returns the table header content data
   * 
   * @return array the table header content data
   */
  public function getTheadData(): ?array {
    return $this->theadData;
  }

  /**
   * Returns the table body content data
   * 
   * @return array the table body content data
   */
  public function getTbodyData(): ?array {
    return $this->tbodyData;
  }

  /**
   * Returns the table footer content data
   * 
   * @return array the table footer content data
   */
  public function getTfootData(): ?array {
    return $this->tfootData;
  }

  /**
   * Sets the cell data for table head
   * 
   * @param  array $data the cell data for table head
   * @return $this for a fluent interface
   */
  public function setTheadData(array $data = null) {
    $this->theadData = Arrays::setSequential($data, 0, 1);
    return $this;
  }

  /**
   * Sets the cell data for table body
   * 
   * @param  mixed[][] $data the cell data for table body
   * @return $this for a fluent interface
   */
  public function setTbodyData(array $data = null) {
    $this->tbodyData = $data;
    return $this;
  }

  /**
   * Sets the cell data for table footer
   * 
   * @param  array $data the cell data for table footer
   * @return $this for a fluent interface
   */
  public function setTfootData(array $data = null) {
    $this->tfootData = $data;
    return $this;
  }

  /**
   * Sets the body of the given table object
   * 
   * @param  Table $table modifiable table
   * @return Table modified table object
   */
  public function buildTbody(Table $table): Table {
    if (!empty($this->tbodyData)) {
      $tbody = new Tbody();
      foreach ($this->tbodyData as $rowData) {
        $tbody->append(Tr::fromTds($rowData));
      }
      $table->setTbody($tbody);
    }
    return $table;
  }

  /**
   * Sets the head of the given table object
   * 
   * @param  Table $table modifiable table
   * @return Table modified table object
   */
  public function buildHead(Table $table): Table {
    if (!empty($this->theadData)) {
      $head = new Thead();
      $head->appendHeaderRow($this->theadData);
      $table->setThead($head);
    }
    return $table;
  }

  /**
   * Sets the footer of the given table object
   * 
   * @param  Table $table modifiable table
   * @return Table modified table object
   */
  public function buildFoot(Table $table): Table {
    if ($this->tfootData !== null) {
      $foot = new Tfoot();
      $foot->appendHeaderRow($this->tfootData);
      $table->setTfoot($foot);
    }
    return $table;
  }

  /**
   * 
   * @return Table
   */
  public function buildTable(Table $table = null): Table {
    if ($table === null) {
      $table = new Table();
    }
    $this->buildTbody($table);
    $this->buildHead($table);
    $this->buildFoot($table);
    foreach ($this->tableFilters as $filter) {
      $filter->useInTable($table);
    }
    return $table;
  }

  public function getHtml(): string {
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
  public static function fromCsvFile(CsvFile $file, $offset = 0, $count = -1): TableBuilder {
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
    $builder->setTheadData($headData);
    $builder->setTbodyData($data);
    $linenumberer = new LineNumberer();
    $linenumberer->setFirstLineNumber($offset + 1)->prependLineNumbers(true);
    $builder->addTableFilter($linenumberer);
    return $builder;
  }

}
