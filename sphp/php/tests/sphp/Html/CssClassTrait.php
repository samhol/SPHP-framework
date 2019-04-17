<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use Sphp\Html\CssClassifiableContent;

/**
 * Description of CssClassTrait
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
trait CssClassTrait {

  public function assertNotContainsCssClass(CssClassifiableContent $content, string... $className) {
    $classes = implode(', ', $className);
    $this->assertFalse($content->cssClasses()->contains($className), "Content Contains $classes");
  }

  public function assertContainsCssClass(CssClassifiableContent $content, string... $className) {
    $this->assertTrue($content->cssClasses()->contains($className));
  }

}
