<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Exceptions\SphpExceptionInterface;

/**
 * Defines basic features for all HTML structures
 *
 * **Links to HTML-resources:**
 * 
 * * <a href="http://www.w3.org/MarkUp/Guide/">W3C's Getting started with HTML</a>
 * * <a href="http://www.w3.org/TR/html4/">W3C's HTML 4.01 Specification</a>
 * * <a href="http://www.w3.org/TR/xhtml1/">W3C's XHTML 1.0 Specification</a>
 * * <a href="http://dev.w3.org/html5/spec/single-page.html">W3C's HTML 5 Specification</a>
 * * <a href="http://validator.w3.org/">W3C Markup Validation Service</a>
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface Content {

  /**
   * Returns the component as HTML markup string
   *
   * @return string HTML markup of the component
   * @throws SphpExceptionInterface if HTML parsing fails
   */
  public function getHtml(): string;

  /**
   * Returns the component as HTML markup string
   *
   * @return string HTML markup of the object
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __toString(): string;

  /**
   * Prints the component as HTML markup string
   *
   * @return $this for a fluent interface
   */
  public function printHtml();
}
