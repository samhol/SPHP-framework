<?php

/**
 * LocalFile.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Util;

/**
 * Class contains tools to work with the local files and directories
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-08-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class LocalFile {

  /**
   * the path  to the prosessed file
   *
   * @var string
   */
  private $filename;

  /**
   * the path  to the prosessed file
   *
   * @var \SplFileObject
   */
  private $file;

  /**
   * Constructs a new instance
   * 
   * @param  string $filename the file to read
   * @throws \RuntimeException if the filename cannot be opened
   */
  public function __construct($filename) {
    $this->setFile($filename);
  }

  /**
   * Sets the file to read
   *
   * @param  string|null $filename the file to read
   * @return self for PHP Method Chaining
   * @throws \RuntimeException if the filename cannot be opened
   */
  public function setFile($filename) {
    $this->file = new \SplFileObject($filename);
    $this->filename = $this->file->getRealPath();
    //$this->file->
    return $this;
  }

  /**
   * Returns an object oriented interface for the current file
   * 
   * @return \SplFileObject
   */
  public function getSplFileObject() {
    return $this->file;
  }

  public function getRealPath() {
    return $this->file->getRealPath();
  }

  /**
   * Executes a PHP script and returns the result as a string
   *
   * @param  string $filePath the path to the executable PHP script
   * @return string the result of the script execution
   */
  public function executeToString() {
    try {
      ob_start();
      include($this->getRealPath());
      $content = ob_get_contents();
    } catch (\Exception $e) {
      $content .= $e;
    }
    ob_end_clean();
    return $content;
  }

  /**
   * Executes a PHP script and returns the result as a parsed Markdown string
   *
   * @param  string $page the path to the executable PHP script
   * @return string the result of the script execution
   */
  public function parseMarkdown() {
    return (new \ParsedownExtraPlugin())->text($this->executeToString());
  }

  /**
   * Parses a csv file to an array
   *
   * @param  string $page the path to the executable PHP script
   * @return string the result of the script execution
   * @throws \InvalidArgumentException if the script can not be executed
   */
  public function csvToArray($delimiter = ",", $enclosure = "\"", $escape = "\\") {
    $this->file->setFlags(\SplFileObject::READ_CSV);
    foreach ($this->file as $row) {
      $arr[] = $row;
    }
    return $arr;
  }

  /**
   * Parses each non empty ascii file rows to an array
   *
   * @return string[] rows of the ascii file in an array
   */
  public function getTextFileRows() {
    $this->file->setFlags(\SplFileObject::READ_AHEAD | \SplFileObject::SKIP_EMPTY | \SplFileObject::DROP_NEW_LINE);
    while (!$this->file->eof()) {
      $result[] = $this->file->fgets();
    }
    return $result;
  }

  /**
   * Returns the names of the content files of a directory
   * 
   * @param  string $dir
   * @return string[] the file names of the content files and directories
   */
  public static function dirToArray($dir) {
    $contents = array();
    foreach (scandir($dir) as $node) {
      if ($node == '.' || $node == '..') {
        continue;
      }
      if (is_dir($dir . '/' . $node)) {
        $contents[$node] = dirToArray($dir . '/' . $node);
      } else {
        $contents[] = $node;
      }
    }
    return $contents;
  }

}
