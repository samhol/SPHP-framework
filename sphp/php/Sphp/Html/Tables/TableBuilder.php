<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use Sphp\Html\AbstractContent;

/**
 * Implementation of an HTML table factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TableBuilder extends AbstractContent {

  private ?iterable $theadData;
  private ?iterable $tbodyData;
  private ?iterable $tfootData;

  /**
   * @var TableFilter[]
   */
  private array $tableFilters = [];

  /**
   * Constructor
   */
  public function __construct() {
    $this->tableFilters = [];
    $this->theadData = null;
    $this->tbodyData = null;
    $this->tfootData = null;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->tableFilters, $this->theadData, $this->tbodyData, $this->tfootData);
  }

  /**
   * Adds a Filter to further manipulate created tables
   * 
   * @param  callable $filter
   * @return $this for a fluent interface
   */
  public function addTableFilter(callable $filter) {
    $this->tableFilters[] = $filter;
    return $this;
  }

  /**
   * Returns the table header content data
   * 
   * @return iterable|null the table header content data
   */
  public function getTheadData(): ?array {
    return $this->theadData;
  }

  /**
   * Returns the table body content data
   * 
   * @return iterable|null the table body content data
   */
  public function getTbodyData(): ?array {
    return $this->tbodyData;
  }

  /**
   * Returns the table footer content data
   * 
   * @return iterable|null the table footer content data
   */
  public function getTfootData(): ?array {
    return $this->tfootData;
  }

  /**
   * Sets the cell data for table head
   * 
   * @param  iterable|null $data the cell data for table head
   * @return $this for a fluent interface
   */
  public function setTheadData(?iterable $data = null) {
    $this->theadData = $data;
    return $this;
  }

  /**
   * Sets the cell data for table body
   * 
   * @param  iterable|null $data the cell data for table body
   * @return $this for a fluent interface
   */
  public function setTbodyData(?iterable $data = null) {
    $this->tbodyData = $data;
    return $this;
  }

  /**
   * Sets the cell data for table footer
   * 
   * @param  iterable|null $data the cell data for table footer
   * @return $this for a fluent interface
   */
  public function setTfootData(?iterable $data = null) {
    $this->tfootData = $data;
    return $this;
  }

  /**
   * Builds the tbody object using the data
   * 
   * @return Tbody modified resulting tbody element
   */
  public function buildTbody(): Tbody {
    $tbody = new Tbody();
    if ($this->tbodyData !== null) {
      foreach ($this->tbodyData as $rowData) {
        $tbody->append(Tr::fromTds($rowData));
      }
    }
    return $tbody;
  }

  /**
   * Builds the Thead object using the data
   * 
   * @return Thead modified resulting Thead element
   */
  public function buildThead(): Thead {
    $thead = new Thead();
    if ($this->theadData !== null) {
      $thead->appendHeaderRow($this->theadData);
    }
    return $thead;
  }

  /**
   * Builds the Tfoot object using the data
   * 
   * @return Tfoot modified resulting Tfoot element
   */
  public function buildTfoot(): Tfoot {
    $tfoot = new Tfoot();
    if ($this->tfootData !== null) {
      $tfoot->appendHeaderRow($this->tfootData);
    }
    return $tfoot;
  }

  /**
   * 
   * @return Table
   */
  public function buildTable(Table $table = null): Table {
    if ($table === null) {
      $table = new Table();
    }
    if (!empty($this->tbodyData)) {
      $table->setContent($this->buildTbody());
    }
    if (!empty($this->theadData)) {
      $table->setContent($this->buildThead());
    }
    if (!empty($this->tfootData)) {
      $table->setContent($this->buildTfoot());
    }
    foreach ($this->tableFilters as $filter) {
      $filter($table);
    }
    return $table;
  }

  public function getHtml(): string {
    return $this->buildTable();
  }

}
