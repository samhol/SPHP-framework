<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP\PHPManual;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\PHP\PHPManual\LanguageReferenceLinker;
use Sphp\Documentation\Linkers\PHP\PHPManual\PHPManualURLs;
use Sphp\Documentation\Linkers\HyperlinkFactory;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;

/**
 * Class ReservedWordLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ReservedWordLinkerTest extends TestCase {

  protected PHPManualURLs $urlGen;
  protected HyperlinkFactory $hyperlinkFactory;

  protected function setUp(): void {
    $this->urlGen = new PHPManualURLs;
    $this->hyperlinkFactory = new HyperlinkFactory();
  }

  public function testDefaultConstructor(): void {
    $word = 'abstract';
    $linker = new LanguageReferenceLinker($word);
    $link = $linker->toHyperlink();
    $this->assertSame($this->urlGen->getLanguageReferenceUrl($word), $link->getHref());
    $this->assertSame($linker->getDefaultContent(), $link->contentToString());
  }

  public function testConstructor(): void {
    $word = 'abstract';
    $linker = new LanguageReferenceLinker($word, $this->urlGen, $this->hyperlinkFactory);
    $link = $linker->toHyperlink();
    $this->assertSame($this->hyperlinkFactory, $linker->getHyperlinkFactory());
    $this->assertSame($this->urlGen->getLanguageReferenceUrl($word), $link->getHref());
    $this->assertSame($linker->getDefaultContent(), $link->contentToString());
  }

  public function testInvoking(): void {
    $word = 'abstract';
    $linker = new LanguageReferenceLinker($word, $this->urlGen, $this->hyperlinkFactory);
    $link = $linker->toHyperlink();
    $this->assertEquals($link, $linker());
    $this->assertEquals($linker->toHyperlink('foo'), $linker('foo'));
  }

  public function notReservedWords(): array {
    $data = [];
    $data[] = [''];

    return $data;
  }

  /**
   * @dataProvider notReservedWords
   * @param  string $word
   * @return void
   */
  public function testInvalidCreation(string $word): void {
    $this->expectException(NonDocumentedFeatureException::class);
    new LanguageReferenceLinker($word, $this->urlGen, $this->hyperlinkFactory);
  }

}
