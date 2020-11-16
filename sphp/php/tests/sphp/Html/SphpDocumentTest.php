<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Html\SphpDocument;
use Sphp\Html\Html;
use Sphp\Html\Body;
use Sphp\Html\Head\Head;
use Sphp\Html\Scripts\ExternalScript;
use Sphp\Html\Head\MetaFactory;
use Sphp\Html\Div;
use Sphp\Html\Head\Title;

/**
 * Class SphpDocumentTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SphpDocumentTest extends TestCase {

  /**
   * @return void
   */
  public function testConstructors(): void {
    $doc = new SphpDocument();
    $this->assertSame((string) $doc->getHtml(), (string) $doc);
    $html = new Html();
    $docWithParam = new SphpDocument($html);
    $this->assertSame('<!DOCTYPE html><html><head></head><body></body></html>', (string) $docWithParam);
    $this->assertSame($html, $docWithParam->html());
  }

  /**
   * @return void
   */
  public function testClone(): void {
    $doc = new SphpDocument();
    $cloned = clone $doc;
    $this->assertNotSame($doc, $cloned);
    $this->assertNotSame($doc->head(), $cloned->head());
    $this->assertNotSame($doc->body(), $cloned->body());
  }

  /**
   * @return array
   */
  public function titleData(): array {
    $data = [];
    $data[] = ['foo'];
    $data[] = [''];
    return $data;
  }

  /**
   * @dataProvider titleData
   * 
   * @param  string $title
   * @return void
   */
  public function testSetTitle(string $title = null): void {
    $doc = new SphpDocument();
    $html = $doc->html();
    $titleObj = new Title($title);
    $this->assertSame($doc, $doc->setDocumentTitle($title));
    $this->assertSame((string) $titleObj, (string) $html->getComponentsByObjectType(Title::class));
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
    $doc = new SphpDocument();
    $html = $doc->html();
    $this->assertSame($doc, $doc->setLanguage($lang));
    $this->assertSame($lang, $html->getAttribute('lang'));
  }

  /**
   * @return void
   */
  public function testSetPackages(): void {
    $doc = new SphpDocument();
    $body = new Body();
    $head = new Head();
    $this->assertSame($doc, $doc->useFontAwesome('fa-id'));
    $head->meta()->insert((new ExternalScript("https://kit.fontawesome.com/fa-id.js"))
                    ->setDefer(true));
    $this->assertSame($doc, $doc->useVideoJS());
    $head->meta()->insert(MetaFactory::build()->stylesheet('https://vjs.zencdn.net/7.8.4/video-js.css'));
    $body->scripts()->insertExternal('https://vjs.zencdn.net/7.8.4/video.js');
    $this->assertSame($doc, $doc->enableSPHP());
    $body->scripts()->insertExternal('/sphp/javascript/dist/all.js', 1000)
            ->setDefer(true);
    $this->assertEquals((string) $head, (string) $doc->head());
    $this->assertEquals((string) $body, (string) $doc->body());
  }

  public function testOutputStartAsHtml(): void {
    $doc = new SphpDocument;
    $html = new Html();
    $content = new Div();
    $html->body()->append($content);
    $start = $html->getBodyStart();
    $this->assertSame($start, $doc->getBodyStart());
    $this->expectOutputString($start);
    $doc->startBody();
  }

  /**
   * @return void
   */
  public function testContentToString(): void {
    $doc = new SphpDocument();
    $doc->body()->append('foo');
    $html = new Html();
    $html->body()->append('foo');
    $this->assertSame((string) $html, (string) $doc);
  }

  /**
   * @return void
   */
  public function testOutputtingEnd(): void {
    $doc = new SphpDocument();
    $html = new Html();
    $ending = $html->getDocumentClose();
    $this->assertSame($ending, $doc->getDocumentClose());
    $this->expectOutputString($ending);
    $doc->documentClose();
  }

}
