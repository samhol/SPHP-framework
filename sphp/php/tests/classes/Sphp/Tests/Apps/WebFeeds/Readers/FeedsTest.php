<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\WebFeeds\Readers;

use PHPUnit\Framework\TestCase;
use Sphp\Apps\WebFeeds\Readers\Feeds;
use Sphp\Apps\WebFeeds\Readers\RSS;
use Sphp\Apps\WebFeeds\Readers\Atom;
use Sphp\Apps\WebFeeds\Exceptions\WebFeedException;

/**
 * The Feeds class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FeedsTest extends TestCase {

  protected function tearDown(): void {
    parent::tearDown();
    restore_error_handler();
  }

  public function validFeeds(): array {
    $data = [];
    $data[] = ['./sphp/php/tests/files/atom.xml', Atom::class];
    $data[] = ['./sphp/php/tests/files/rss.xml', RSS::class];
    return $data;
  }

  /**
   * @dataProvider validFeeds
   * 
   * @param string $path
   * @param string $type
   */
  public function testValidFeeds(string $path, string $type) {
    $feed = Feeds::load($path, 'foo');
    $this->assertInstanceof($type, $feed);
    $this->assertSame('foo', $feed->getName());
  }

  public function invalidFeeds(): array {
    $data = [];
    $data[] = ['./sphp/php/tests/files/image.gif'];
    $data[] = ['./foo'];
    return $data;
  }

  /**
   * @dataProvider invalidFeeds
   * 
   * @param string $path
   */
  public function testInvalidFeeds(string $path) {
    try {
      Feeds::load($path);
    } catch (WebFeedException $ex) {
      //  echo $ex->getMessage();
    }
    $this->expectException(WebFeedException::class);
    Feeds::load($path, 'foo');
  }

}
