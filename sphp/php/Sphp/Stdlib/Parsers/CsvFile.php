<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Sphp\Stdlib\Datastructures\Arrayable;
use IteratorAggregate;
use SplFileObject;
use Sphp\Exceptions\FileSystemException;

/**
 * CSV file object
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class CsvFile implements Arrayable ,IteratorAggregate{

  private SplFileObject $file;

  /**
   * the field delimiter (one character only) 
   */
  private string $delimiter;

  /**
   * the field enclosure character (one character only) 
   */
  private string $enclosure = '"';

  /**
   * the field escape character (one character only) 
   */
  private string $escape;

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
    $this->file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY);
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
   * Returns the header row (first row) of the CSV file
   * 
   * @return string[] indexed array containing the fields of the header row
   * @see    https://www.php.net/manual/en/splfileobject.fgetcsv.php
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
    return array_slice($this->toArray(), $offset, $count, true);
  }

  public function toArray(): array {
    return iterator_to_array($this->file);
  }

  public function getIterator(): \Traversable {
    yield from $this->file;
  }

}
