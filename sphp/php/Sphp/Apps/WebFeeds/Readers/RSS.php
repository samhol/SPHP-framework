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
use Sphp\Apps\WebFeeds\Exceptions\RSSException;

/**
 * Class Implements anRRS feed reader
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class RSS extends AbstractFeed {

  private SimpleXMLElement $xml;

  /**
   * @var Item[]
   */
  private array $entries;

  /**
   * Constructor
   * 
   * @param  SimpleXMLElement $xml
   * @param  string|null $name
   * @throws RSSException
   */
  public function __construct(SimpleXMLElement $xml, ?string $name = null) {
    $this->xml = $xml;
    if ($this->xml->channel->count() === 0) {
      throw new RSSException('Malformed RSS feed provided');
    }
    $this->entries = [];
    foreach ($this->xml->channel->item as $data) {
      $this->entries[] = new RSSItem($data);
    }
    parent::__construct($name);
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->xml, $this->entries);
  }

  protected function parseLinks(): array {
    $links = [];
    $nsArr = $this->xml->getDocNamespaces();
    if (array_key_exists('atom', $nsArr)) {
      $this->xml->registerXPathNamespace('atom', 'http://www.w3.org/2005/Atom');
      $linkDataArray = $this->xml->channel->xpath('atom:link | link');
    } else {
      $linkDataArray = $this->xml->channel->xpath('link');
    }
    foreach ($linkDataArray as $data) {
      $links[] = new FeedLink($data);
    }
    return $links;
  }

  public function getUpdated(): ImmutableDateTime {
    $daeTime = ImmutableDateTime::from((string) $this->xml->channel->lastBuildDate);
    return $daeTime;
  }

  public function getLanguage(): string {
    return (string) $this->xml->channel->language;
  }

  public function getTitle(): string {
    return (string) $this->xml->channel->title;
  }

  public function getDescription(): string {
    return (string) $this->xml->channel->description;
  }

  public function getCategory(): string {
    return (string) $this->xml->channel->category;
  }

  public function toArray(): array {
    return $this->entries;
  }

}
