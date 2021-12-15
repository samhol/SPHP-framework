<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Html\AbstractContent;
use Sphp\Html\Exceptions\HtmlException;

class AbstractContentTest extends TestCase {

  public function createObject($value = null): AbstractContent {
    $mock = $this->getMockForAbstractClass(AbstractContent::class);
    $mock->value = $value;
    $mock->method('getHtml')->willReturnCallback(
            function() use ($mock) {
      return (string) $mock->value;
    }
    );
    return $mock;
  }

  public function testPrintHtml(): void {
    $mock = $this->createObject('value');
    $this->expectOutputString('value');
    $mock->printHtml();
  }

  public function testException() {
    $exception = new HtmlException;
    $mock = $this->getMockForAbstractClass(AbstractContent::class);
    $mock->expects($this->any())
            ->method('getHtml')
            ->willThrowException($exception);

    $this->expectOutputString("$exception");
    $mock->printHtml();
  }

}
