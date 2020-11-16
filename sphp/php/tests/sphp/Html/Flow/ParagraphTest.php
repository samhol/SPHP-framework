<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Flow;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Flow\Paragraph;
use Sphp\Html\Navigation\A;

/**
 * Class ParagraphTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ParagraphTest extends TestCase {

  public function hyperlinkData(): array {
    $data = [];
    $data[] = ['/', 'foo', '_self'];
    $data[] = ['/', 'foo', null];
    $data[] = ['/', null, null];
    $data[] = [null, null, null];
    return $data;
  }

  /**
   * @dataProvider hyperlinkData
   * 
   * @param  string $href
   * @param  mixed $content
   * @param  string $target
   * @return void
   */
  public function testAppendHyperlink(string $href = null, $content = null, string $target = null): void {
    $p = new Paragraph();
    $a = new A($href, $content, $target);
    $this->assertEquals($a, $p->appendHyperlink($href, $content, $target));
    $this->assertSame("<p>" . $a . "</p>", (string) $p);
  }

}
