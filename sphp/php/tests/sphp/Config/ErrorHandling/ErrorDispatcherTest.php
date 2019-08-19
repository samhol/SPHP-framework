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
use Sphp\Exceptions\SphpException;

/**
 * Description of ErrorDispatcherTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ErrorDispatcherTest extends TestCase implements ErrorListener {

  /**
   * @return ErrorListener
   */
  public function mockExceptionListener(): ExceptionListener {
    $mock = $this->getMockBuilder(ExceptionListener::class)
            ->setMethods(['onException'])
            ->getMock();
    $mock->expects($this->any())
            ->method('onException')
            ->withConsecutive([
                $this->isInstanceOf(\Exception::class)
    ]);
    return $mock;
  }

  /**
   * @return ErrorListener
   */
  public function mockErrorListener(int $errno): ErrorListener {
    $mock = $this->getMockBuilder(ErrorListener::class)
            ->setMethods(['onError'])
            ->getMock();
    $mock->expects($this->any())
            ->method('onError')
            ->withConsecutive([
                $this->equalTo($errno),
                $this->equalTo('UserError'),
                $this->equalTo(__FILE__)
    ]);
    return $mock;
  }

  public function testConstructor(): void {

    $errorCallable = function(int $errno, string $errstr, string $errfile, int $errline) {
      $this->assertSame($errfile, __FILE__);
    };

    $exceptionCallable = function(\Throwable $t) {
      $this->assertInstanceOf(\Sphp\Exceptions\SphpException::class, $t);
    };
    $errDispatcher = new ErrorDispatcher();
    $errDispatcher->addExceptionListener($exceptionCallable, 2);
    $errDispatcher->addExceptionListener($this->mockExceptionListener(), 2);
    $errDispatcher->addErrorListener(\E_USER_ERROR, $this->mockErrorListener(\E_USER_ERROR), 10);
    $errDispatcher->addErrorListener(\E_USER_ERROR, $errorCallable, 10);
    $errDispatcher->startErrorHandling();
    $errDispatcher->startErrorHandling();
    $errDispatcher->startExceptionHandling();
    $errDispatcher->startExceptionHandling();
    trigger_error('UserError', \E_USER_ERROR);
    try {
      throw new SphpException('foo');
    } catch (SphpException $ex) {
      $errDispatcher->triggerException($ex);
    }
    $errDispatcher->stopErrorHandling();
    trigger_error('UserError', \E_USER_ERROR);
  }

  public function testInsertInvalidErrorListener(): void {
    $errDispatcher = new ErrorDispatcher();
    $this->expectException(\Sphp\Exceptions\InvalidArgumentException::class);
    $errDispatcher->addErrorListener(\E_ALL, 'foo');
  }

  public function testInsertInvalidExceptionListener(): void {
    $errDispatcher = new ErrorDispatcher();
    $this->expectException(\Sphp\Exceptions\InvalidArgumentException::class);
    $errDispatcher->addExceptionListener('foo');
  }

  public function onError(int $errno, string $errstr, string $errfile, int $errline): void {
    
  }

}
