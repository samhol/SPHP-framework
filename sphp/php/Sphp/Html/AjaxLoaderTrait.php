<?php

/**
 * AjaxLoaderTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Trait implements {@link AjaxLoaderInterface} functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://api.jquery.com/load/ jQuery load()
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait AjaxLoaderTrait {

  /**
   * Returns the attribute manager attached to the component
   *
   * @return HtmlAttributeManager the attribute manager
   */
  abstract public function attrs(): HtmlAttributeManager;

  /**
   * Loads the data from the server using jQuery's Ajax capabilities and
   * prepends the returned HTML into the object.
   *
   * @param  string $url the URL to which the request is sent
   * @return $this for a fluent interface
   */
  public function ajaxPrepend(string $url) {
    $this->attrs()
            ->set('data-sphp-ajax-prepend', $url);
    return $this;
  }

  /**
   * Loads the data from the server using jQuery's Ajax capabilities and
   * appends the returned HTML into the object.
   *
   * @param  string $url the URL to which the request is sent
   * @return $this for a fluent interface
   */
  public function ajaxAppend(string $url) {
    $this->attrs()
            ->set('data-sphp-ajax-append', $url);
    return $this;
  }

}

