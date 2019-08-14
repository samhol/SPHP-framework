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
 * Implementation of CRSFTokenTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class CRSFTokenTest extends TestCase {

  /**
   * @runInSeparateProcess
   */
  public function testConstructor(): void {
    $_POST = [];
    $_GET = [];
    $tokenBuilder = new CRSFToken();

    $this->assertTrue(session_status() === PHP_SESSION_ACTIVE);
    $postToken = $tokenBuilder->generateToken('foo');
    $getToken = $tokenBuilder->generateToken('bar');
    $_POST['foo'] = $postToken;
    $_GET['bar'] = $getToken;
    $this->assertSame($tokenBuilder->generateToken('foo'), $postToken);
    var_dump(filter_input(INPUT_POST, 'foo', FILTER_SANITIZE_STRING));
    $this->assertTrue($tokenBuilder->verifyPostToken('foo'));
    $this->assertFalse($tokenBuilder->verifyPostToken('bar'));
  }

}
