<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Navigation;

use PHPUnit\Framework\TestCase;

/**
 * Abstract test class for hyperlink properties
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractHyperlinkTest extends TestCase {

  /**
   * @return Hyperlink created instance
   */
  abstract public function createHyperlink(): Hyperlink;

  public function testAttributes(): void {
    $hyperlink = $this->createHyperlink();
    $this->assertSame($hyperlink, $hyperlink->setHref('foo.html'));
   // $this->assertSame('foo.html', $hyperlink->attributes()->getValue('href'));
    $this->assertSame('foo.html', $hyperlink->getHref());
    $this->assertSame($hyperlink, $hyperlink->setTarget('foo'));
 //   $this->assertSame('foo', $hyperlink->attributes()->getValue('target'));
    $this->assertSame('foo', $hyperlink->getTarget());
    $this->assertSame($hyperlink, $hyperlink->setRelationship('help'));
  // $this->assertSame('help', $hyperlink->attributes()->getValue('rel'));
    $this->assertSame('help', $hyperlink->getRelationship());
  }

  public function testHref(): Hyperlink {
    $hyperlink = $this->createHyperlink();
    $this->assertSame($hyperlink, $hyperlink->setHref(null));
    $this->assertNull($hyperlink->getHref());
    $this->assertSame($hyperlink, $hyperlink->setHref('foo.html'));
    $this->assertSame('foo.html', $hyperlink->getHref());
    return $hyperlink;
  }

  /**
   * @depends testHref
   * 
   * @param \Sphp\Html\Navigation\Hyperlink $hyperlink
   * @return void
   */
  public function testTarget(Hyperlink $hyperlink): void {
    //$hyperlink = $this->createHyperlink();
    $this->assertSame($hyperlink, $hyperlink->setTarget(null));
    $this->assertNull($hyperlink->getTarget());
    $this->assertSame($hyperlink, $hyperlink->setTarget('foo'));
    $this->assertSame('foo', $hyperlink->getTarget());
    $this->assertSame($hyperlink, $hyperlink->setRelationship('help'));
   // $this->assertSame('help', $hyperlink->attributes()->getValue('rel'));
    $this->assertSame('help', $hyperlink->getRelationship());
  }

  public function testBlankTarget(): void {
    $hyperlink = $this->createHyperlink();
    $this->assertSame($hyperlink, $hyperlink->setTarget('_blank'));
    $this->assertSame('noopener noreferrer', $hyperlink->getRelationship());
  }

}
