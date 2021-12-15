<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\WebFeeds\Readers;

use Sphp\Apps\WebFeeds\Readers\Atom;
use Sphp\Apps\WebFeeds\Readers\AtomEntry;
use PHPUnit\Framework\TestCase;
use Sphp\DateTime\ImmutableDateTime;

/**
 * Implementation of W3schoolsTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class AtomTest extends TestCase {

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
  public function testFeed(string $path): void {
    $xml = simplexml_load_file($path);
    $atom = new Atom($xml);
    $this->assertCount($atom->count(), $atom->toArray());
    $this->assertSame((string) $xml->title, $atom->getTitle());
    $this->assertSame((string) $xml->subtitle, $atom->getSubTitle());
    // var_dump($atom->getLink());
    $xml->registerXPathNamespace('atom', 'http://www.w3.org/2005/Atom');

    $dateString = (string) $xml->updated;
    $date = ImmutableDateTime::from($dateString);
    $this->assertEquals($date, $atom->getUpdated());

    $this->assertEquals($dateString, $atom->getUpdated()->format(\DateTimeInterface::ATOM));
  }

  public function testEntries(): void {
    $xml = simplexml_load_file('./sphp/php/tests/files/atom.xml');
    $atom = new Atom($xml);
    $entries = $atom->toArray();
    $this->assertContainsOnlyInstancesOf(AtomEntry::class, $atom);
    $this->assertContainsOnlyInstancesOf(AtomEntry::class, $entries);
  }

}
