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
 * Class AtomEntry
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AtomEntry extends AbstractEntry {
 
  private SimpleXMLElement $xml;

  public function __construct(SimpleXMLElement $rawItem) {
    $this->xml = $rawItem;
    // $this->ns = 'atom';
    // $this->xml->registerXPathNamespace($this->ns, 'http://www.w3.org/2005/Atom');
    parent::__construct($rawItem);
  }

  public function __destruct() {
    parent::__destruct();
    unset($this->xml);
  }

  /**
   * Returns the update date of the feed entry
   * 
   * @return ImmutableDateTime the update date of the feed entry
   */
  public function getUpdated(): ImmutableDateTime {
    $daeTime = ImmutableDateTime::from((string) $this->xml->updated);
    return $daeTime;
  }

  public function getId(): string {
    return (string) $this->xml->id;
  }

  protected function parseLinks(): array {
    $links = [];
    foreach ($this->xml->link as $data) {
      $links[] = new FeedLink($data);
    }
    return $links;
  }

}
