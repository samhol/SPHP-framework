<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Navigation;

/**
 * Description of HyperlinkTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HyperlinkTest extends AbstractHyperlinkTest {

  public function createHyperlink(): Hyperlink {
    return new A();
  }

  public function testConstructor() {
    $empty = new A();
    $this->assertNull($empty->getHref());
    $this->assertSame($empty->getHref(), $empty->attributes()->getValue('href'));
    $this->assertNull($empty->getTarget());
    $this->assertSame($empty->getTarget(), $empty->attributes()->getValue('target'));


    $notEmpty = new A('/foo', 'content', 'bar');
    $this->assertSame('/foo', $notEmpty->getHref());
    $this->assertSame($notEmpty->getHref(), $notEmpty->attributes()->getValue('href'));
    $this->assertSame('bar', $notEmpty->getTarget());
    $this->assertSame($notEmpty->getTarget(), $notEmpty->attributes()->getValue('target'));
  }

}
