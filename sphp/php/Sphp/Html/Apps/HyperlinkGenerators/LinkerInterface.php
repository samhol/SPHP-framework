<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use Sphp\Html\Navigation\Hyperlink;

/**
 * Defines a Hyperlink object generator pointing to an existing site 
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface LinkerInterface {

  /**
   * Returns the component as HTML-markup string
   *
   * @return string HTML-markup of the component
   */
  public function __toString(): string;

  /**
   * Sets the default attributes for generated hyperlink objects
   * 
   * @param array $attributes the default attributes
   * @return $this for a fluent interface
   */
  public function setDefaultHyperlinkAttributes(array $attributes);

  /**
   * Returns the default attributes for generated hyperlink objects
   * 
   * @return array the default attributes for generated hyperlink objects
   */
  public function getDefaultHyperlinkAttributes(): array;

  /**
   * Returns the URL generator pointing to the API documentation
   *
   * @return UrlGeneratorInterface the URL generator pointing to the API documentation
   */
  public function urls(): UrlGeneratorInterface;

  /**
   * Returns a hyperlink object pointing to a linked page
   *
   * @param  string $url optional path from the root to the resource
   * @param  string $content optional content of the link
   * @param  string $title optional title of the link
   * @link   http://www.w3schools.com/tags/att_global_title.asp title attribute
   * @return Hyperlink hyperlink object pointing to an API page
   */
  public function hyperlink(string $url = null, string $content = null, string $title = null): Hyperlink;
}
