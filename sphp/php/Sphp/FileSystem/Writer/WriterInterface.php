<?php

/**
 * AbstractWriter.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\FileSystem\Writer;

interface WriterInterface {

  /**
   * Write a config object to a file.
   *
   * @param  string  $filename
   * @param  mixed   $config
   * @param  bool $exclusiveLock
   * @return void
   */
  public function toFile($filename, $config, $exclusiveLock = true);

  /**
   * Write a config object to a string.
   *
   * @param  mixed $config
   * @return string
   */
  public function toString($config);
}
