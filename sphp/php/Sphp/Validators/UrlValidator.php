<?php

/**
 * UrlValidator.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use Sphp\Stdlib\URL;

/**
 * Validates an url string or an instance of {@link URL} class.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class UrlValidator extends AbstractValidator {

  public function isValid($url) {
    if (!($url instanceof URL)) {
      $url = new URL($url);
    }
    if (!$url->exists()) {
      $this->addErrorMessage("Please insert a valid working url");
    }
  }

}
