<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Security;

use PHPUnit\Framework\TestCase;

/**
 * Implementation of PasswordTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PasswordTest extends TestCase {

  public function testPassword(): void {

    $password1 = Password::fromPassword('password');
    $hash1 = $password1->getHash();
    $password2 = Password::fromHash($hash1);

    $this->assertTrue($password1->verify('password'));
    $this->assertTrue($password2->verify('password'));
    $this->assertFalse($password1->verify('foo'));
    $this->assertFalse($password2->verify('password '));
    $this->assertFalse($password2->verify('Password'));
    $this->assertFalse($password1->verify($hash1));
  }

}
