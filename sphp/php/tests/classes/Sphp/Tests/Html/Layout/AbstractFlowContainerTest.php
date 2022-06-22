<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Layout;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Layout\AbstractFlowContainer;

class AbstractFlowContainerTest extends TestCase {

  public function testDataTypes(): void {
    $mock = $this->getMockForAbstractClass(AbstractFlowContainer::class, ['foo']);
    $components['h1'] = $mock->appendH1('h1');
    $components['h2'] = $mock->appendH2('h2');
    $components['h3'] = $mock->appendH3('h3');
    $components['h4'] = $mock->appendH4('h4');
    $components['h5'] = $mock->appendH5('h5');
    $components['h6'] = $mock->appendH6('h6');
    $components['p'] = $mock->appendParagraph('p');
    $components['article'] = $mock->appendArticle('article');
    $components['section'] = $mock->appendSection('section');
    $components['aside'] = $mock->appendAside('aside');
    $components['hr'] = $mock->appendHr();
    $components['a'] = $mock->appendHyperlink('/', 'a', '_blank');
    $this->assertSame("<foo>" . implode('', $components) . "</foo>", (string) $mock);
  }

}
