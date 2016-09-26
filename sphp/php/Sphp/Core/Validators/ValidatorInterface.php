<?php

/**
 * ValidatorInterface.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Core\Validators;

use Sphp\Core\Gettext\MessageList;

/**
 * The base interface for all validatorrs
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-16
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ValidatorInterface {

  /**
   * Does the validation
   *
   * @param  mixed $data the data to validate
   * @return self for PHP Method Chaining
   */
  public function validate($data);

  /**
   * Checks if validation was succesfull or not
   *
   * @return boolean true if validation was succesfull, false if not
   */
  public function isValid();

  /**
   * Returns error messages as a {@link MessageList} object
   *
   * @return MessageList error messages
   */
  public function getErrors();
}
