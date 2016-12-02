<?php

/**
 * Base.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Head;

use Sphp\Html\EmptyTag;

/**
 * Class models an HTML &lt;base&gt; tag
 *
 *  The &lt;base&gt; tag specifies the base URL/target for all relative URLs in 
 *  a document. There can be at maximum one &lt;base&gt; element in a document, 
 *  and it must be inside the &lt;head&gt; element.
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-02-03
 * @link    http://www.w3schools.com/tags/tag_base.asp w3schools HTML API
 * @filesource
 */
class Base extends EmptyTag implements HeadComponentInterface {

  /**
   * Constructs a new instance
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @param  string $target specifies the default target for all hyperlinks and forms in the page
   * @link   http://www.w3schools.com/tags/att_base_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_base_target.asp target attribute
   */
  public function __construct($href = null, $target = null) {
    parent::__construct("base");
    if ($href !== null) {
      $this->setHref($href);
    }
    if ($target !== null) {
      $this->setTarget($target);
    }
  }

  /**
   * Sets the href attribute (The URL of the link).
   *
   * @param  string $href an absolute URL that acts as the base URL
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_base_href.asp href attribute
   */
  public function setHref($href) {
    return $this->setAttr("href", $href);
  }

  /**
   * Sets the target attribute.
   *
   * **Notes:**
   *  
   * 1. The target attribute specifies the default target for all hyperlinks and forms in the page.
   * 2. This attribute can be overridden by using the target attribute for each hyperlink/form.
   *
   *
   * @param  string $target target attribute's value
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_base_target.asp target attribute
   */
  public function setTarget($target) {
    return $this->setAttr("target", $target);
  }

}
