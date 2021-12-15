<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Config\ErrorHandling;

use PHPUnit\Framework\TestCase;
use Sphp\Config\ErrorHandling\ErrorManager;

/**
 * The ErrorManagerTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ErrorManagerTest extends TestCase {

  public function testUsage(): void {
    restore_error_handler();
    $base = \E_NOTICE;

    $level = \E_USER_ERROR;
    $original = error_reporting($base);
    $this->assertSame($base, error_reporting());
    $errManager = new ErrorManager();
    $this->assertSame($errManager, $errManager->start($level));
    $this->assertSame($level, error_reporting());

    error_reporting(E_USER_ERROR);
    $this->assertSame($errManager, $errManager->stop());
    $this->assertSame($base, error_reporting());
    error_reporting($original);
  }

  public function testTriggering(): void {
    $errManager = new ErrorManager();
    ///restore_error_handler();
    $level = \E_USER_ERROR;
    $this->assertSame($errManager, $errManager->start($level));
    $this->expectError();
    $this->expectErrorMessage('foo');
    \trigger_error('foo', \E_USER_ERROR);
    echo 'after';
  }

}
