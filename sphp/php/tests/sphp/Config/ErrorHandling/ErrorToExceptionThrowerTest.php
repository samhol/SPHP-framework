<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Config\ErrorHandling;

use PHPUnit\Framework\TestCase;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Description of ErrorToExceptionThrowerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ErrorToExceptionThrowerTest extends TestCase {

  public function errorData(): array {
    $data = [];
    $data[] = [\ErrorException::class, \E_USER_NOTICE, 'foo'];
    return $data;
  }

  /**
   * @dataProvider errorData
   * @param string $exceptionType
   * @param int $errorLevel
   * @param string $errorMessage
   * @return void
   */
  public function testThrowing(string $exceptionType, int $errorLevel, string $errorMessage): void {
    $thrower = new ErrorToExceptionThrower($exceptionType);
    $this->assertSame($exceptionType, $thrower->getExceptionType());
    $thrower->start();
    $this->expectException($exceptionType);
    $this->expectExceptionMessage($errorMessage);
    if ($exceptionType !== \ErrorException::class) {
      $this->expectExceptionCode($errorLevel);
    }
    trigger_error($errorMessage, $errorLevel);
  }

  public function testSettingInvalidExceptionType(): void {
    $this->expectException(InvalidArgumentException::class);
    new ErrorToExceptionThrower('foo');
  }

  public function testNoErrorReporting(): void {
    $thrower = new ErrorToExceptionThrower();
    $thrower->start(\E_ERROR);
    $this->assertSame(\ErrorException::class, $thrower->getExceptionType());
    error_reporting(\E_USER_ERROR);
    trigger_error('foo', E_USER_NOTICE);
  }

}
