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
use Sphp\Documentation\Linkers\PHP\PHPManual\ManualURL;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;

/**
 * Class ManualBookTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ManualBookTest extends TestCase {

  use \Sphp\Tests\Documentation\Linkers\PHP\PHPManual\ManualURLTestTrait;

  /**
   * @var PHPManualUrlBuilder 
   */
  private PHPManualUrlBuilder $urlBuilder;

  protected function setUp(): void {
    $this->urlBuilder = new PHPManualUrlBuilder;
  }

  public function nameMap(): array {
    $data[] = ['apache'];
    $data[] = ['pdo-sqlite'];
    $data[] = ['datetime'];
    return $data;
  }

  public function bookDataMap(): array {
    $data[] = ['apache', 'Apache'];
    $data[] = ['pdo', 'PDO'];
    $data[] = ['datetime', 'Date time'];
    return $data;
  }

  /** 
   * @return Book
   */
  public function testConstructor(): Book {
    $book = new Book('apache', 'Apache');
    $this->assertSame('apache', $book->getName());
    $this->assertSame($this->urlBuilder->getApiname(), $book->getApiname());
    $this->assertSame('Apache', $book->getDescription());
    return $book;
  }

  /**
   * @depends testConstructor
   *  
   * @param  Book $book
   * @return void
   */
  public function testGetUrl(Book $book): void {
    $this->assertSame($this->urlBuilder->createUrl('book.%s.php', $book->getName()), $book->getURL());
  }

  /**
   * @depends testConstructor
   * 
   * @param  Book $book
   * @return void
   */
  public function testCloning(Book $book): void {
    $clone = clone $book;
    $this->assertNotSame($book, $clone);
    $this->assertEquals($book, $clone);
    $this->assertSame($book->getURL(), $clone->getURL());
  }

  /**
   * @depends testConstructor
   * 
   * @param  Book $book
   * @return void
   */
  public function testGetInvalidUrl(Book $book): void {
    $this->expectException(NonDocumentedFeatureException::class);
    $book->getURL('foo');
  }

  public function constantNameMap(): array {
    //$data[] = ['__CLASS__'];
    $data[] = ['MB_CASE_FOLD'];
    $data[] = ['E_ALL'];
    $data[] = ['PHP_BINDIR'];
    $data[] = ['SID'];
    return $data;
  }

  public function createManualURL(string $lang = 'en'): ManualURL {
    return (new Book('array', 'Array', $this->urlBuilder))->setLanguage($lang);
  }

}
