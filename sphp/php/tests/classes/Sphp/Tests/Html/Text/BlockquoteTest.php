<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Text;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Text\Blockquote;
use Sphp\DateTime\DateTime;
use DateTimeInterface;
use Sphp\DateTime\ImmutableDateTime;
use DateInterval;
use Sphp\DateTime\Interval;

/**
 * The ConsoleTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BlockquoteTest extends TestCase {

  /**
   * @return void
   */
  public function testEmptyConstructor(): void {
    $blockquote = new Blockquote();
    $this->assertSame('<blockquote></blockquote>', (string) $blockquote);
    $this->assertFalse($blockquote->attributeExists('cite'));
  }

  public function constructorDataProvider(): iterable {
    yield ['foo', 'bar'];
  }

  /**
   * @dataProvider constructorDataProvider
   * 
   * @param  mixed $content
   * @param  string|null $cite
   * @return void
   */
  public function testConstructorWithParams(mixed $content, ?string $cite): void {
    $blockquote = new Blockquote($content, $cite);
    $this->assertSame((string) $content, $blockquote->contentToString());
    $this->assertSame($cite !== null, $blockquote->attributeExists('cite'));
  }

}
