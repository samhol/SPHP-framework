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
use Sphp\Html\Media\Multimedia\Iframe;

/**
 * Class IframeTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class IframeTest extends TestCase {

  use \Sphp\Tests\Html\Media\SizeableMediaTestTrait;

  /**
   * @return string[]
   */
  public function constructorParameters(): array {
    return [
        [null, null],
        ['foo.bar', null],
        ['foo.bar', 'f1'],
        [null, 'f1'],
    ];
  }

  /**
   * @return Iframe
   */
  public function testConstructor(): Iframe {
    $src = 'https://foo.com';
    $iframe = new Iframe($src);
    $this->assertSame($src, $iframe->getSrc());
    $this->assertSame($src, $iframe->getAttribute('src'));
    return $iframe;
  }

  /**
   * @depends testConstructor
   * 
   * @param Iframe $iframe
   */
  public function testName(Iframe $iframe): Iframe {
    $name = 'foo-frame';
    $this->assertNull($iframe->getAttribute('name'));
    $this->assertSame($iframe, $iframe->setName($name));
    $this->assertSame($name, $iframe->getName());
    $this->assertSame($name, $iframe->getAttribute('name'));
    return $iframe;
  }

  /**
   * @depends testName
   * 
   * @param Iframe $iframe
   */
  public function testSandbox(Iframe $iframe) {
    $this->assertSame('', $iframe->getSandbox());
    $this->assertSame($iframe, $iframe->setSandbox('allow-scripts'));
    $this->assertSame('allow-scripts', $iframe->getSandbox());
  }

}
