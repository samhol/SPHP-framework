<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Sphp\Stdlib\Datastructures\Arrayable;
use Iterator;
use SplFileObject;
use LimitIterator;
use Sphp\Exceptions\FileSystemException;
use Sphp\Exceptions\LogicException;
use Sphp\Exceptions\OutOfRangeException;

/**
 * CSV file object
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CsvFile implements Arrayable, Iterator {

  /**
   * @var SplFileObject 
   */
  private $file;

  /**
   * the field delimiter (one character only)
   * 
   * @var string 
   */
  private $delimiter;

  /**
   * the field enclosure character (one character only)
   *
   * @var string 
   */
  private $enclosure = '"';

  /**
   * the field escape character (one character only)
   *
   * @var string 
   */
  private $escape;

  /**
   * Constructor
   * 
   * @param  string $filename the CSV file to read
   * @param  string $delimiter optional field delimiter (one character only)
   * @param  string $enclosure optional field enclosure character (one character only)
   * @param  string $escape optional field escape character (one character only)
   * @throws FileSystemException if the filename cannot be opened
   */
  public function __construct(string $filename, string $delimiter = ',', string $enclosure = '"', string $escape = "\\") {
    try {
      $this->file = new SplFileObject($filename, 'r+');
    } catch (\RuntimeException $ex) {
      throw new FileSystemException($ex->getMessage(), $ex->getCode(), $ex);
    }
    $this->delimiter = $delimiter;
    $this->enclosure = $enclosure;
    $this->escape = $escape;
    $this->file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY | SplFileObject::DROP_NEW_LINE);
    $this->file->setCsvControl($this->delimiter, $this->enclosure, $this->escape);
  }

  /**
   * Writes a field array as a CSV line
   * 
   * @param  array $fields an array of values
   * @return $this for a fluent interface
   */
  public function appendRow(array $fields) {
    $this->file->fputcsv($fields, $this->delimiter, $this->enclosure, $this->escape);
    return $this;
  }

  /**
   * Sets the internal pointer to the given line number of the CSV file
   * 
   * @param  int $line the line number of the CSV file
   * @return $this for a fluent interface
   * @throws LogicException if the $line number is invalid
   */
  public function seek(int $line) {
    try {
      $this->file->seek($line);
    } catch (\LogicException $ex) {
      throw new LogicException($ex->getMessage(), $ex->getCode(), $ex);
    }
    if (!$this->file->valid()) {
      throw new OutOfRangeException("Can't seek file {$this->file->getFilename()} to line $line");
    }
    return $this;
  }

  /**
   * Returns the header row (first row) of the CSV file
   * 
   * @return string[] indexed array containing the fields of the header row
   * @see    http://php.net/manual/en/splfileobject.fgetcsv.php
   */
  public function getHeaderRow(): array {
    $this->file->rewind();
    return $this->file->fgetcsv();
  }

  /**
   * 
   * @param  int $offset optional offset of the limit
   * @param  int $count optional count of the limit
   * @return string[]
   */
  public function getChunk(int $offset = 0, int $count = -1): array {
    $this->file->rewind();
    //var_dump($this->file->getCsvControl());
    foreach (new LimitIterator($this->file, $offset, $count) as $row => $line) {
      #save $line
      $result[$row] = $line;
    }
    //var_dump($result);
    return $result;
  }

  public function toArray(): array {
    $arr = [];
    foreach ($this->file as $key => $row) {
      if ($row !== false) {
        $arr[$key] = $row;
      }
    }
    $this->rewind();
    return $arr;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return $this->file->current();
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return $this->file->key();
  }

  /**
   * Advance the internal pointer of the collection
   */
  public function next() {
    $this->file->next();
  }

  /**
   * Rewinds the Iterator to the first element
   */
  public function rewind() {
    $this->file->rewind();
  }

  /**
   * Checks whether EOF has been reached
   * 
   * @return boolean true if not reached EOF, false otherwise.
   */
  public function valid(): bool {
    return $this->file->valid() && $this->current() !== false;
  }

  /**
   * 
   * 
   * @param  string $filename
   * @param  array $lines
   * @param  string $delimiter
   * @param  string $enclosure
   * @param  string $escape
   * @return CsvFile
   */
  public static function fromArray(string $filename, array $lines, string $delimiter = ',', string $enclosure = '"', string $escape = "\\"): CsvFile {
    Filesystem::mkFile($filename);
    $csvObj = new CsvFile($filename, $delimiter, $enclosure, $escape);
    foreach ($lines as $line) {
      $csvObj->appendRow($line);
    }
    return $csvObj;
  }

}
