<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Trait implements  ajax loader functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://api.jquery.com/load/ jQuery load()
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 * @link AjaxLoader
 */
trait AjaxLoaderTrait {

  /**
   * Returns the attribute manager attached to the component
   *
   * @return HtmlAttributeManager the attribute manager
   */
  abstract public function attributes(): HtmlAttributeManager;

  /**
   * Loads the data from the server using jQuery's Ajax capabilities and
   * prepends the returned HTML into the object.
   *
   * @param  string $url the URL to which the request is sent
   * @return $this for a fluent interface
   */
  public function ajaxPrepend(string $url) {
    $this->attributes()
            ->setAttribute('data-sphp-ajax-prepend', $url);
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
    $this->attributes()
            ->setAttribute('data-sphp-ajax-append', $url);
    return $this;
  }

}
