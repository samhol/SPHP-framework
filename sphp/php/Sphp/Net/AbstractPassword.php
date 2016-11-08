<?php

/**
 * AbstractPassword.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Net;

/**
 * Partial implementation of a password
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-10-23
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractPassword implements PasswordInterface {

  public function verify($password) {
    return password_verify((string) $password, $this->getHash());
  }

}
