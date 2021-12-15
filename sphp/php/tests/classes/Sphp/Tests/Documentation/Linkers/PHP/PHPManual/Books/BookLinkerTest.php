<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers\PHP\PHPManual\Books;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\PHP\PHPManual\Books\ExtensionDataManager;
use Sphp\Documentation\Linkers\PHP\PHPManual\Books\Book;
use Sphp\Documentation\Linkers\PHP\PHPManual\Books\ReferenceLinker;
use Sphp\Documentation\Linkers\HyperlinkFactory;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;

/**
 * Class BookLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BookLinkerTest extends TestCase {

  /**
   * @var Book
   */
  protected $book;

  /**
   * @var HyperlinkFactory 
   */
  protected $hyperlinkFactory;

  protected function setUp(): void {
    $this->book = ExtensionDataManager::instance()->getReference('array');
    $this->hyperlinkFactory = new HyperlinkFactory();
  }

  public function testConstructor(): void {
    $book = ExtensionDataManager::instance()->getReference('array');
    $linker = new ReferenceLinker($book, $this->hyperlinkFactory);
    $this->assertSame($book->getURL(), $linker->getUrl());
    $this->assertSame($this->hyperlinkFactory, $linker->getHyperlinkFactory());
    //echo "Book: " . $linker->getDefaultLinkContent(Book::CONFIGURATION);
  }

  public function bookMap() {
    $data = [];
    $data[] = ['dom'];
    $data[] = ['pdo-mysql'];
    return $data;
  }

  public function testToarray() {
    $linker = ReferenceLinker::create('dom', $this->hyperlinkFactory);
    $book = $linker->getReference();
    $this->assertContainsOnly(\Sphp\Html\Navigation\Hyperlink::class, $linker->toArray());
  }

  /**
   * @dataProvider bookMap
   * 
   * @param  string $bookName
   * @return void
   */
  public function testHyperlinkBuilding(string $bookName): void {
    $linker = ReferenceLinker::create($bookName, $this->hyperlinkFactory);
    $book = $linker->getReference();
    $a = $linker->toHyperlink();
    $this->assertEquals($a, $linker->getHyperlinkFor());
    $this->assertEquals($book->getURL(), $linker->getHyperlinkFor()->getHref());
    if ($book instanceof Book) {
      $this->assertEquals($book->getURL(Book::INSTALLATION), $linker->getHyperlinkFor(Book::INSTALLATION)->getHref());
      $this->assertEquals($book->getURL(Book::INTRO), $linker->getHyperlinkFor(Book::INTRO)->getHref());
      $this->assertEquals($book->getURL(Book::SETUP), $linker->getHyperlinkFor(Book::SETUP)->getHref());
      $this->assertEquals($book->getURL(Book::CONFIGURATION), $linker->getHyperlinkFor(Book::CONFIGURATION)->getHref());
      $this->assertEquals($book->getURL(Book::CONSTANTS), $linker->getHyperlinkFor(Book::CONSTANTS)->getHref());
    }
  }

  public function invalidBookMap(): array {
    $data = [];
    $data[] = [''];
    $data[] = ['foo'];
    return $data;
  }

  /**
   * @dataProvider invalidBookMap
   * 
   * @param  string $bookName
   * @return void
   */
  public function testInvalidCreate(string $bookName): void {
    $this->expectException(NonDocumentedFeatureException::class);
    ReferenceLinker::create($bookName, $this->hyperlinkFactory);
  }

}
