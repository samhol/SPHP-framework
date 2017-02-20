<?php

/**
 * AbstractWriter.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Stdlib\Writer;

use Zend\Json\Json as JsonFormat;

class Json extends AbstractWriter {

  /**
   * processConfig(): defined by AbstractWriter.
   *
   * @param  array $config
   * @return string
   */
  public function processConfig(array $config) {
    return JsonFormat::encode($config);
  }

}
