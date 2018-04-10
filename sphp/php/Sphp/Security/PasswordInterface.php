<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Security;

/**
 * Defines a verifiable password
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface PasswordInterface {

  /**
   * Returns the hashed password string
   * 
   * @return string the hashed password string
   */
  public function getHash(): string;

  /**
   * Verifies that a plain password matches the instance
   * 
   * @param  string|Password $password the crypted password to check against
   * @return boolean true if the password hash pair matches and false otherwise
   */
  public function verify($password): bool;
}
