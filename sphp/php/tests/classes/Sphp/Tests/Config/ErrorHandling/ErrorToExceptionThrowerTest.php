<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Config\ErrorHandling;

use PHPUnit\Framework\TestCase;
use Sphp\Config\ErrorHandling\ErrorToExceptionThrower;
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
   * 
   * @param  string $exceptionType
   * @param  int $errorLevel
   * @param  string $errorMessage
   * @return void
   */
  public function testThrowing(string $exceptionType, int $errorLevel, string $errorMessage): void {
    $thrower = new ErrorToExceptionThrower($exceptionType);
    $this->assertSame($exceptionType, $thrower->getExceptionType());
    $thrower->start();
    error_reporting($errorLevel);
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

  public function nonMatchingErrorData(): array {
    $data = [];
    $data[] = [\E_USER_WARNING, \E_USER_NOTICE, 'E_USER_NOTICE'];
    $data[] = [\E_USER_ERROR | \E_STRICT, \E_USER_DEPRECATED, 'E_USER_DEPRECATED'];
    return $data;
  }

  /**
   * @dataProvider nonMatchingErrorData
   * 
   * @param  int $listened
   * @param  int $triggered
   * @param  string $message
   * @return void
   */
  public function testNoErrorReporting(int $listened, int $triggered, string $message): void {
    $thrower = new ErrorToExceptionThrower(\Exception::class);
    $thrower->start($listened);
    $this->assertSame(\Exception::class, $thrower->getExceptionType());
    $f = function(int $errno, string $errstr, string $errfile, int $errline) use($triggered, $message): void {
      $this->assertSame($triggered, $errno);
      $this->assertSame(__FILE__, $errfile);
      $this->assertSame($message, $errstr);
    };
    set_error_handler($f, \E_ALL);
    trigger_error($message, $triggered);
    restore_error_handler();
  }

}
