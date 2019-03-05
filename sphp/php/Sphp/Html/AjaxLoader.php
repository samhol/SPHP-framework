<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

/**
 * Defines the functionality of an Ajax content loader component
 * 
 * Supported ways of remote content fetching 
 * 
 * 1. Loading entire content of the remote document
 * 2. Loading Page Fragments: a portion of the remote document defined by an 
 *    unique DOM ID. This element, along with its contents, is inserted into 
 *    this component with an ID of result, and the rest of the retrieved 
 *    document is discarded.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://api.jquery.com/load/ jQuery load()
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface AjaxLoader {

  /**
   * Prepends the remote content into the component using jQuery Ajax
   * 
   * **Important note:** 
   * This method overrides all previous AJAX calls.
   *
   * @param  string $url the URL to which the request is sent
   * @return $this for a fluent interface
   */
  public function ajaxPrepend(string $url);

  /**
   * Appends the remote content into the component using jQuery Ajax
   * 
   * **Important note:** 
   * This method overrides all previous calls of ajax loader methods.
   *
   * @param  string $url the URL to which the request is sent
   * @return $this for a fluent interface
   */
  public function ajaxAppend(string $url);
}
