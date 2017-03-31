<?php

/**
 * Parser.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib;

use Sphp\Exceptions\RuntimeException;
use Sphp\Stdlib\Reader\ReaderInterface;

/**
 * Description of Factory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-09-11
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Parser {

  /**
   *
   * @var string[]
   */
  private static $readers = array(
      'php' => 'php',
      'ini' => Reader\Ini::class,
      'json' => Reader\Json::class,
      'yaml' => Reader\Yaml::class,
      'yml' => Reader\Yaml::class,
      'markdown' => Reader\Markdown::class,
      'mdown' => Reader\Markdown::class,
      'mkdn' => Reader\Markdown::class,
      'md' => Reader\Markdown::class,
      'mkd' => Reader\Markdown::class,
      'mdwn' => Reader\Markdown::class,
      'mdtxt' => Reader\Markdown::class,
      'mdtext' => Reader\Markdown::class,
      'text' => Reader\Markdown::class,
      'Rmd' => Reader\Markdown::class,
  );

  /**
   *
   * @var ReaderInterface[]
   */
  private static $instances = [];

  public static function readerExists($type) {
    return array_key_exists($type, static::$readers);
  }

  /**
   * 
   * @param  string $type
   * @return ReaderInterface
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public static function getReader($type) {
    if (!static::readerExists($type)) {
      throw new RuntimeException("Unsupported data type: '$type'");
    }
    $readerType = static::$readers[$type];
    if (!array_key_exists($readerType, static::$instances)) {
      static::$instances[$readerType] = new $readerType;
    }
    return static::$instances[$readerType];
  }

  /**
   * 
   * @param  string $filepath
   * @param  string $extension
   * @return mixed
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public static function fromFile($filepath, $extension = null) {
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
    if ($extension === 'php') {
      if (!is_file($fullPath) || !is_readable($fullPath)) {
        throw new RuntimeException("File '$filepath' doesn't exist or not readable");
      }
      $config = include $filepath;
    } else if (array_key_exists($extension, static::$readers)) {
      $reader = static::getReader($extension);
      $config = $reader->fromFile($fullPath);
    } else {
      throw new RuntimeException("Unsupported file type: .$extension");
    }
    return $config;
  }

  /**
   * 
   * @param  string $string
   * @param  string $extension
   * @return mixed
   * @throws \Sphp\Exceptions\RuntimeException
   */
  public static function fromString($string, $extension) {
    if (array_key_exists($extension, static::$readers)) {
      $reader = static::getReader($extension);
      $parsed = $reader->fromString($string);
    } else {
      throw new RuntimeException("Unsupported data type: .$extension");
    }

    return $parsed;
  }

}
