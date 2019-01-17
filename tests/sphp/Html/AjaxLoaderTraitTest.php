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

class AjaxLoaderTraitTest extends TestCase {

  public function testConcreteMethod() {
    $mock = $this->getMockForTrait(AjaxLoaderTrait::class);
    $mngr = new Attributes\HtmlAttributeManager();
    $mock->expects($this->any())
            ->method('attributes')
            ->will($this->returnValue($mngr));
    $this->assertSame($mock, $mock->ajaxPrepend('ajax/prepend.html'));
    $this->assertSame($mock, $mock->ajaxAppend('ajax/append.html'));
    $this->assertTrue($mock->attributes()->isVisible('data-sphp-ajax-prepend'));
    $this->assertTrue($mock->attributes()->isVisible('data-sphp-ajax-append'));
    $this->assertSame('ajax/append.html', $mock->attributes()->getValue('data-sphp-ajax-append'));
    $this->assertSame('ajax/prepend.html', $mock->attributes()->getValue('data-sphp-ajax-prepend'));
  }

}
