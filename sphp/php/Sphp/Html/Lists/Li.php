<?php

/**
 * Li.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Lists;

use Sphp\Html\ContainerTag;
use Sphp\Html\AjaxLoaderInterface;

/**
 * Implements an HTML-list element &lt;li&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-04-03
 * @link    http://www.w3schools.com/tags/tag_li.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Li extends ContainerTag implements LiInterface, AjaxLoaderInterface {

  use \Sphp\Html\AjaxLoaderTrait;

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a
   * PHP string or to an array of strings. So also an object of any class
   * that implements magic method `__toString()` is allowed.
   *
   * @param  null|mixed|mixed[] $content optional content of the component
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content = null) {
    parent::__construct('li', $content);
  }

}
