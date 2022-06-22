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
use Sphp\Html\Lists\Ol;
use Sphp\Bootstrap\Layout\Col;
use Sphp\DateTime\DateTimes;

/**
 * The ReferenceGroup class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ReferenceGroup extends AbstractContent implements ArrayAccess, IteratorAggregate {

  private int $count = 1;
  private string $name;

  /**
   * @var Reference[]
   */
  private array $links;

  /**
   * Constructor
   */
  public function __construct(string $name, ?array $references = null) {
    $this->name = $name;
    $this->links = [];
    if ($references !== null) {
      $this->appendReferences($references);
    }
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->links);
  }

  public function append(Reference $reference) {
    $this->links[] = $reference;
  }

  public function appendReference(string $href, string $content, ?string $retrieved = null): Reference {
    $link = new Reference($href, $content, DateTimes::dateTimeImmutable($retrieved));
    $this->append($link);
    return $link;
  }

  public function appendReferences(iterable $references) {
    foreach ($references as $reference) {
      if ($reference instanceof Reference) {
        $this->append($reference);
      } else if (is_iterable($reference)) {
        $this->appendReference(...$reference);
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
    $aside->addCssClass('card h-100');
    $aside->appendStrong($this->name)->addCssClass('p-2');
    $list = new Ol();
    $aside->append($list);
    foreach ($this->links as $ref) {
      $list->append($ref);
    }
    return $out;
  }

  public function getHtml(): string {
    return $this->createCol()->getHtml();
  }

  public function getIterator(): Traversable {
    yield from $this->links;
  }

  public function offsetExists(mixed $offset): bool {
    return array_key_exists($offset, $this->links);
  }

  public function offsetGet(mixed $offset): mixed {
    
  }

  public function offsetSet(mixed $offset, mixed $value): void {
    
  }

  public function offsetUnset(mixed $offset): void {
    
  }

}
