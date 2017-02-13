<?php

/**
 * Div.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

/**
 * Implements an HTML &lt;div&gt; tag
 *
 * This component defines a division or a section in an HTML document. 
 * It is used to group block-elements to format them with CSS to layout a web page.
 * 
 * By default, browsers always place a line break before and after the &lt;div&gt; element.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-03-06
 * @link    http://www.w3schools.com/tags/tag_div.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Div extends ContainerTag implements AjaxLoaderInterface {

  use AjaxLoaderTrait;

  /**
   * Constructs a new instance
   *
   * @param mixed $content optional content of the component
   */
  public function __construct($content = null) {
    parent::__construct('div', $content);
  }

  public function __invoke($content = null) {
    $this->replaceContent($content);
    return $this;
  }

}
