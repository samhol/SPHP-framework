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

  public function sources(): array {
    $data = [];
    $data[] = ['foo.bar'];
    $data[] = ['foo.mp4', 1];
    return $data;
  }

  /**
   * @dataProvider sources
   * 
   * @param  string $url
   * @param  string $value
   * @return void
   */
  public function testConstructor(string $url): void {
    $object = new ObjectTag($url);
    $this->assertSame($url, $object->getAttribute('data'));
    $this->assertSame(Mime::getMime($url), $object->getType());
    $this->assertSame(Mime::getMime($url), $object->getAttribute('type'));
    $this->assertSame("<{$object->getTagName()} {$object->attributes()}>{$object->contentToString()}</{$object->getTagName()}>", $object->getHtml());
  }

  public function parameters(): array {
    $data = [];
    $data[] = ['foo', 'bar'];
    $data[] = ['foo', 1];
    $data[] = ['foo', null];
    $data[] = ['foo', true];
    return $data;
  }

  /**
   * @dataProvider parameters
   * 
   * @param  string $name
   * @param  string $value
   * @return void
   */
  public function testAddingParms(string $name, $value): void {
    $object1 = new ObjectTag('foo.mp3');
    $object2 = new ObjectTag('foo.mp3');
    $param = new Param($name, $value);
    $this->assertEquals($param, $object1->addParam($name, $value));
    $this->assertSame($object2, $object2->insertParam($param));
    $this->assertEquals($object2, $object1);
  }

}
