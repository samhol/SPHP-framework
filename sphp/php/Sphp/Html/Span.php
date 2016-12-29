<?php

/**
 * Span.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Implements an HTML &lt;span&gt; tag
 *
 * The &lt;span&gt; tag is used to group inline-elements in a document. It
 * provides no visual change by itself. The &lt;span&gt; tag provides a
 * way to add a hook to a part of a text or a part of a document. When a text
 * is hooked in a &lt;span&gt; element, you can style it with CSS, or
 * manipulate it with JavaScript.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-06-03
 * @link    http://www.w3schools.com/tags/tag_p.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Span extends ContainerTag {

  /**
   * Constructs a new instance
   *
   * @param  null|mixed $content optional content of the component
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content = null) {
    parent::__construct('span', $content);
  }

}
