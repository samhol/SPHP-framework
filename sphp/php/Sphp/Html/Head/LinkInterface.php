<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\NonVisualContent;
use Sphp\Stdlib\Datastructures\Arrayable;

/**
 * Defines an HTML &lt;link&gt; tag
 * 
 *  The &lt;link&gt; tag defines the relationship between a document and an
 *  external resource. The &lt;link&gt; tag is most used to link to style
 *  sheets.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface LinkInterface extends OverlappingHeadContent, NonVisualContent, Arrayable {

  /**
   * Returns the location of the linked document
   *
   * **Notes:**
   * 
   * 1. The href attribute specifies the location (URL) of the external resource 
   *    (most often a style sheet file).
   * 
   * @return string the location of the linked document
   * @link   http://www.w3schools.com/tags/att_link_href.asp href attribute
   */
  public function getHref(): string;

  /**
   * Returns the relationship between the current document and the linked one
   *
   * **Notes:** The rel attribute specifies the relationship
   *  between the current document and the linked document/resource.
   *
   * **Values:**
   *
   * * `alternate` Links to an alternate version of the document
   *   (i.e. print page, translated or mirror)
   * * `author` Links to the author of the document
   * * `help` Links to a help document
   * * `icon` Imports an icon to represent the document
   * * `license` Links to copyright information for the document
   * * `next` Indicates that the document is a part of a series,
   *   and that the next document in the series is the referenced document
   * * `prefetch` Specifies that the target resource should be cached
   * * `prev` Indicates that the document is a part of a series,
   *   and that the previous document in the series is the referenced document
   * * `search` Links to a search tool for the document
   * * `stylesheet` URL to a style sheet to import
   *
   * @return string the relationship between the current document and the linked one
   * @link   http://www.w3schools.com/tags/att_link_rel.asp rel attribute
   */
  public function getRel(): string;
}
