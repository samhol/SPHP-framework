<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Tags;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\Text;
use Sphp\Html\Layout;
use Sphp\Html\Navigation;
use Sphp\Html\EmptyTag;
use Sphp\Html\Scripts;
use Sphp\Html\Media;
use Sphp\Html\ContainerTag;

class TagsTest extends TestCase {

  public function tags(): array {
    return [
        ['html', \Sphp\Html\Html::class],
        ['base', \Sphp\Html\Head\Base::class],
        ['pre', \Sphp\Html\Code\Pre::class],
        ['code', \Sphp\Html\Code\Code::class],
        ['var', \Sphp\Html\Code\Variable::class],
        ['div', \Sphp\Html\Layout\Div::class],
        ['footer', \Sphp\Html\Layout\Footer::class],
        ['aside', \Sphp\Html\Layout\Aside::class],
        ['section', \Sphp\Html\Layout\Section::class],
        ['p', \Sphp\Html\Text\Paragraph::class],
        ['i', \Sphp\Html\Text\I::class],
        ['strong', \Sphp\Html\Text\Strong::class],
        ['small', \Sphp\Html\Text\Small::class],
        ['span', \Sphp\Html\Text\Span::class],
        ['blockquote', \Sphp\Html\Text\Blockquote::class],
        ['hr', \Sphp\Html\Text\Hr::class],
        ['address', \Sphp\Html\ContainerTag::class],
        ['style', \Sphp\Html\ContainerTag::class],
        ['wbr', \Sphp\Html\EmptyTag::class],
        ['header', \Sphp\Html\Layout\Header::class],
        ['footer', \Sphp\Html\Layout\Footer::class],
        ['section', \Sphp\Html\Layout\Section::class],
        ['aside', \Sphp\Html\Layout\Aside::class],
        ['article', \Sphp\Html\Layout\Article::class],
        ['main', \Sphp\Html\Layout\Main::class],
            /*  "head",
              "style",
              "title",
              "address",
              "article",
              "footer",
              "header",
              "h1",
              "h2",
              "h3",
              "h4",
              "h5",
              "h6",
              "hgroup", "nav", "section", "dd", "div", "dl",
              "dt", "figcaption", "figure",
              "hr", "li", "main",
              "ol", "p",
              "pre", "ul", "abbr", "b",
              "bdi", "bdo",
              "br", "cite",
              "code", "data", "dfn", "em", "i",
              "kbd", "mark", "q", "rp", "rt", "rtc",
              "ruby", "s",
              "samp",
              "small",
              "span", "strong", "sub",
              "sup",
              "time",
              "u", "var", "wbr", "area",
              "audio", "map",
              "track",
              "video",
              "embed", "object", "param",
              "source", "canvas",
              "noscript",
              "script",
              "del",
              "ins", "caption", "col",
              "colgroup", "table", "tbody",
              "td", "tfoot", "th", "thead", "tr", "button",
              "datalist", "fieldset",
              "form", "input",
              "keygen", "label", "legend", "meter", "optgroup", "option", "output", "progress",
              "select", "details",
              "dialog",
              "menu", "menuitem", "summary", "content", "element",
              "shadow", "template", "acronym", "applet", "basefont", "big", "dir",
              "isindex", "listing", "noembed", "plaintext",
              "strike", "tt", "xmp"
             * 
             */
    ];
  }

  /**
   * @dataProvider tags
   * 
   * @param string $tagName
   * @param string $typeName
   * @return void
   */
  public function testTagFactoring(string $tagName, string $typeName): void {
    //echo "\ncall: $call";
    $obj1 = Tags::create($tagName);
    $obj2 = Tags::$tagName();
    $this->assertInstanceOf($typeName, $obj1);
    $this->assertInstanceOf($typeName, $obj2);
    $this->assertEquals($obj1, $obj2);
    $this->assertSame($tagName, $obj1->getTagName());
  }

  /**
   * list of tags and their corresponding PHP classes
   *
   * @var mixed[]
   */
  public function tagList(): array {
    return [
        'a' => [Navigation\A::class, ['/foo']],
        'InlineScript' => [Scripts\InlineScript::class, ['var foo;']],
        'script' => [Scripts\ExternalScript::class, ['/foo.png']],
        'img' => [Media\Img::class, ['/foo.png', 'alt']],
        'style' => [ContainerTag::class, []],
        'wbr' => [EmptyTag::class, []],
        'track' => [Media\Multimedia\Track::class, ['/foo.vtt']],
        'source' => [Media\Multimedia\Source::class, ['/foo.mp4']],
        'p' => [Text\Paragraph::class, ['cont']],
        'section' => [Layout\Section::class, ['cont']],
        'article' => [Layout\Article::class, ['cont']],
        'aside' => [Layout\Aside::class, ['cont']],
        'main' => [Layout\Main::class, ['cont']],
        'footer' => [Layout\Footer::class, ['cont']],
    ];
  }

  public function testFactoring(): void {
    foreach ($this->tagList() as $call => $data) {
      //echo "\ncall: $call";
      $obj1 = Tags::create($call, ...$data[1]);
      $this->assertInstanceOf($data[0], $obj1);
      $this->assertInstanceOf($data[0], Tags::$call(...$data[1]));
      $this->assertTrue(str_contains("$obj1", '<' . $obj1->getTagName()));
    }
  }

  public function testInvalidCreateMethodCall(): void {
    $this->expectException(InvalidArgumentException::class);
    Tags::create('foo');
  }

  public function testInvalidMagicCall(): void {
    $this->expectException(BadMethodCallException::class);
    Tags::foo('foo');
  }

}
