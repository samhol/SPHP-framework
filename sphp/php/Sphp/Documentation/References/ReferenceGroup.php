<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\References;

use Sphp\Html\AbstractContent;
use ArrayAccess;
use IteratorAggregate;
use Traversable;
use Sphp\Bootstrap\Layout\Col;

/**
 * The ReferenceGroup class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ReferenceGroup extends AbstractContent implements ArrayAccess, IteratorAggregate {

  private string $name;

  /**
   * @var Reference[]
   */
  private array $refs;

  /**
   * Constructor
   */
  public function __construct(string $name, ?array $references = null) {
    $this->name = $name;
    $this->refs = [];
    if ($references !== null) {
      $this->setReferences($references);
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->refs);
  }

  public function set(Reference $reference) {
    $this->refs[$reference->getHref()] = $reference;
  }

  public function setReference(string $href, string $content, string|\DateTimeInterface|null $retrieved = null): Reference {
    $ref = new Reference($href, $content, $retrieved);
    $this->set($ref);
    return $ref;
  }

  public function setReferences(iterable $references) {
    foreach ($references as $reference) {
      if ($reference instanceof Reference) {
        $this->set($reference);
      } else if (is_iterable($reference)) {
        $this->setReference(...$reference);
      } else {
        echo 'err';
        echo "<pre>link:";
        print_r($reference);
        echo "</pre>";
      }
    }
    return $this;
  }

  public function createCol(): Col {
    $out = new Col();
    $aside = $out->content()->appendDiv();
    $aside->addCssClass('card h-100 reference-group');
    $aside->appendStrong($this->name)->addCssClass('p-2');
    $linkContainer = $aside->appendDiv();
    $linkContainer->addCssClass('mx-2 mb-3');
    foreach ($this->refs as $ref) {
      $linkContainer->append($ref);
    }
    return $out;
  }

  public function getHtml(): string {
    return $this->createCol()->getHtml();
  }

  public function getIterator(): Traversable {
    yield from $this->refs;
  }

  public function offsetExists(mixed $offset): bool {
    return array_key_exists($offset, $this->refs);
  }

  public function offsetGet(mixed $offset): mixed {
    
  }

  public function offsetSet(mixed $offset, mixed $value): void {
    
  }

  public function offsetUnset(mixed $offset): void {
    
  }

  public static function parseGroupName(string $href): string {
    $url = new \Sphp\Network\URL($href);
    $host = $url->getHost();
    $path = $url->getPath();
    if ($host !== null) {
      $name = str_replace('www.', '', $host);
    } else {
      $name = $url->getPath();
    }
    if ($name === 'playground.samiholck.fi') {
      $name = 'SPHPlayground';
    } else if ($name === 'developer.mozilla.org') {
      $name = 'MDN Web Docs';
    } else if ($name === 'github.com') {
      $name = 'GitHub';
    } else if ($name === 'gnu.org') {
      $name = 'GNU Project';
    } else if (str_ends_with($name, 'wikipedia.org')) {
      $name = 'Wikipedia.org';
    } else if ($name === 'postgresql.org') {
      $name = 'PostgreSQL';
    } else if ($name === 'w3schools.com') {
      $name = 'w3schools.com';
    } else if ($name === 'php.net' && str_contains($path, 'manual')) {
      $name = 'PHP Manual';
    } else {
       $name = 'Misc';
    }
    return $name;
  }

}
