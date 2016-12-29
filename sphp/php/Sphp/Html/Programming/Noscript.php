<?php

/**
 * Noscript.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Programming;

use Sphp\Html\ContainerTag;
use Sphp\Html\Head\HeadComponentInterface;

/**
 * Implements an HTML &lt;noscript&gt; tag
 * 
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-03-06
 * @link    http://www.w3schools.com/tags/tag_noscript.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Noscript extends ContainerTag implements HeadComponentInterface {

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
