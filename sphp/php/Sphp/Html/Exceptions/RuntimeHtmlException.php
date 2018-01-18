<?php

/**
 * RuntimeHtmlException.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Exceptions;

use RuntimeException;


/**
 * Exception thrown if an error which can only be found on runtime occurs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class RuntimeHtmlException extends RuntimeException implements HtmlException {

}
