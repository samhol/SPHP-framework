<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP\PHPManual\Books;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\PHP\PHPManual\PHPManualUrlBuilder;
use Sphp\Documentation\Linkers\PHP\PHPManual\Books\Book;
use Sphp\Documentation\Linkers\PHP\PHPManual\Books\Reference;
use Sphp\Documentation\Linkers\PHP\PHPManual\ManualURL;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;

/**
 * Class ManualReferenceTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ManualReferenceTest extends TestCase {

  use \Sphp\Tests\Documentation\Linkers\PHP\PHPManual\ManualURLTestTrait;

  /**
   * @var PHPManualUrlBuilder 
   */
  private PHPManualUrlBuilder $urlBuilder;

  protected function setUp(): void {
    $this->urlBuilder = new PHPManualUrlBuilder;
  }

  /**
   * @return Reference
   */
  public function testConstructor(): Reference {
    $book = new Reference('apache', 'Apache');
    $this->assertSame('apache', $book->getName());
    $this->assertSame($this->urlBuilder->getApiname(), $book->getApiname());
    $this->assertSame('Apache', $book->getDescription());
    return $book;
  }

  /**
   * @depends testConstructor
   *  
   * @param  Reference $ref
   * @return void
   */
  public function testGetUrl(Reference $ref): void {
    $this->assertSame($this->urlBuilder->createUrl('ref.%s.php', $ref->getName()), $ref->getURL());
  }

  /**
   * @depends testConstructor
   * 
   * @param  Reference $ref
   * @return void
   */
  public function testCloning(Reference $ref): void {
    $clone = clone $ref;
    $this->assertNotSame($ref, $clone);
    $this->assertEquals($ref, $clone);
    $this->assertSame($ref->getURL(), $clone->getURL());
  }

  public function createManualURL(string $lang = 'en'): ManualURL {
    return (new Reference('array', 'Array', $this->urlBuilder))->setLanguage($lang);
  }

}
