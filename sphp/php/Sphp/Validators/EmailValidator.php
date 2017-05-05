<?php

/**
 * EmailValidator.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Validators;

/**
 * Validates a value as an email address
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-08-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class EmailValidator extends AbstractValidator {

  public function __construct() {
    parent::__construct();
    $this->createMessageTemplate(static::INVALID, 'Please insert a correct email address');
  }

  /**
   * {@inheritdoc}
   */
  public function isValid($value) {
    $this->setValue($value);
    if (!filter_var($value, FILTER_VALIDATE_EMAIL)) {
      $this->error(static::INVALID);
      return false;
    }
    return true;
  }

}
