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

use Sphp\Apps\WebFeeds\Readers\AtomEntry;
use PHPUnit\Framework\TestCase;
use Sphp\DateTime\ImmutableDateTime;
use Sphp\Apps\WebFeeds\Readers\FeedLink;

/**
 * The AbstractEntryTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AtomEntryTest extends TestCase {

  public function files(): array {
    $data = [];
    $data[] = ['./sphp/php/tests/files/atom.xml'];
    return $data;
  }

  /**
   * @dataProvider files
   *
   * @param  string $path
   * @return void
   */
  public function testEntries(string $path): void {
    $xml = simplexml_load_file($path);
    foreach ($xml->entry as $entry) {
      $entryObject = new AtomEntry($entry);
      $this->assertSame((string) $entry->title, $entryObject->getTitle());
      $this->assertSame((string) $entry->id, $entryObject->getId());
      $dateString = (string) $xml->updated;
      $date = ImmutableDateTime::from($dateString);
      $this->assertEquals($date, $entryObject->getUpdated());
      $expected = [];
      foreach ($entry->link as $linkData) {
        $expected[] = new FeedLink($linkData);
      }
      $this->assertEqualsCanonicalizing($expected, $entryObject->getLinks());
    }
  }

}
