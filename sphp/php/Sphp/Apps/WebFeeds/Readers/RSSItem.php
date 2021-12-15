<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\WebFeeds\Readers;

use SimpleXMLElement;
use Sphp\DateTime\ImmutableDateTime;

/**
 * Implementation of an RSS feed entry
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class RSSItem extends AbstractEntry {

  private SimpleXMLElement $xml;

  public function __construct(SimpleXMLElement $rawItem) {
    $this->xml = $rawItem;
    parent::__construct($rawItem);
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->xml);
  }

  protected function parseLinks(): array {
    $links = [];
    foreach ($this->xml->link as $data) {
      $links[] = new FeedLink($data);
    }
    return $links;
  }

  public function getTitle(): string {
    return (string) $this->xml->title;
  }

  public function getId(): string {
    return (string) $this->xml->guid;
  }

  /**
   * Returns the update date of the feed entry
   * 
   * @return ImmutableDateTime the update date of the feed entry
   */
  public function getPublication(): ImmutableDateTime {
    $daeTime = ImmutableDateTime::from((string) $this->xml->pubDate);
    return $daeTime;
  }

}
