<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Multimedia;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Multimedia\AbstractMultimediaTag;

/**
 * Class AbstractMultimediaTagTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractMultimediaTagTest extends TestCase {

  public function createObject(string $tagName): AbstractMultimediaTag {
    $mock = $this->getMockForAbstractClass(AbstractMultimediaTag::class, [$tagName]);
    return $mock;
  }

  public function testConstructor() {
    $mock = $this->createObject('foo');
    $this->assertSame('foo', $mock->getTagName());
    $this->assertFalse($mock->attributeExists('controls'));
    $this->assertSame($mock, $mock->showControls(true));
    $this->assertTrue($mock->attributeExists('controls'));
    $this->assertSame($mock, $mock->autoplay(true));
    $this->assertTrue($mock->attributeExists('autoplay'));
    $this->assertFalse($mock->attributeExists('loop'));
    $this->assertSame($mock, $mock->loop(true));
    $this->assertTrue($mock->attributeExists('loop'));
    $this->assertFalse($mock->attributeExists('muted'));
    $this->assertSame($mock, $mock->mute(true));
    $this->assertTrue($mock->attributeExists('muted'));
  }

  public function testSetSources() {
    $mock = $this->createObject('foo');
    $source = new \Sphp\Html\Media\Multimedia\Source('foo.mp4');
    $this->assertEquals($source, $mock->addSource('foo.mp4'));
  }

}
