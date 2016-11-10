<?php

/**
 * AjaxLoaderTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use Sphp\Core\Types\URL;
use Sphp\Html\Attributes\AttributeManager;

/**
 * Trait implements {@link AjaxLoaderInterface} functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-08-11
 * @link    http://api.jquery.com/load/ jQuery load()
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait AjaxLoaderTrait {

  /**
   * Returns the attribute manager attached to the component
   *
   * @return AttributeManager the attribute manager
   */
  abstract public function attrs();

  /**
   * Sets the Ajax attributes to the component
   * 
   * @param  string $op the type of the operation
   * @param  string|URL $url the URL to which the request is sent
   * @param  string|null $container an optional DOM ID of the used portion
   * @return self for PHP Method Chaining
   */
  private function setAjaxAttrs($op, $url) {
    if ($url instanceof URL) {
      $url = $url->getHtml();
    }
    $this
            ->setAttr("data-sphp-ajax-op", $op)
            ->setAttr("data-sphp-ajax-url", $url);
    return $this;
  }

  /**
   * Loads the data from the server using jQuery's Ajax capabilities and
   * prepends the returned HTML into the object.
   *
   * @param  string|URL $url the URL to which the request is sent
   * @return self for PHP Method Chaining
   */
  public function ajaxPrepend($url) {
    return $this->setAjaxAttrs("prepend", $url);
  }

  /**
   * Loads the data from the server using jQuery's Ajax capabilities and
   * appends the returned HTML into the object.
   *
   * @param  string|URL $url the URL to which the request is sent
   * @return self for PHP Method Chaining
   */
  public function ajaxAppend($url) {
    return $this->setAjaxAttrs("append", $url);
  }

}
