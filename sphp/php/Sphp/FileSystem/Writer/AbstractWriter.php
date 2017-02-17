<?php

/**
 * AbstractWriter.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Filesystem\Writer;

use Traversable;
use Exception;
use InvalidArgumentException;
use RuntimeException;
use Zend\Stdlib\ArrayUtils;

abstract class AbstractWriter implements WriterInterface {

  /**
   * toFile(): defined by Writer interface.
   *
   * @see    WriterInterface::toFile()
   * @param  string  $filename
   * @param  mixed   $config
   * @param  bool $exclusiveLock
   * @return void
   * @throws InvalidArgumentException
   * @throws RuntimeException
   */
  public function toFile($filename, $config, $exclusiveLock = true) {
    if (empty($filename)) {
      throw new InvalidArgumentException('No file name specified');
    }

    $flags = 0;
    if ($exclusiveLock) {
      $flags |= LOCK_EX;
    }

    set_error_handler(function ($error, $message = '') use ($filename) {
      throw new RuntimeException(
      sprintf('Error writing to "%s": %s', $filename, $message), $error
      );
    }, E_WARNING
    );
    try {
      file_put_contents($filename, $this->toString($config), $flags);
    } catch (Exception $e) {
      restore_error_handler();
      throw $e;
    }

    restore_error_handler();
  }

  /**
   * toString(): defined by Writer interface.
   *
   * @see    WriterInterface::toString()
   * @param  mixed   $config
   * @return string
   * @throws InvalidArgumentException
   */
  public function toString($config) {
    if ($config instanceof Traversable) {
      $config = ArrayUtils::iteratorToArray($config);
    } elseif (!is_array($config)) {
      throw new InvalidArgumentException(__METHOD__ . ' expects an array or Traversable config');
    }
    return $this->processConfig($config);
  }

  /**
   * @param array $config
   * @return string
   */
  abstract protected function processConfig(array $config);
}
