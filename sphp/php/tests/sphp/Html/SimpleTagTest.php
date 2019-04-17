<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\HtmlAttributeManager;

class SimpleTagTest extends TestCase {

  /**
   * @var SimpleTag
   */
  protected $tag;

  /**
   * @return Head
   */
  public function createContainer(): SimpleTag {
    return new SimpleTag('title');
  }

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->createContainer();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->tag);
  }

  /**
   * @return string[]
   */
  public function constructorParameters(): array {
    return [
        ['title', 'This is Title', null],
        ['option', 0, null],
        ['option', false, new HtmlAttributeManager()],
    ];
  }

  /**
   * @dataProvider constructorParameters
   * 
   * @param string $tagName
   * @param scalar $content
   * @param HtmlAttributeManager $mngr
   */
  public function testConstructor(string $tagName, $content, HtmlAttributeManager $mngr = null) {
    $c = new SimpleTag($tagName, $content, $mngr);
    $this->assertSame("<$tagName>$content</$tagName>", $c->getHtml());
    $this->assertSame("$content", $c->contentToString());
  }

}
