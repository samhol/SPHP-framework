<?php

/**
 * Span.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Class models an HTML &lt;span&gt; tag
 *
 * The &lt;span&gt; tag is used to group inline-elements in a document. It
 * provides no visual change by itself. The &lt;span&gt; tag provides a
 * way to add a hook to a part of a text or a part of a document. When a text
 * is hooked in a &lt;span&gt; element, you can style it with CSS, or
 * manipulate it with JavaScript.
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-06-03
 * @version 1.0.0
 * @link    http://www.w3schools.com/tags/tag_p.asp w3schools HTML API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Span extends ContainerTag {

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "span";

  /**
   * Constructs a new instance
   *
   * @param  null|mixed $content optional content of the component
   * @param  string $class the class attribute
   * @link   http://www.w3schools.com/tags/att_global_class.asp class attribute
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($content = null, $class = "") {
    parent::__construct(self::TAG_NAME, $content);
    if ($class != "") {
      $this->addCssClass($class);
    }
  }

}
