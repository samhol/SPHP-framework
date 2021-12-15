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

use IteratorAggregate;
use Traversable;
use ArrayIterator;

/**
 * The AbstractFeed class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractFeed implements IteratorAggregate, Feed {

  /**
   * @var string
   */
  private string $name;

  /**
   * @var Link[]
   */
  private array $links;

  /**
   * Constructor
   * 
   * @param string|null $name
   */
  public function __construct(?string $name = null) {
    if ($name === null) {
      $name = $this->getTitle();
    }
    $this->name = $name;
    $this->links = $this->parseLinks();
  }

  public function __destruct() {
    unset($this->links);
  }

  /**
   * Parses all the links
   * 
   * @return Link[] the links
   */
  abstract protected function parseLinks(): array;

  public function getName(): string {
    return $this->name;
  }

  public function count(): int {
    return count($this->toArray());
  }

  public function getIterator(): Traversable {
    return new ArrayIterator($this->toArray());
  }

  public function getLinks(): array {
    return $this->links;
  }

  public function getSelfLink(): ?Link {
    $selfLinks = $this->getLinksByRel('self');
    if (!empty($selfLinks)) {
      $out = array_shift($selfLinks);
    } else {
      $out = null;
    }
    return $out;
  }

  public function getAlternativeLink(): ?Link {
    $selfLinks = $this->getLinksByRel('alternate');
    if (empty($selfLinks)) {
      $selfLinks = $this->getLinksByRel(null);
    }
    if (!empty($selfLinks)) {
      $out = array_shift($selfLinks);
    } else {
      $out = null;
    }
    return $out;
  }

  public function getLinksByRel(?string ...$rel): array {
    return array_filter($this->getLinks(), function (Link $val) use ($rel) {
      return in_array($val->getRel(), $rel, true);
    });
  }

}
