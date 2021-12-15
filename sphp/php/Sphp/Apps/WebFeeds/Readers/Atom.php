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

use Sphp\Apps\WebFeeds\Exception\RSSException;
use SimpleXMLElement;
use Sphp\DateTime\ImmutableDateTime;

/**
 * Implementation of an Atom feed entry
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Atom extends AbstractFeed {

  private SimpleXMLElement $xml;

  /**
   * @var Item[]
   */
  private array $entries;

  /**
   * Constructor
   * 
   * @param  SimpleXMLElement $xml
   * @param  string $name
   * @throws RSSException
   */
  public function __construct(SimpleXMLElement $xml, string $name = null) {
    $this->xml = $xml;
    $this->xml->registerXPathNamespace('atom', 'http://www.w3.org/2005/Atom');
    $this->entries = [];
    foreach ($this->xml->entry as $data) {
      $this->entries[] = new AtomEntry($data);
    }
    parent::__construct($name);
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->xml, $this->entries);
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

  public function getSubTitle(): string {
    return (string) $this->xml->subtitle;
  }

  public function getUpdated(): ImmutableDateTime {
    $daeTime = ImmutableDateTime::from((string) $this->xml->updated);
    return $daeTime;
  }

  public function toArray(): array {
    return $this->entries;
  }

}
