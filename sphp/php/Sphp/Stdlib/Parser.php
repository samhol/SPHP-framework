<?php

/**
 * Parser.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

use Sphp\Exceptions\RuntimeException;
use Sphp\Exceptions\InvalidAttributeException;
use Sphp\Stdlib\Readers\Reader;

/**
 * Implements a general parser factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class Parser {

  /**
   * @var string[]
   */
  private static $readers = array(
      'ini' => Readers\Ini::class,
      'json' => Readers\Json::class,
      'yaml' => Readers\Yaml::class,
      'yml' => Readers\Yaml::class,
      'markdown' => Readers\Markdown::class,
      'mdown' => Readers\Markdown::class,
      'mkdn' => Readers\Markdown::class,
      'md' => Readers\Markdown::class,
      'mkd' => Readers\Markdown::class,
      'mdwn' => Readers\Markdown::class,
      'mdtxt' => Readers\Markdown::class,
      'mdtext' => Readers\Markdown::class,
      'text' => Readers\Markdown::class,
      'Rmd' => Readers\Markdown::class,
  );

  /**
   * @var Reader[]
   */
  private static $instances = [];

  /**
   * 
   * @param  string $type
   * @return bool
   */
  public static function readerExists(string $type): bool {
    return isset(static::$readers[$type]);
  }

  /**
   *  
   * @param  string $type
   * @return Reader
   * @throws InvalidAttributeException
   */
  public static function getReaderFor(string $type): Reader {
    if (!static::readerExists($type)) {
      throw new InvalidAttributeException("Unsupported data type: '$type'");
    }
    $readerType = static::$readers[$type];
    if (!isset(static::$instances[$readerType])) {
      static::$instances[$readerType] = new $readerType;
    }
    return static::$instances[$readerType];
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
    if (!file_exists($fullPath)) {
      throw new RuntimeException(sprintf(
                      'Filename "%s" cannot be found relative to the working directory', $filepath
      ));
    }
    if ($extension === null) {
      $pathinfo = pathinfo($fullPath);
      if (!isset($pathinfo['extension'])) {
        throw new RuntimeException(sprintf(
                        'Filename "%s" is missing an extension and cannot be auto-detected', $filepath
        ));
      }
      $extension = strtolower($pathinfo['extension']);
    }
    $reader = static::getReaderFor($extension);
    $config = $reader->fromFile($fullPath);
    return $config;
  }

  /**
   * 
   * @param  string $string
   * @param  string $extension
   * @return mixed
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public static function fromString(string $string, string $extension) {
    if (array_key_exists($extension, static::$readers)) {
      $reader = static::getReaderFor($extension);
      $parsed = $reader->fromString($string);
    } else {
      throw new RuntimeException("Unsupported data type: .$extension");
    }

    return $parsed;
  }

}
