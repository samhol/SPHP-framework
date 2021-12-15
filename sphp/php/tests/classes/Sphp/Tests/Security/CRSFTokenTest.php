<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Security;

use Sphp\Security\CRSFToken;
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
    $data = [];
    $tokenBuilder = new CRSFToken();

    $this->assertSame(CRSFToken::instance(), CRSFToken::instance());

    $this->assertTrue(session_status() === PHP_SESSION_ACTIVE);
    $postToken = $tokenBuilder->generateToken('foo');
    $getToken = $tokenBuilder->generateToken('bar');
    $data['foo'] = $postToken;
    $data['bar'] = $getToken;
    $this->assertSame($tokenBuilder->generateToken('foo'), $postToken);
    $this->assertTrue($tokenBuilder->verifyToken('foo', $data));
    $this->assertTrue($tokenBuilder->verifyToken('bar', $data));
    $this->assertFalse($tokenBuilder->verifyToken('baz', $data));
    $this->assertSame($tokenBuilder, $tokenBuilder->unsetToken('bar', $data));
    $this->assertFalse($tokenBuilder->verifyToken('bar', $data));
  }

}
