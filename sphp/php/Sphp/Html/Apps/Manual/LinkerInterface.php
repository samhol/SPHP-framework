<?php

/**
 * LinkerInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Navigation\HyperlinkInterface;

/**
 * Defines a Hyperlink object generator pointing to an existing site 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface LinkerInterface {

  /**
   * Returns the component as html-markup string
   *
   * @return string html-markup of the component
   */
  public function __toString();

  /**
   * Returns the url generator pointing to the API documentation
   *
   * @return UrlGeneratorInterface the url generator pointing to the API documentation
   */
  public function urls();

  /**
   * Returns the default target of the created hyperlink objects
   *
   * @return string|null the target attribute value of the created hyperlink objects
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function getDefaultTarget();

  /**
   * Returns a hyperlink object pointing to a linked page
   *
   * @param  string $url optional path from the root to the resource
   * @param  string $content optional content of the link
   * @param  string $title optional title of the link
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   * @return HyperlinkInterface hyperlink object pointing to an API page
   */
  public function hyperlink($url = null, $content = null, $title = null);
}
