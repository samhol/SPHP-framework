<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Stdlib;

use RuntimeException;
use Sphp\Stdlib\Reader\ReaderInterface;

/**
 * Description of Factory
 *
 * @author Sami Holck
 */
class Parser {

  /**
   *
   * @var string[]
   */
  protected static $readers = array(
      'php' => 'php',
      'ini' => Reader\Ini::class,
      'json' => Reader\Json::class,
      'yaml' => Reader\Yaml::class,
      'yml' => Reader\Yaml::class,
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
   * @throws RuntimeException
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
   * @return mixed
   * @throws RuntimeException
   */
  public static function fromFile($filepath, $extension = null) {
    if (!file_exists($filepath)) {
      throw new RuntimeException(sprintf(
              'Filename "%s" cannot be found relative to the working directory', $filepath
      ));
    }
    if ($extension === null) {
      $pathinfo = pathinfo($filepath);
      if (!isset($pathinfo['extension'])) {
        throw new RuntimeException(sprintf(
                'Filename "%s" is missing an extension and cannot be auto-detected', $filepath
        ));
      }
      $extension = strtolower($pathinfo['extension']);
      if ($extension === 'php') {
        if (!is_file($filepath) || !is_readable($filepath)) {
          throw new RuntimeException(sprintf(
                  "File '%s' doesn't exist or not readable", $filepath
          ));
        }
        $config = include $filepath;
      } else if (array_key_exists($extension, static::$readers)) {
        $reader = static::getReader($extension);
        $config = $reader->fromFile($filepath);
      } else {
        throw new RuntimeException(sprintf(
                'Unsupported config file extension: .%s', $pathinfo['extension']
        ));
      }
    }
    return $config;
  }

  public static function fromMdFile($filepath) {
    
  }

  public static function fromYamlFile($filepath) {
    
  }

}
