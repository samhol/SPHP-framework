<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Icons;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Icons\IconTag;
use Sphp\Exceptions\BadMethodCallException;
/**
 * Description of IconTagTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class IconTagTest extends TestCase {

  public function testCallStatic() {
    $i = IconTag::i('devicon-github-plain');
    $this->assertTrue($i->cssClasses()->contains('devicon-github-plain'));
    $this->assertSame('i', $i->getTagName());
    $span = IconTag::span('devicon-github-plain');
    $this->assertTrue($span->cssClasses()->contains('devicon-github-plain'));
    $this->assertSame('span', $span->getTagName());
    $this->expectException(BadMethodCallException::class);
     IconTag::{'foo-bar'}('devicon-github-plain');
  }
  
  public function testCallStaticWithNoIconName() {
    $this->expectException(BadMethodCallException::class);
     IconTag::i();
  }

}
