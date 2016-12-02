<?php

/**
 * HyperlinkInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Navigation;

/**
 * Interface specifies the basic functionality of any HTML hyperlink
 *
 * If a {@link HyperlinkInterface} component has an href attribute, then it
 * represents a hyperlink (a hypertext anchor). If the component has no href
 * attribute, then the component represents a placeholder for where a link might
 * otherwise have been placed, if it had been relevant.
 *
 * The `target`, `rel`, `media`, `hreflang`, and `type` attributes must be omitted if
 * the `href` attribute is not present.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-24
 * @link    http://www.w3schools.com/tags/tag_a.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface HyperlinkInterface {

  /**
   * Sets the value of the href attribute (The URL of the link)
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the {@link self} is not a hyperlink.
   *
   * @param  string $href the URL of the link
   * @param  boolean $encode converts all applicable characters of the $url to HTML entities
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   */
  public function setHref($href, $encode = true);

  /**
   * Returns the value of the href attribute
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the {@link self} is not a hyperlink.
   *
   * @return string the value of the href attribute
   * @link http://www.w3schools.com/tags/att_a_href.asp href attribute
   */
  public function getHref();

  /**
   * Sets the value of the target attribute
   *
   * **Notes:**
   *
   * * The target attribute specifies where to open the linked document.
   * * Only used if the href attribute is present.
   *
   * @param  string $target the value of the target attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function setTarget($target);

  /**
   * Returns the value of the target attribute
   *
   * **Notes:**
   *
   * * The target attribute specifies where to open the linked document.
   * * Only used if the href attribute is present.
   *
   * @return string the value of the target attribute
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function getTarget();

  /**
   * Checks if the URL in the href atrribute matches with the given ÚRL
   *
   * @param  URL|string $url the url to check against
   * @return boolean true if the href arrtibute points to the current page
   */
  public function urlEquals($url);

  /**
   * Checks if the ÚRL in the href atrribute matches with the current page ÚRL
   *
   * @return boolean true if the href arrtibute points to the current page
   */
  public function isCurrentUrl();
}
