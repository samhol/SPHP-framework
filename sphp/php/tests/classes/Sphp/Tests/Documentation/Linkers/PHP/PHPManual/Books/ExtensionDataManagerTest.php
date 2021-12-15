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
use Sphp\Documentation\Linkers\PHP\PHPManual\PHPManualUrlBuilder;
use Sphp\Documentation\Linkers\PHP\PHPManual\ManualURL;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;
use Sphp\Documentation\Linkers\PHP\PHPManual\Books\Reference;

/**
 * Class ExtensionsTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ExtensionDataManagerTest extends TestCase {

  use \Sphp\Tests\Documentation\Linkers\PHP\PHPManual\ManualURLTestTrait;

  /**
   * @var PHPManualUrlBuilder 
   */
  private $urlBuilder;

  protected function setUp(): void {
    $this->urlBuilder = new PHPManualUrlBuilder;
  }

  public function nameMap(): array {
    $data[] = ['apache'];
    $data[] = ['pdo-sqlite'];
    $data[] = ['datetime'];
    return $data;
  }

  public function bookNameMap(): array {
    $data[] = ['apache'];
    $data[] = ['pdo'];
    $data[] = ['datetime'];
    return $data;
  }

  /**
   * @return void
   */
  public function testGetType(): void {
    $books = new ExtensionDataManager($this->urlBuilder);
    foreach ($books as $book) {
      $name = $book->getName();
      $this->assertInstanceOf(Reference::class, $book);
      $this->assertSame($this->urlBuilder->getApiname(), $book->getApiname());
      $this->assertTrue($books->isReference($name));
      if (!$book instanceof Book) {
        $this->assertFalse($books->isBook($name));
        $expected = $this->urlBuilder->createUrl('ref.%s.php', $book->getName());
        $this->assertSame($expected, $book->getURL(Book::INDEX));
      }
      $this->assertSame($book, $book->setLanguage('es'));
      $this->urlBuilder->setLanguage('es');
      $this->assertSame($this->urlBuilder->getRootUrl(), $book->getRootUrl());
      $this->urlBuilder->setLanguage('en');
    }
  }

  /**
   * @dataProvider bookNameMap
   * 
   * @return void
   */
  public function testGetBook(string $name): void {
    $books = ExtensionDataManager::instance();
    $this->assertTrue($books->isBook($name));
    $book = $books->getReference($name);
    $this->assertInstanceOf(Book::class, $book);
    $this->assertSame($this->urlBuilder->getApiname(), $book->getApiname());
  }

  /**
   * @return void
   */
  public function testCloning(): void {
    $book = ExtensionDataManager::instance()->getReference('array');
    $clone = clone $book;
    $this->assertNotSame($book, $clone);
    $this->assertEquals($book, $clone);
    $this->assertSame($book->getURL(), $clone->getURL());
  }



  /**
   * @dataProvider bookNameMap
   * 
   * @param  string $bookName
   * @return void
   */
  public function testInvalidGetURLCall(string $bookName): void {
    $book = ExtensionDataManager::instance()->getReference($bookName);
    $this->expectException(NonDocumentedFeatureException::class);
    $book->getURL('foo');
  }

  public function createManualURL(string $lang = 'en'): ManualURL {
    return ExtensionDataManager::instance()->getReference('array')->setLanguage($lang);
  }

}
