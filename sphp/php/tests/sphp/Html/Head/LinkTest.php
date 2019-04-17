<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use PHPUnit\Framework\TestCase;

class LinkTest extends TestCase {

  public function callNames(): array {
    return [
        'alternate',
        'author',
        'dns-prefetch',
        'help',
        'license',
        'next',
        'pingback',
        'preconnect',
        'prefetch',
        'preload',
        'prerender',
        'prev',
        'search', 
        'stylesheet', 
        'icon',
        'manifest',
        'mask-icon'];
  }

  /**
   * @var HeadContentContainer
   */
  protected $link;

  /**
   * @return Head
   */
  public function createContainer(): LinkTag {
    return new LinkTag();
  }

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->link = new LinkTag();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->link);
  }

  public function testConstructor() {
    $c = new LinkTag();
    $this->assertSame([], $c->toArray());
  }

  public function testOverLapping() {
    $link1 = new LinkTag(['rel' => 'icon', 'href' => 'icon.ico']);
    $link2 = new LinkTag(['rel' => 'icon', 'href' => 'icon.ico']);
    $this->assertTrue($link1->overlapsWith($link2));
  }

  public function testFactoring() {
    foreach ($this->callNames() as $call) {
      $link = Link::{$call}('path/to/file');
      $this->assertSame($call, $link->getAttribute('rel'));
    }
  }

}
