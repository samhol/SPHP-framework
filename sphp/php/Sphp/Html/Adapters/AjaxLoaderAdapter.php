<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Adapters;

use Sphp\Html\AjaxLoader;
use Sphp\Network\URL;
use Sphp\Html\Component;

/**
 * Executes Ajax functionality on the adaptee
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://api.jquery.com/load/ jQuery load()
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AjaxLoaderAdapter extends AbstractComponentAdapter implements AjaxLoader {

  /**
   * Constructor
   * 
   * @param Component $component
   */
  public function __construct(Component $component) {
    parent::__construct($component);
  }

  /**
   * Sets the Ajax attributes to the component
   * 
   * @param  string $op the type of the operation
   * @param  string|URL $url the URL to which the request is sent
   * @param  string|null $container an optional DOM ID of the used portion
   * @return $this for a fluent interface
   */
  private function setAjaxAttrs($op, $url) {
    if ($url instanceof URL) {
      $url = $url->getHtml();
    }
    $this->getComponent()
            ->setAttribute("data-sphp-ajax-op", $op)
            ->setAttribute("data-sphp-ajax-url", $url);
    return $this;
  }

  /**
   * Loads the data from the server using jQuery's Ajax capabilities and
   * prepends the returned HTML into the object.
   *
   * @param  string $url the URL to which the request is sent
   * @return $this for a fluent interface
   */
  public function ajaxPrepend(string $url) {
    return $this->setAjaxAttrs("prepend", $url);
  }

  /**
   * Loads the data from the server using jQuery's Ajax capabilities and
   * appends the returned HTML into the object.
   *
   * @param  string $url the URL to which the request is sent
   * @return $this for a fluent interface
   */
  public function ajaxAppend(string $url) {
    return $this->setAjaxAttrs("append", $url);
  }

}
