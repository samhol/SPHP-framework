<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
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
        'p' => [Sections\Paragraph::class, ['cont']],
        'section' => [Sections\Section::class, ['cont']],
        'article' => [Sections\Article::class, ['cont']],
        'aside' => [Sections\Aside::class, ['cont']],
        'main' => [Sections\Main::class, ['cont']],
        'footer' => [Sections\Footer::class, ['cont']],
    ];
  }

  public function testFactoring(): void {
    foreach ($this->tagList() as $call => $data) {
      //echo "\ncall: $call";
      $obj1 = Tags::create($call, ...$data[1]);
      $this->assertInstanceOf($data[0], $obj1);
      $this->assertInstanceOf($data[0], Tags::$call(...$data[1]));
      $this->assertTrue(\Sphp\Stdlib\Strings::contains("$obj1", '<' . $obj1->getTagName()));
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
