<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Html;
use Sphp\Html\Head\Head;
use Sphp\Html\Body;
use Sphp\Html\Div;

/**
 * Implementation of HtmlTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class HtmlTest extends TestCase {

  public function testEmptyConstructor(): void {
    $html = new Html();
    $this->assertSame('<!DOCTYPE html><html><head></head><body></body></html>', (string) $html);
    $this->assertNull($html->getAttribute('lang'));
  }

  /**
   * @return array
   */
  public function constructorParamsData(): array {
    $data = [];
    $data[] = ['title'];
    $data[] = ['title', 'utf-16'];
    $data[] = ['title', 'utf-16', 'fi'];
    $data[] = [null, 'utf-16', 'fi'];
    return $data;
  }

  /**
   * @dataProvider constructorParamsData
   * 
   * @param string $title
   * @param string $charset
   * @param string $lang
   */
  public function testConstructorWithParams(string $title = null, string $charset = null, string $lang = null): void {
    $htmlTag = new Html($title, $charset, $lang);
    $head = new Head($title, $charset);
    $this->assertSame($lang, $htmlTag->getAttribute('lang'));
    $this->assertEquals($head, $htmlTag->head());
  }

  /**
   * @return array
   */
  public function languageData(): array {
    $data = [];
    $data[] = [null];
    $data[] = ['en'];
    return $data;
  }

  /**
   * @dataProvider languageData
   * 
   * @param  string $lang
   * @return void
   */
  public function testSetLanguage(string $lang = null): void {
    $html = new Html();
    $this->assertSame($html, $html->setLanguage($lang));
    $this->assertSame($lang, $html->getAttribute('lang'));
  }

  public function testClone(): void {
    $html = new Html();
    $cloned = clone $html;
    $this->assertNotSame($html, $cloned);
    $this->assertNotSame($cloned->head(), $html->head());
    $this->assertNotSame($cloned->body(), $html->body());
  }

  public function testTraversingContent(): void {
    $html = new Html();
    $content = new Div();
    $html->body()->append($content);
    $array = iterator_to_array($html);
    $this->assertInstanceOf(Head::class, $array[0]);
    $this->assertInstanceOf(Body::class, $array[1]);
    foreach ($html as $id => $item) {
      $this->assertSame($array[$id], $item);
    }
  }

  public function testOutputtingStart(): void {
    $html = new Html();
    $content = new Div();
    $html->body()->append($content);
    $start = $html->getOpeningTag() . $html->head() . $html->body()->getOpeningTag();
    $this->assertSame($start, $html->getBodyStart());
    $this->expectOutputString($start);
    $html->startBody();
  }

  /**
   * @return void
   */
  public function testContentToString(): void {
    $html = new Html();
    $string = $html->head() . $html->body();
    $this->assertSame($string, $html->contentToString());
  }

  /**
   * @return void
   */
  public function testOutputtingEnd(): void {
    $html = new Html();
    $ending = $html->body()->scripts() . $html->body()->getClosingTag() . $html->getClosingTag();
    $this->assertSame($ending, $html->getDocumentClose());
    $this->expectOutputString($ending);
    $html->documentClose();
  }

}
