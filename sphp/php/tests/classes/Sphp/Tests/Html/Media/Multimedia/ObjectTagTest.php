<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Multimedia;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Multimedia\ObjectTag;
use Sphp\Html\Media\Multimedia\Param;
use Sphp\Html\Utils\Mime;

/**
 * Class ObjectTagTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ObjectTagTest extends TestCase {

  use \Sphp\Tests\Html\Media\SizeableMediaTestTrait;

  public function testConstructor(): ObjectTag {
    $object = new ObjectTag('foo.bar');
    $this->assertSame('foo.bar', $object->getAttribute('data'));
    $this->assertSame('object', $object->getTagName());
    return $object;
  }

  public function sources(): array {
    $data = [];
    $data[] = ['foo.bar'];
    $data[] = ['foo.mp4'];
    return $data;
  }

  /**
   * @dataProvider sources
   * 
   * @param  string $url 
   * @return void
   */
  public function testConstructorWithParams(string $url): void {
    $object = new ObjectTag($url);
    $this->assertSame($url, $object->getAttribute('data'));
    $this->assertSame($url, $object->getSrc());
    $this->assertSame(Mime::getMime($url), $object->getType());
    $this->assertSame(Mime::getMime($url), $object->getAttribute('type'));
    $this->assertSame("<{$object->getTagName()} {$object->attributes()}>{$object->contentToString()}</{$object->getTagName()}>", $object->getHtml());
  }

  public function parameters(): array {
    $data = [];
    $data[] = ['foo', 'bar'];
    $data[] = ['foo', 1];
    $data[] = ['foo', 3.1415];
    $data[] = ['foo', null];
    return $data;
  }

  /**
   * @dataProvider parameters
   * 
   * @param  string $name
   * @param  string $value
   * @return void
   */
  public function testAddingParms(string $name, string|int|float|null $value): void {
    $object1 = new ObjectTag('foo.mp3');
    $object2 = new ObjectTag('foo.mp3');
    $param = new Param($name, $value);
    $this->assertEquals($param, $object1->addParam($name, $value));
    $this->assertSame($object2, $object2->insertParam($param));
    $this->assertEquals($object2, $object1);
  }

  /**
   * @dataProvider parameters
   * 
   * @param  string $name
   * @param  string $value
   * @return void
   */
  public function testIterator(): void {
    $object1 = new ObjectTag('foo.mp3');
    $this->assertEmpty($object1->getIterator());
    $param = new Param('a', 'b');
    $object1->addParam('x', 1);
    $object1->insertParam($param);
    $this->assertCount(2, $object1->getIterator());
  }

}
