<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Config\ErrorHandling;

use PHPUnit\Framework\TestCase;
use Sphp\Config\ErrorHandling\ExceptionLogger;
use Sphp\Config\Exception\ConfigurationException;

/**
 * Class ThrowableLoggerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ThrowableLoggerTest extends TestCase {

  /**
   * @var string 
   */
  protected $path;

  protected function setUp(): void {
    $this->path = sys_get_temp_dir() . '/test.log';
  }

  protected function tearDown(): void {
    if (file_exists($this->path)) {
      unlink($this->path);
    }
  }

  public function testConstructor(): void {
    $logger = new ExceptionLogger($this->path);
    $this->assertSame($this->path, $logger->getDestination());
    $this->expectException(ConfigurationException::class);
    new ExceptionLogger('1');
  }

  public function testOnException(): void {
    $logger = new ExceptionLogger($this->path);
    $this->assertSame($this->path, $logger->getDestination());
    $previous = new \InvalidArgumentException('previous');
    $exception = new \Exception('current', 1, $previous);
    $logger->onException($exception);
    $this->assertSame(\Sphp\Stdlib\Filesystem::toString($this->path), $logger->parseThrowable($exception));
  }

}
