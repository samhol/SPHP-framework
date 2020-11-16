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
use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Exceptions\HtmlException;

class ContentParserTraitTest extends TestCase {

  /**
   * @var ContentParserTrait
   */
  protected $container;
  protected $appendedStrings;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->appendedStrings = [];
    $f = function($subject) {
      $this->appendedStrings[] = $subject;
      $this->assertTrue(is_string($subject));
    };
    $this->container = $this->getMockForTrait(ContentParserTrait::class);
    $this->container->expects($this->any())
            ->method('append')
            ->will($this->returnCallback($f));
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->container, $this->appendedStrings);
  }

  public function testAppendMd() {
    $mdString = file_get_contents(__DIR__ . '/../../files/valid.md');
    $mdToHtml = ParseFactory::md()->parseString($mdString);
    $this->container->appendMarkdown($mdString);
    $this->container->appendMarkdownFile(__DIR__ . '/../../files/valid.md');
    // print_r($this->appendedStrings);
    $this->assertSame($mdToHtml, $this->appendedStrings[0]);
    $this->expectException(HtmlException::class);
    $this->container->appendMarkdownFile('foo.md');
  }

  public function testAppendRawFile() {
    $mdString = file_get_contents(__DIR__ . '/../../files/valid.md');
    $this->container->appendRawFile(__DIR__ . '/../../files/valid.md');
    // print_r($this->appendedStrings);
    $this->assertSame($mdString, $this->appendedStrings[0]);
    $this->expectException(HtmlException::class);
    $this->container->appendRawFile('foo.bar');
  }

}
