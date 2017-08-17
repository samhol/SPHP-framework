<?php

/**
 * AbstractComponentGenerator.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Description of AbstractComponentGenerator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-04-26
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractComponentGenerator implements ContentInterface {

  use ContentTrait;

  public function getHtml(): string {
    return $this->generate()->getHtml();
  }

  /**
   * Generates an HTML component containing the links
   * 
   * @return ContentInterface HTML component containing the links
   */
  abstract public function generate();
}
