<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Scripts\ScriptsContainer;

/**
 * Description of BodyTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BodyTest extends TestCase {

  /**
   * @var Body 
   */
  private $body;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->body = new Body();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->body);
  }

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
    $code = new Scripts\ScriptCode('foo=0;');

    $body->scripts()->append($code);
    $this->assertSame((string) $code, (string) $body->scripts());
    $this->assertSame("<body>" . $content . $body->scripts() . "</body>", (string) $body);
  }

  public function testScripts() {
    $scripts = new ScriptsContainer();
    $scripts->appendSrc('/foo.js');
    $this->assertSame($scripts, $this->body->scripts($scripts));
    $this->assertSame("<body>" . $this->body->scripts() . "</body>", (string) $this->body);
  }

  public function testClose() {
    $content = new Div('foos');
    $this->body->offsetSet(0, $content);
    $this->body->scripts()->appendSrc('/foo.js');
    $this->assertSame($this->body->scripts() . "</body>", (string) $this->body->close());
  }

  public function testClone() {
    $content = new Div();
    $this->body->offsetSet(0, $content);
    $cloned = clone $this->body;
    $this->assertNotSame($this->body->offsetGet(0), $cloned->offsetGet(0));
    $this->assertNotSame($this->body->scripts(), $cloned->scripts());
    $this->assertNotSame($this->body, $cloned);
    $this->assertSame((string) $this->body, (string) $cloned);
  }

  public function testTraversing(): void {
    $content = new Div();
    $this->body->offsetSet(0, $content);
    foreach ($this->body as $id => $item) {
      $this->assertSame($content, $item);
    }
  }

}
