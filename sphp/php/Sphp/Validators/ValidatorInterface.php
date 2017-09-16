<?php

/**
 * ValidatorInterface.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

use Sphp\I18n\Collections\TranslatableCollection;

/**
 * The base interface for all validators
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-10-16
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ValidatorInterface {

  /**
   * Validates given value
   *
   * @param  mixed $value the value to validate
   * @return boolean true if validation was successful, false if not
   */
  public function isValid($value): bool;

  /**
   * Returns error messages
   *
   * @return TranslatableCollection error messages
   */
  public function getErrors(): TranslatableCollection;
}
