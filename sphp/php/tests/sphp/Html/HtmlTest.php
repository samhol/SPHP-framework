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
use Sphp\Html\Head\Head;

/**
 * Implementation of HtmlTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class HtmlTest extends TestCase {

  /**
   * @var Html 
   */
  private $html;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->html = new Html();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->html);
  }

  public function testConstructor() {
    $c = new Html();
    $this->assertSame('<!DOCTYPE html><html><head></head><body></body></html>', (string) $c);
  }

  public function testClone() {
    $html = new Html();
    $cloned = clone $html;
    $this->assertNotSame($html, $cloned);
    $this->assertNotSame($cloned->head(), $html->head());
    $this->assertNotSame($cloned->body(), $html->body());
  }

  public function testTraversing(): void {
    $content = new Div();
    $this->html->body()->offsetSet(0, $content);
    $array = iterator_to_array($this->html);
    $this->assertInstanceOf(Head::class, $array[0]);
    $this->assertInstanceOf(Body::class, $array[1]);
    foreach ($this->html as $id => $item) {
      $this->assertSame($array[$id], $item);
    }
  }

}
