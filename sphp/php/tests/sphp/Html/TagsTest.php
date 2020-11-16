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
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;

class TagsTest extends TestCase {

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
        'p' => [Flow\Paragraph::class, ['cont']],
        'section' => [Flow\Section::class, ['cont']],
        'article' => [Flow\Article::class, ['cont']],
        'aside' => [Flow\Aside::class, ['cont']],
        'main' => [Flow\Main::class, ['cont']],
        'footer' => [Flow\Footer::class, ['cont']],
    ];
  }

  public function testFactoring() {
    foreach ($this->tagList() as $call => $data) {
      //echo "\ncall: $call";
      $this->assertInstanceOf($data[0], Tags::create($call, $data[1]));
      $this->assertInstanceOf($data[0], Tags::$call(...$data[1]));
      $str = Tags::create($call, $data[1]);
      $this->assertTrue(\Sphp\Stdlib\Strings::contains("$str", '<' . $str->getTagName()));
    }
  }

  public function testInvalidCreateMethodCall() {
    $this->expectException(InvalidArgumentException::class);
    Tags::create('foo');
  }

  public function testInvalidMagicCall() {
    $this->expectException(BadMethodCallException::class);
    Tags::foo('foo');
  }

}
