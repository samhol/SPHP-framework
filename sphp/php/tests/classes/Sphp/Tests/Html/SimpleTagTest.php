<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Html\SimpleTag;
use Sphp\Html\Attributes\AttributeContainer;

class SimpleTagTest extends TestCase {

  public function constructorParameters(): iterable {
    yield ['title', 'This is Title', null];
    yield ['option', null, null];
    yield ['option', null, new AttributeContainer()];
  }

  /**
   * @dataProvider constructorParameters
   * 
   * @param  string $tagName
   * @param  mixed $content
   * @param  AttributeContainer|null $mngr
   * @return void
   */
  public function testConstructor(string $tagName, $content, ?AttributeContainer $mngr): void {
    $c = new SimpleTag($tagName, $content, $mngr);
    $this->assertSame("<$tagName>$content</$tagName>", $c->getHtml());
    $this->assertSame("$content", $c->contentToString());
  }

}
