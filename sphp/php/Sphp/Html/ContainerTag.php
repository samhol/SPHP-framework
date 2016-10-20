<?php

/**
 * ContainerTag.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use InvalidArgumentException;

/**
 * Class is the base class for all HTML tag components acting as HTML component containers
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-05-03
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ContainerTag extends AbstractContainerTag {

  /**
   * Constructs a new instance
   *
   * **Important!**
   *
   * 1. Parameter `mixed $content` can be of any type that converts to a string
   *    or to an array of strigs. So also objects of any type that implement magic
   *    method `__toString()` are allowed.
   *
   * @param  string $tagName the name of the tag
   * @param  mixed $content the content of the component
   * @throws InvalidArgumentException if the tagname is not valid
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($tagName, $content = null) {
    parent::__construct($tagName);
    if ($content !== null) {
      $this->append($content);
    }
  }

}
