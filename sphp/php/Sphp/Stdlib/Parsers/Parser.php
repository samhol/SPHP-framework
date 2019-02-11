<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use Sphp\Exceptions\RuntimeException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\FileSystemException;
use Sphp\Exceptions\BadMethodCallException;

/**
 * Implements a general parser factory
 * 
 * @method \Sphp\Stdlib\Parsers\Markdown md() Returns singleton instance of `markdown` reader
 * @method \Sphp\Stdlib\Parsers\Yaml yaml() Returns singleton instance of `yaml` reader
 * @method \Sphp\Stdlib\Parsers\Ini ini() Returns singleton instance of `ini` reader
 * @method \Sphp\Stdlib\Parsers\Json json() Returns singleton instance of `json` reader
 * @method \Sphp\Stdlib\Parsers\Csv csv() Returns singleton instance of `csv` reader
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class Parser {

  /**
   * @var string[]
   */
  private static $readers = array(
      'ini' => Ini::class,
      'json' => Json::class,
      'yaml' => Yaml::class,
      'yml' => Yaml::class,
      'markdown' => Markdown::class,
      'mdown' => Markdown::class,
      'mkdn' => Markdown::class,
      'md' => Markdown::class,
      'mkd' => Markdown::class,
      'mdwn' => Markdown::class,
      'mdtxt' => Markdown::class,
      'mdtext' => Markdown::class,
      'text' => Markdown::class,
      'Rmd' => Markdown::class,
      'csv' => Csv::class,
  );

  /**
   * @var Reader[]
   */
  private static $instances = [];

  /**
   * Checks whether a reader exists for given data type
   * 
   * @param  string $type data type
   * @return bool true if a reader exists for given data type and false otherwise
   */
  public static function readerExists(string $type): bool {
    return isset(static::$readers[$type]);
  }

  /**
   * Returns a singleton reader instance of given data type
   *  
   * @param  string $type data type
   * @return Reader a singleton reader instance of given data type
   * @throws InvalidAttributeException
   */
  public static function getReaderFor(string $type) {
    if (!isset(static::$readers[$type])) {
      throw new InvalidArgumentException("Unsupported data type: '$type'");
    }
    $readerType = static::$readers[$type];
    if (!isset(static::$instances[$readerType])) {
      static::$instances[$readerType] = new $readerType;
    }
    return static::$instances[$readerType];
  }

  /**
   * Returns singleton instance of a specific reader object
   *
   * @param  string $name the name of the component
   * @param  array $arguments 
   * @return Reader the corresponding singleton instance of reader object
   * @throws BadMethodCallException if the parser does not exist
   */
  public static function __callStatic(string $name, array $arguments) {
    try {
      return static::getReaderFor($name);
    } catch (\Exception $ex) {
      throw new BadMethodCallException($ex->getMessage(), $ex->getCode(), $ex);
    }
  }

  /**
   * Parses given file to certain output format
   * 
   * @param  string $filepath path to the input file
   * @param  string|null $extension optional file type extension
   * @return mixed parsed output
   * @throws RuntimeException
   * @throws InvalidArgumentException
   */
  public static function fromFile(string $filepath, string $extension = null) {
    $fullPath = Filesystem::getFullPath($filepath);
    if ($extension === null) {
      $pathinfo = pathinfo($fullPath);
      if (!isset($pathinfo['extension'])) {
        throw new InvalidArgumentException(sprintf('Filename "%s" is missing an extension and cannot be auto-detected', $filepath));
      }
      $extension = strtolower($pathinfo['extension']);
    }
    $reader = static::getReaderFor($extension);
    if ($reader instanceof Reader) {
      return $reader->readFromFile($fullPath);
    } else if ($reader instanceof StringConverter) {
      return $reader->parseFile($fullPath);
    }
  }

  /**
   * Parses given string to certain output format
   * 
   * @param  string $string input string
   * @param  string $extension data type
   * @return mixed parsed output
   * @throws RuntimeException
   */
  public static function fromString(string $string, string $extension) {
    if (array_key_exists($extension, static::$readers)) {
      $reader = static::getReaderFor($extension);
      if ($reader instanceof Reader) {
        return $reader->readFromString($string);
      } else if ($reader instanceof StringConverter) {
        return $reader->parseString($string);
      }
    } else {
      throw new RuntimeException("Unsupported data type: .$extension");
    }
  }

}
