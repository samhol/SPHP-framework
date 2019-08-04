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

/**
 * Implementation of HtmlTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DocumentTest extends TestCase {

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    // $this->link = new LinkTag();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    //unset($this->link);
  }

  public function testConstructor() {
    $defaultDoc = new SphpDocument();
    $this->assertSame('<!DOCTYPE html><html><head></head><body></body></html>', (string) $defaultDoc);
    $html = new Html();
    $doc = new SphpDocument($html);
    $this->assertSame('<!DOCTYPE html><html><head></head><body></body></html>', (string) $defaultDoc);
    $this->assertSame($html, $doc->html());
    return $doc;
  }

  /**
   * @depends testConstructor
   * @param SphpDocument $doc
   */
  public function testClone(SphpDocument $doc) {
    $cloned = clone $doc;
    $this->assertNotSame($doc, $cloned);
    $this->assertNotSame($doc->head(), $cloned->head());
    $this->assertNotSame($doc->body(), $cloned->body());
  }

}
