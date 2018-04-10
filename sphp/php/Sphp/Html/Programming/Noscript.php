<?php

/**
 * Noscript.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

use Sphp\Html\ContainerTag;
use Sphp\Html\Head\HeadContent;

/**
 * Implements an HTML &lt;noscript&gt; tag
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_noscript.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Noscript extends ContainerTag implements HeadContent {

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `mixed $content` can be of any type that converts to a
   * string. So also an object of any class that implements magic method
   * `__toString()` is allowed.
   *
   * @param  null|mixed $content the content of the component
   */
  public function __construct($content = null) {
    parent::__construct('noscript', $content);
  }

}
