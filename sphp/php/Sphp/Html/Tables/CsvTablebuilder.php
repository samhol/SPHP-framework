<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use Sphp\Stdlib\Parsers\CsvFile;

/**
 * Implementation of an HTML table builder from CSV data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CsvTablebuilder {

  /**
   * @var bool 
   */
  private bool $useHead;

  /**
   * @var CsvFile 
   */
  private CsvFile $csvData;

  /**
   * @var int 
   */
  private int $offset;

  /**
   * @var int|null
   */
  private ?int $rowCount;

  /**
   * @var int 
   */
  private int $useLinenumbers;

  public function __construct(bool $useHead = false, int $offset = 0, int $count = -1, int $lineNumbers = LineNumberer::LEFT) {
    $this->setUseHead($useHead)->setRange($offset, $count);
    $this->useLinenumbers($lineNumbers);
  }

  public function __destruct() {
    unset($this->csvData);
  }

  /**
   * 
   * @param  string $filename
   * @param  string $delimiter
   * @param  string $enclosure
   * @param  string $escape
   * @return $this for a fluent interface
   */
  public function useFile(string $filename, string $delimiter = ',', string $enclosure = '"', string $escape = "\\") {
    $this->setCsvData(new CsvFile($filename, $delimiter, $enclosure, $escape));
    return $this;
  }

  /**
   * 
   * @param  int $offset
   * @param  int|null $rowCount
   * @return $this for a fluent interface
   */
  public function setRange(int $offset = 0, ?int $rowCount = null) {
    $this->offset = $offset;
    $this->rowCount = $rowCount;
    return $this;
  }

  public function getUseHead(): bool {
    return $this->useHead;
  }

  public function getCsvData(): CsvFile {
    return $this->csvData;
  }

  public function getOffset(): int {
    return $this->offset;
  }

  public function getRowCount(): ?int {
    return $this->rowCount;
  }

  public function usesLinenumbers(): int {
    return $this->useLinenumbers;
  }

  public function useLinenumbers(int $useLinenumbers) {
    $this->useLinenumbers = $useLinenumbers;
    return $this;
  }

  public function setUseHead(bool $useHead) {
    $this->useHead = $useHead;
    return $this;
  }

  public function setCsvData(CsvFile $csvData) {
    $this->csvData = $csvData;
    return $this;
  }

  /**
   * 
   * @return Table
   */
  public function build(): Table {
    $builder = new TableBuilder();
    if ($this->getOffset() > 0 || $this->rowCount > 0) {
      $data = $this->getCsvData()->getChunk($this->getOffset(), $this->getRowCount());
    } else {
      $data = $this->getCsvData()->toArray();
    }
    if ($this->getUseHead()) {
      if ($this->getOffset() > 0) {
        $headData = $this->getCsvData()->getHeaderRow();
      } else {
        $headData = array_shift($data);
      }
      $builder->setTheadData($headData);
    }
    $builder->setTbodyData($data);
    if ($this->usesLinenumbers() !== LineNumberer::NONE) {
      $linenumberer = new LineNumberer();
      $linenumberer->setFirstLineNumber($this->getOffset() + 1);
      $builder->addTableFilter($linenumberer);
    }
    return $builder->buildTable();
  }

}
