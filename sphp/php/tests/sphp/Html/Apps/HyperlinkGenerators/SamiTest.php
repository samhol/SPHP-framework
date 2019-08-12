<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use PHPUnit\Framework\TestCase;

/**
 * Implementation of SamiTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SamiTest extends TestCase {

  public function testUrls(): void {
    $linker = new Sami\SamiUrlGenerator('/foo');
    $classUrl = $linker->getClassUrl(\DateTime::class, 'modify');
    $this->assertSame($classUrl, $linker->createUrl($classUrl));
    $classConstantUrl = $linker->getClassConstantUrl(\DateTime::class, \DateTime::ATOM);
    $this->assertSame($classConstantUrl, $linker->createUrl($classConstantUrl));
    $classMethodUrl = $linker->getClassMethodUrl(\DateTime::class, 'modify');
    $this->assertSame($classMethodUrl, $linker->createUrl($classMethodUrl));
    $constantUrl = $linker->getConstantUrl('MB_CASE_FOLD');
    $this->assertSame($constantUrl, $linker->createUrl($constantUrl));
    $functionUrl = $linker->getFunctionUrl('trim');
    $this->assertSame($functionUrl, $linker->createUrl($functionUrl));
    $namespaceUrl = $linker->getNamespaceUrl(__NAMESPACE__);
    $this->assertSame($namespaceUrl, $linker->createUrl($namespaceUrl));
  }

}
