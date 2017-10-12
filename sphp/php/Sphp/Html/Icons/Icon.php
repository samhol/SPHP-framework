<?php

/**
 * Icon.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Icons;

/**
 * Description of Icon
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Icon extends AbstractIcon {

  /**
   * 
   * @param  string|string[] $iconName the icon name 
   * @param  string $tagName the tag name 
   * @throws \Sphp\Exceptions\InvalidArgumentException if the tag name is not valid
   */
  public function __construct($iconName, string $tagName = 'i') {
    parent::__construct($tagName);
    $this->cssClasses()->lock($iconName);
  }

}
