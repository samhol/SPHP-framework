<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Documentation\Linkers;

use PHPUnit\Framework\TestCase;
use Sphp\Documentation\Linkers\ApiDocURLBuilder;

/**
 * The ApiDocURLBuilderTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ApiDocURLBuilderTest extends TestCase {

  public function paramMap(): array {
    $params = [];
    $params[] = ['https://www.w3schools.com/tags/tag_a.asp', 'w3schools'];
    $params[] = ['', 'foo'];
    $params[] = ['', ''];
    return $params;
  }

  /**
   * @dataProvider paramMap
   * 
   * @param  string|null $url
   * @param  string $name
   * @return void
   */
  public function testBasicFuctionality(?string $url, string $name): void {
    $gen = new ApiDocURLBuilder($url, $name);
    $this->assertSame($url, $gen->getRootUrl());
    $this->assertSame($name, $gen->getApiname());
    $this->assertSame($url . 'foo', $gen->createUrl('foo'));
    $this->assertSame("{$url}/foo/bar/baz", $gen->createUrl('/foo/%s/%s', 'bar', 'baz'));
    $this->assertSame("{$url}/foo/bar/1", $gen->createUrl('/foo/%s/%d', 'bar', '1'));
  }

}
