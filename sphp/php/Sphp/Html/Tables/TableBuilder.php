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
   * @var array 
   */
  private $labels = [];

  /**
   * @var LineNumberer
   */
  private $lineNumberer;

  /**
   * Constructor
   *
   * @param LineNumberer|null $lineNumberer
   */
  public function __construct(LineNumberer $lineNumberer = null) {
    if ($lineNumberer === null) {
      $lineNumberer = new LineNumberer();
    }
    $this->setLineNumberer($lineNumberer);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->lineNumberer);
  }

  /**
   * Returns the line numberer object
   * 
   * @return LineNumberer
   */
  public function getLineNumberer(): LineNumberer {
    return $this->lineNumberer;
  }

  /**
   * Sets the line numberer object
   * 
   * @param  LineNumberer $lineNumberer line numberer to set
   * @return $this
   */
  public function setLineNumberer(LineNumberer $lineNumberer) {
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

  public function useCellLabels(array $labels) {
    $this->labels = $labels;
    return $this;
  }

  /**
   * 
   * @param  array $data
   * @return $this for a fluent interface
   */
  public function setTheadData(array $data) {
    $this->theadData = \Sphp\Stdlib\Arrays::setSequential($data, 0, 1);
    return $this;
  }

  /**
   * 
   * @param  array $data
   * @return $this for a fluent interface
   */
  public function setTbodyData(array $data) {
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
   * @return Tbody
   */
  public function buildTbody(): Tbody {
    $tbody = new Tbody();
    foreach ($this->tbodyData as $row) {
      $tbody->append($this->buildRow($row));
    }
    return $tbody;
  }

  protected function buildRow(array $rowData) {
    $tr = Tr::fromTds($rowData);
    foreach ($this->theadData as $id => $label) {
      try {
        $tr->getCell($id)->setAttribute('data-label', $label);
      } catch (\Exception $ex) {
        
      }
    }
    return $tr;
  }

  private function buildHead(Table $table): Table {
    if (!empty($this->theadData)) {
      $foot = new Thead();
      $foot->appendHeaderRow($this->theadData);
      $table->thead($foot);
    }
    return $table;
  }

  /**
   * 
   * @return Table
   */
  private function buildFoot(Table $table): Table {
    if (!empty($this->tfootData)) {
      $foot = new Tfoot();
      $foot->appendHeaderRow($this->tfootData);
      $table->tfoot($foot);
    }
    return $table;
  }

  /**
   * 
   * @return Table
   */
  public function buildTable(): Table {
    $table = new Table();
    $table->addCssClass('responsive-card-table', 'unstriped');
    if (!empty($this->tbodyData)) {
      $table->tbody($this->buildTbody());
    }
    $this->buildHead($table);
    $this->buildFoot($table);
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
    $builder->setTheadData($headData);
    $builder->setTbodyData($data);
    $builder->getLineNumberer()->setFirstLineNumber($offset + 1)->prependLineNumbers(true);
    return $builder;
  }

}
