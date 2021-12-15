<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Scripts;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Scripts\Console;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * The ConsoleTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ConsoleTest extends TestCase {

  /**
   * @return Console
   */
  public function testEmptyConsole(): Console {
    $console = new Console();
    $this->assertSame('', (string) $console);
    $this->assertNull($console->generateScript(true));
    $this->assertNull($console->generateScript(false));
    $this->assertNull($console->createScriptTag());
    $this->assertTrue($console->isEmpty());
    return $console;
  }

  public function loggingDataProvider(): iterable {
    yield ['', "''"];
    yield [null, ''];
    yield [true, 'true'];
    yield [false, 'false'];
    yield [1, '1'];
    yield [1.1, '1.1'];
    yield [[], '[]'];
    yield [new \stdClass(), '{}'];
  }

  /**
   * @dataProvider loggingDataProvider
   * 
   * @param  Console $console
   * @return Console
   */
  public function testLoggingWithDifferentDatatypes($message, $param): Console {
    $console = new Console();
    foreach (['log', 'warn', 'error', 'info'] as $function) {
      $console->$function($message);
      $this->assertStringEndsWith("console.$function($param);", $console->generateScript());
    }
    $this->assertFalse($console->isEmpty());
    return $console;
  }

  public function testLoggingWithResource(): void {
    $console = new Console();
    $this->expectException(InvalidArgumentException::class);
    $console->log(fopen(__FILE__, "r"));
  }

  /**
   * @depends testEmptyConsole
   * 
   * @param  Console $console
   * @return Console
   */
  public function testLog(Console $console): Console {
    $this->assertSame($console, $console->log('log message'));
    $this->assertSame((string) $console, (string) $console->createScriptTag());
    $this->assertNotNull($console->createScriptTag());
    $this->assertSame("console.log('log message');", $console->createScriptTag()->contentToString());
    $this->assertFalse($console->isEmpty());
    return $console;
  }

  /**
   * @depends testLog
   * 
   * @param  Console $console
   * @return Console
   */
  public function testInfo(Console $console): Console {
    $this->assertSame($console, $console->info('info message'));
    $this->assertStringEndsWith("console.info('info message');", $console->createScriptTag()->contentToString());
    return $console;
  }

  /**
   * @depends testInfo
   * 
   * @param  Console $console
   * @return Console
   */
  public function testWarn(Console $console): Console {
    $this->assertSame($console, $console->warn('warn message'));
    $this->assertStringEndsWith("console.warn('warn message');", $console->createScriptTag()->contentToString());
    return $console;
  }

  /**
   * @depends testWarn
   * 
   * @param  Console $console
   * @return Console
   */
  public function testError(Console $console): Console {
    $this->assertSame($console, $console->error('error message'));
    $this->assertStringEndsWith("console.error('error message');", $console->createScriptTag()->contentToString());
    return $console;
  }

  /**
   * @depends testError
   * 
   * @param  Console $console
   * @return Console
   */
  public function testTime(Console $console): Console {
    $this->assertSame($console, $console->time('label'));
    $this->assertStringEndsWith("console.time('label');", $console->createScriptTag()->contentToString());
    return $console;
  }

  /**
   * @depends testTime
   * 
   * @param  Console $console
   * @return Console
   */
  public function testTimeLog(Console $console): Console {
    $this->assertSame($console, $console->timeLog('label'));
    $this->assertStringEndsWith("console.timeLog('label');", $console->createScriptTag()->contentToString());
    return $console;
  }

  /**
   * @depends testTimeLog
   * 
   * @param  Console $console
   * @return Console
   */
  public function testTimeEnd(Console $console): Console {
    $this->assertSame($console, $console->timeEnd('label'));
    $this->assertStringEndsWith("console.timeEnd('label');", $console->createScriptTag()->contentToString());
    return $console;
  }

  public function tableDataProvider(): iterable {
   
    $personArr['fname'] = "John";
    $personArr['lname '] = "Smith";
    $personObj = (object)$personArr;
    yield [$personArr, '["fname"]'];
    yield [$personObj];
  }

  /**
   * @dataProvider tableDataProvider
   * 
   * @param  iterable|object $content
   * @return void
   */
  public function testTable($content): void {
    
    $console = new Console();
    $console->table($content);
    $parsedData = json_encode($content);
    $this->assertSame("console.table($parsedData);", $console->generateScript());
  }

  /**
   * @depends testEmptyConsole
   * 
   * @param  Console $console
   * @return Console
   */
  public function testGroups(Console $console): Console {
    $this->assertSame($console, $console->endGroup());
    $this->assertStringEndsNotWith('console.groupEnd();', $console->generateScript());
    $this->assertStringEndsNotWith('console.groupEnd();', $console->generateScript(true));
    $this->assertSame($console, $console->startGroup());
    $this->assertStringEndsWith('console.group();', $console->generateScript(false));
    $this->assertStringEndsWith('console.group();console.groupEnd();', $console->generateScript(true));
    return $console;
  }

  /**
   * @depends testEmptyConsole
   *  
   * @return Console
   */
  public function testClear(): void {
    $console = new Console();
    $console->log('foo');
    $this->assertSame("console.log('foo');", $console->generateScript());
    $this->assertSame($console, $console->clear());
    $this->assertSame("console.log('foo');console.clear();", $console->generateScript(true));
    $this->assertSame("console.log('foo');console.clear();", $console->generateScript(false));
  }

  /**
   * @depends testEmptyConsole
   *  
   * @return Console
   */
  public function testGroupCollapsed(): Console {
    $console = new Console();
    $this->assertSame($console, $console->groupCollapsed());
    $this->assertStringEndsWith('console.groupCollapsed();console.groupEnd();', $console->createScriptTag()->contentToString());

    $this->assertSame($console, $console->groupCollapsed('label'));
    $this->assertStringEndsWith(
            "console.groupCollapsed();console.groupCollapsed('label');console.groupEnd();console.groupEnd();",
            $console->generateScript(true));

    $this->assertSame($console, $console->endGroup());
    $this->assertStringEndsWith("console.groupCollapsed('label');console.groupEnd();", $console->generateScript(false));
    return $console;
  }

  /**
   * @depends testEmptyConsole
   * 
   * @param  Console $console
   * @return Console
   */
  public function testInvalidType(Console $console): Console {
    $this->expectException(\Sphp\Exceptions\BadMethodCallException::class);
    $console->foo('foo');
    return $console;
  }

  /**
   * @depends testLog
   * 
   * @param  Console $console
   * @return void
   */
  public function testRun(Console $console): void {
    $this->expectOutputString($console->getHtml());
    $console->run();
  }

  /**
   * @depends testLog
   * 
   * @param  Console $console
   * @return void
   */
  public function testEmptyMedhods(Console $console): void {
    $this->assertFalse($console->isEmpty());
    $this->assertSame($console, $console->emptyMedhods());
    $this->assertNull($console->createScriptTag());
    $this->assertTrue($console->isEmpty());
    $this->assertSame((string) $console, (string) $console->createScriptTag());
  }

}
