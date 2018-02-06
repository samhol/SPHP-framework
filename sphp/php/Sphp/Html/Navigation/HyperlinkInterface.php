<?php

/**
 * HyperlinkInterface.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Navigation;

/**
 * Defines the basic functionality of any HTML hyperlink
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
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   */
  public function setHref(string $href);

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
   * @param  string|null $target optional target frame of the hyperlink
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function setTarget(string $target = null);

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
   * Sets the relationship between the current document and the linked document
   *
   * **Notes:**
   *
   * * Only used if the href attribute is present.
   *
   * @param  string|null $rel optional relationship between the current document and the linked document
   * @return $this for a fluent interface
   * @link  http://www.w3schools.com/tags/att_a_rel.asp rel attribute
   */
  public function setRel(string $rel = null);

  /**
   * Returns the relationship between the current document and the linked document
   *
   * **Notes:**
   *
   * * Only used if the `href` attribute is present.
   *
   * @return string the relationship between the current document and the linked document
   * @link  http://www.w3schools.com/tags/att_a_rel.asp rel attribute
   */
  public function getRel();
  
}
