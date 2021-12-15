<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\WebFeeds;

use Sphp\Filters\Inputs\IntegerFilter;
use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Apps\WebFeeds\Readers\Feeds;
use Sphp\Apps\WebFeeds\Readers\Feed;
use Sphp\Apps\WebFeeds\Readers\Entry;

/**
 * The ViewData class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ViewData {

  /**
   * @var string
   */
  private ?string $feedId = null;

  /**
   * @var Feed
   */
  private Feed $currentFeed;
  private array $sliceSizes;

  public function __construct(array $data, array $sliceSizes = [10, 20, 50]) {
    $this->rawData = $data;
    $this->sliceSizes = $sliceSizes;
    foreach ($this->rawData as $data) {
      foreach ($data as $feed) {
        $id = \md5($feed['url']);
        $this->data[$id] = $feed;
      }
    }
    $this->parseData();
  }

  private function parseData(): void {
    $this->feedId = filter_input(INPUT_GET, 'feed', FILTER_SANITIZE_STRING);
    if (!array_key_exists($this->feedId, $this->data)) {
      $this->feedId = array_key_first($this->data);
    }
    $this->currentFeed = Feeds::load($this->data[$this->feedId]['url'], $this->data[$this->feedId]['name']);
  }

  public function getRawData(): array {
    return $this->rawData;
  }

  /**
   * Return slice sizes
   * 
   * @return int[]
   */
  public function getSliceSizes(): array {
    return $this->sliceSizes;
  }

  public function getCurrentFeed(): Feed {
    return $this->currentFeed;
  }

  public function getFeedId(): string {
    return $this->feedId;
  }

  public function getCurrentSliceSize(): int {
    $f = new IntegerFilter(INPUT_GET);
    $f->setDefault(reset($this->sliceSizes));
    $v = $f->filter('size');
    return in_array($v, $this->sliceSizes) ? $v : 10;
  }

  /**
   * 
   * @return Entry[]
   */
  public function getVisibleEntries(): array {
    $entries = $this->currentFeed->toArray();
    $sliceSize = $this->getCurrentSliceSize();
    $part = array_slice($entries, $this->getCurrentSubpage() * $sliceSize, $sliceSize, true);
    return $part;
  }

  public function getCurrentSubpage(): int {
    $numPartitions = $this->getNumPartitions();
    $f = new IntegerFilter(INPUT_GET);
    $f->setRange(0, $numPartitions);
    $f->setDefault(0);
    return $f->filter('p');
  }

  public function getNumPartitions(): int {
    $count = $this->getCurrentFeed()->count();
    $split = $this->getCurrentSliceSize();
    return (int) ceil($count / $split);
  }

  public static function fromYaml(string $param, array $sliceSizes = [10, 20, 50]): ViewData {
    return new static(ParseFactory::fromFile($param), $sliceSizes);
  }

}
