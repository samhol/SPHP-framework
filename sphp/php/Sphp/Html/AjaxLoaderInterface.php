<?php

/**
 * AjaxLoaderInterface.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Stdlib\URL;

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
 * @since   2015-08-11
 * @link    http://api.jquery.com/load/ jQuery load()
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface AjaxLoaderInterface {

  /**
   * Prepends the remote content into the component using jQuery Ajax
   * 
   * **Important note:** 
   * This method overrides all previous calls of {@link AjaxLoaderInterface} methods.
   *
   * @param  string|URL $url the URL to which the request is sent
   * @return self for a fluent interface
   */
  public function ajaxPrepend($url);

  /**
   * Appends the remote content into the component using jQuery Ajax
   * 
   * **Important note:** 
   * This method overrides all previous calls of {@link AjaxLoaderInterface} methods.
   *
   * @param  string|URL $url the URL to which the request is sent
   * @return self for a fluent interface
   */
  public function ajaxAppend($url);
}
