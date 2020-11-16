<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Body;
use Sphp\Html\Scripts\ScriptsContainer;
use Sphp\Html\Div;
use Sphp\Html\Scripts\InlineScript;

/**
 * Description of BodyTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BodyTest extends TestCase {

  public function validBodyContent(): array {
    $data = [];
    $data[] = [''];
    $data[] = ['foo'];
    return $data;
  }

  /**
   * @dataProvider validBodyContent
   * @param mixed $content
   */
  public function testConstructor($content) {
    $body = new Body($content);
    $this->assertSame('', (string) $body->scripts());
    $this->assertSame("<body>" . $content . $body->scripts() . "</body>", (string) $body);
    $code = new InlineScript('foo=0;');

    $body->scripts()->insert($code);
    $this->assertSame((string) $code, (string) $body->scripts());
    $this->assertSame("<body>" . $content . $body->scripts() . "</body>", (string) $body);
  }

  public function testScripts() {
    $body = new Body();
    $scripts = new ScriptsContainer();
    $scripts->insertExternal('/foo.js');
    $this->assertSame($scripts, $body->scripts($scripts));
    $this->assertSame("<body>" . $body->scripts() . "</body>", (string) $body);
  }

  public function testClose() {
    $body = new Body();
    $content = new Div('foos');
    $body->offsetSet(0, $content);
    $body->scripts()->insertExternal('/foo.js');
    $this->assertSame($body->scripts() . "</body>", (string) $body->close());
  }

  public function testClone() {
    $body = new Body();
    $content = new Div();
    $body->offsetSet(0, $content);
    $cloned = clone $body;
    $this->assertNotSame($body->offsetGet(0), $cloned->offsetGet(0));
    $this->assertNotSame($body->scripts(), $cloned->scripts());
    $this->assertNotSame($body, $cloned);
    $this->assertSame((string) $body, (string) $cloned);
  }

  public function testTraversing(): void {
    $body = new Body();
    $content = new Div();
    $body->offsetSet(0, $content);
    foreach ($body as $id => $item) {
      $this->assertSame($content, $item);
    }
  }

}
