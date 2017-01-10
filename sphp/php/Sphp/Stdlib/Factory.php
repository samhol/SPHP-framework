<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Stdlib;

use RuntimeException;

/**
 * Description of Factory
 *
 * @author Sami Holck
 */
class Factory {

  protected static $readers = array(
      'php' => 'php',
      'ini' => 'ini',
      'json' => 'json',
      'yaml' => Reader\Yaml::class,
      'yml' => Reader\Yaml::class,
      'yml' => Reader\Yaml::class,
      'markdown' => Reader\MarkDown::class,
      'mdown' => Reader\MarkDown::class,
      'mkdn' => Reader\MarkDown::class,
      'md' => Reader\MarkDown::class,
      'mkd' => Reader\MarkDown::class,
      'mdwn' => Reader\MarkDown::class,
      'mdtxt' => Reader\MarkDown::class,
      'mdtext' => Reader\MarkDown::class,
      'text' => Reader\MarkDown::class,
      'Rmd' => Reader\MarkDown::class,
  );
  private static $instances = [];

  public static function readerExists($type) {
    return array_key_exists($type, static::$readers);
  }

  public static function getReader($type) {
    if (!static::readerExists($type)) {
      throw new RuntimeException("Unsupported data type: '$type'");
    }
    $readerType = new static::$readers[$extension];
    if (!array_key_exists($readerType, static::$instances)) {
      static::$instances[$readerType] = new $readerType;
    }
    return static::$instances[$readerType];
  }

  public static function fromFile($filepath) {
    if (!file_exists($filepath)) {
      throw new RuntimeException(sprintf(
              'Filename "%s" cannot be found relative to the working directory', $filepath
      ));
    }
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
      $reader = new static::$readers[$extension];
      $reader = new static::$readers[$extension];

      /* @var Reader\ReaderInterface $reader */
      $config = $reader->fromFile($filepath);
    } else {
      throw new RuntimeException(sprintf(
              'Unsupported config file extension: .%s', $pathinfo['extension']
      ));
    }

    return $config;
  }

}
