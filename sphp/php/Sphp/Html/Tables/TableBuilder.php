<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use Sphp\Stdlib\Parsers\CsvFile;

/**
 * Description of TableBuilder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class TableBuilder implements \Sphp\Html\Content {

  use \Sphp\Html\ContentTrait;

  /**
   * @var array 
   */
  private $theadData = [];

  /**
   * @var array 
   */
  private $tbodyData = [];

  /**
   * @var array 
   */
  private $tfootData = [];

  /**
   * @var LineNumberer
   */
  private $lineNumberer;

  /**
   * Constructor
   */
  public function __construct(LineNumberer $lineNumberer = null) {
    if ($lineNumberer === null) {
      $lineNumberer = new LineNumberer();
    }
    $this->setLineNumberer($lineNumberer);
  }

  public function getLineNumberer(): LineNumberer {
    return $this->lineNumberer;
  }

  public function setLineNumberer($lineNumberer) {
    $this->lineNumberer = $lineNumberer;
    return $this;
  }

  /**
   * Returns the table header content data
   * 
   * @return array the table header content data
   */
  public function getTheadData() {
    return $this->theadData;
  }

  /**
   * Returns the table body content data
   * 
   * @return array the table body content data
   */
  public function getTbodyData() {
    return $this->tbodyData;
  }

  /**
   * Returns the table footer content data
   * 
   * @return array the table footer content data
   */
  public function getTfootData() {
    return $this->tfootData;
  }

  /**
   * 
   * @param  array $data
   * @return $this for a fluent interface
   */
  public function setTheadData($data) {
    $this->theadData = $data;
    return $this;
  }

  /**
   * 
   * @param  array $data
   * @return $this for a fluent interface
   */
  public function setTbodyData($data) {
    $this->tbodyData = $data;
    return $this;
  }

  /**
   * 
   * @param  array $data
   * @return $this for a fluent interface
   */
  public function setTfootData(array $data) {
    $this->tfootData = $data;
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
  public function buildTbody(): Tbody {
    $tbody = new Tbody();
    foreach ($this->tbodyData as $row) {
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
  private function buildHeadingComponent(TableRowContainer $cont, array $data) {
    foreach ($data as $row) {
      $cont->appendHeaderRow($row);
    }
    return $cont;
  }

  /**
   * 
   * @return Table
   */
  public function buildTable(): Table {
    $table = new Table();
    $table->addCssClass('responsive-card-table', 'unstriped');
    if (!empty($this->theadData)) {
      $table->thead($this->buildThead());
    }
    if (!empty($this->tbodyData)) {
      $table->tbody($this->buildTbody());
    }
    if (!empty($this->tfootData)) {
      $table->tfoot($this->buildTfoot());
    }
    $this->lineNumberer->setLineNumbers($table);
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
    $builder->setTheadData([$headData]);
    $builder->setTbodyData($data);
    $builder->getLineNumberer()->setFirstLineNumber($offset + 1)->prependLineNumbers(true);
    return $builder;
  }

}
