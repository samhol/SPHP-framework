<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Scripts;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Scripts\InlineScript;

class InlineScriptTest extends TestCase {

  public function contructorParameters(): array {
    $data = [];
    $data[] = ['var foo = 1;'];
    $data[] = [''];
    $data[] = [' '];
    $data[] = [null];
    return $data;
  }

  /**
   * @dataProvider contructorParameters
   * 
   * @param string $code
   */
  public function testConstructor(string $code = null): void {
    $script = new InlineScript($code);
    $this->assertSame($code, $script->getContent());
    $this->assertSame("<script>$code</script>", $script->getHtml());
  }

  public function testGetHash(): void {
    $code1 = new InlineScript('var foo = 1;');
    $code2 = new InlineScript('var foo = 1;');
    $this->assertNotSame($code1->getHash(), $code2->getHash());
  }

  public function testScriptSettingAndOutput(): void {
    $code = new InlineScript('var foo = 1;');
    $this->assertSame('var foo = 1;', $code->getContent());
    $this->assertSame($code->contentToString(), $code->getContent());
    $code->setContent('var bar = 2');
    $this->assertSame('var bar = 2', $code->getContent());
    $this->assertSame($code->contentToString(), $code->getContent());
    $code->setContent(null);
    $this->assertSame(null, $code->getContent());
    $this->assertSame($code->contentToString(), (string) $code->getContent());
  }

}
