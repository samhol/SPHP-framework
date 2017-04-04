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
   * @var SplFileObject 
   */
  private $file;

  /**
   *
   * @var string 
   */
  private $filename;

  /**
   *
   * @var string 
   */
  private $delimiter;

  /**
   *
   * @var string 
   */
  private $enclosure;

  /**
   *
   * @var string 
   */
  private $escape;

  /**
   * Constructs a new instance
   * 
   * @param  string $filename
   * @param  string $delimiter (one character only)
   * @param  string $enclosure (one character only)
   * @param  string $escape (one character only)
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public function __construct($filename, $delimiter = ",", $enclosure = '"', $escape = "\\") {
    if (!Filesystem::isFile($filename)) {
      throw new RuntimeException("The path '$filename' is not a file");
    }
    $this->filename = $filename;
    $this->delimiter = $delimiter;
    $this->enclosure = $enclosure;
    $this->escape = $escape;
    $this->file = new SplFileObject($filename, 'r');
    $this->file->setCsvControl($delimiter, $enclosure, $escape);
  }

  public function getFilename() {
    return $this->filename;
  }

  public function getDelimiter() {
    return $this->delimiter;
  }

  public function getEnclosure() {
    return $this->enclosure;
  }

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
    $temp->setFlags(SplFileObject::READ_CSV);
    $temp->setCsvControl($this->delimiter, $this->enclosure, $this->escape);
    return $temp;
  }

  /**
   * 
   * @param  int $line
   * @return self for a fluent interface
   */
  public function seek($line) {
    $this->file->seek($line);
    return $this;
  }

  /**
   * 
   * @return string[]
   */
  public function getHeader() {
    $temp = new SplFileObject($this->filename, 'r');
    $temp->setCsvControl($this->delimiter, $this->enclosure, $this->escape);
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
    foreach (new \LimitIterator($this->file, $offset, $count) as $row => $line) {
      #save $line
      $result[$row] = str_getcsv($line, $this->delimiter, $this->delimiter, $this->escape);
    }
    //var_dump($result);
    return $result;
  }

  public function toArray() {
    $arr = [];
    $this->file->setFlags(SplFileObject::DROP_NEW_LINE);
    $this->file->rewind();
    while (!$this->file->eof() && ($row = $this->file->fgetcsv()) && $row[0] !== null) {
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

  public function valid() {
    return $this->file->valid();
  }

}
