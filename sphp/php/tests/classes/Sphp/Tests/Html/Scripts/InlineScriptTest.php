<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Scripts;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Scripts\InlineScript;

class InlineScriptTest extends TestCase {

  public function contructorParameters(): iterable {
    yield ['var foo = 1;'];
    yield [''];
    yield [' '];
    yield [null];
  }

  /**
   * @dataProvider contructorParameters
   * 
   * @param  string|null $code
   * @return void
   */
  public function testConstructor(?string $code): void {
    $script = new InlineScript($code);
    $this->assertSame((string) $code, $script->contentToString());
    $this->assertSame("<script>$code</script>", $script->getHtml());
  }

  public function testGetUniqueHash(): void {
    $code1 = new InlineScript('var foo = 1;');
    $code2 = new InlineScript('var foo = 1;');
    $this->assertNotSame($code1->getHash(), $code2->getHash());
  }

  public function testScriptAddingAndOutput(): void {
    $code = new InlineScript('var foo = 1;');
    $hash = $code->getHash();
    $this->assertSame('var foo = 1;', $code->contentToString());
    $code->appendJavaScript('var bar = 2');
    $this->assertSame('var foo = 1;var bar = 2', $code->contentToString());
    $this->assertSame($hash, $code->getHash());
  }

}
