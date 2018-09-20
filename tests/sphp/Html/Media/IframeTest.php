<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media;

use PHPUnit\Framework\TestCase;

class IframeTest extends TestCase {

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
   * @dataProvider constructorParameters
   * @param  string $src
   * @param  string $name
   * @return Iframe
   */
  public function testConstructor(string $src = null, string $name = null): Iframe {
    $iframe = new Iframe($src, $name);
    $this->assertSame("$src", $iframe->getSrc());
    $this->assertSame("$name", $iframe->getName());
    return $iframe;
  }

  /**
   * @return Iframe
   */
  public function testSeamless(): Iframe {
    $iframe = new Iframe('foo.bar', 'f1');
    $this->assertSame($iframe, $iframe->setSeamless());
    return $iframe;
  }

  /**
   * @depends testSeamless
   * @param Iframe $iframe
   */
  public function testSandbox(Iframe $iframe) {
    $this->assertSame('', $iframe->getSandbox());
    $this->assertSame($iframe, $iframe->setSandbox('allow-scripts'));
    $this->assertSame('allow-scripts', $iframe->getSandbox());
  }

}
