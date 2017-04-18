<?php

/**
 * CsvFile.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

use Sphp\Stdlib\Datastructures\Arrayable;
use SplFileObject;
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\RuntimeException;

/**
 * CSV file object
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CsvFile implements Arrayable, \Iterator {

  /**
   *
   * @var callable 
   */
  private $filter;

  /**
   *
   * @var SplFileObject 
   */
  private $file;

  /**
   *
   * @var string 
   */
  private $filename;

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
  private $enclosure;

  /**
   * the field escape character (one character only)
   *
   * @var string 
   */
  private $escape;

  /**
   * Constructs a new instance
   * 
   * @param  string $filename the path to the CSV file
   * @param  string $delimiter optional field delimiter (one character only)
   * @param  string $enclosure optional field enclosure character (one character only)
   * @param  string $escape optional field escape character (one character only)
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function __construct($filename, $delimiter = ',', $enclosure = '"', $escape = "\\") {
    if (!Filesystem::isFile($filename)) {
      throw new RuntimeException("The path '$filename' is not a file");
    }
    $this->filename = $filename;
    $this->delimiter = $delimiter;
    $this->enclosure = $enclosure;
    $this->escape = $escape;
    $this->file = $this->createSplFileObject();
  }

  /**
   * Returns the field delimiter (one character only)
   * 
   * @return string the field delimiter (one character only)
   */
  public function getFilename() {
    return $this->filename;
  }

  /**
   * Returns  the field escape character (one character only)
   * 
   * @return string the field escape character (one character only)
   */
  public function getDelimiter() {
    return $this->delimiter;
  }

  /**
   * Returns the field enclosure character (one character only)
   * 
   * @return string the field enclosure character (one character only)
   */
  public function getEnclosure() {
    return $this->enclosure;
  }

  /**
   * Returns the field escape character (one character only)
   * 
   * @return string the field escape character (one character only)
   */
  public function getEscape() {
    return $this->escape;
  }

  /**
   * 
   * @param  array $data
   * @return self for a fluent interface
   */
  public function appendRow(array $data) {
    if ($data instanceof \Traversable) {
      $data = iterator_to_array($data);
    }
    $this->file->fputcsv($data);
    return $this;
  }

  /**
   * 
   * @return SplFileObject
   */
  public function createSplFileObject() {
    $temp = new SplFileObject($this->filename, 'r');
    $temp->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY);
    $temp->setCsvControl($this->delimiter, $this->enclosure, $this->escape);
    return $temp;
  }

  /**
   * Sets the internal pointer to the given line number of the CSV file
   * 
   * @param  int $line the line number of the CSV file
   * @return self for a fluent interface
   */
  public function seek($line) {
    $this->file->seek($line);
    return $this;
  }

  /**
   * Returns the header row (first row) of the CSV file
   * 
   * @return string[]indexed array containing the fields of the header row
   * @see    http://php.net/manual/en/splfileobject.fgetcsv.php
   */
  public function getHeaderRow() {
    return $this->createSplFileObject()->fgetcsv();
  }

  /**
   * 
   * @param  int $offset optional offset of the limit
   * @param  int $count optional count of the limit
   * @return string[]
   */
  public function getChunk($offset = 0, $count = -1) {
    $this->file->rewind();
    //var_dump($this->file->getCsvControl());
    foreach (new \LimitIterator($this->createSplFileObject(), $offset, $count) as $row => $line) {
      #save $line
      $result[$row] = $line;
    }
    //var_dump($result);
    return $result;
  }

  public function toArray() {
    $arr = [];
    $file = $this->createSplFileObject();
    while (!$file->eof() && ($row = $file->fgetcsv()) && $row[0] !== null) {
      $arr[] = $row;
    }
    return $arr;
  }

  public function current() {
    return $this->file->current();
  }

  public function key() {
    return $this->file->key();
  }

  public function next() {
    $this->file->next();
  }

  public function rewind() {
    $this->file->rewind();
  }

  /**
   * Checks whether EOF has been reached
   * 
   * @return boolean true if not reached EOF, false otherwise.
   */
  public function valid() {
    return $this->file->valid();
  }

}
