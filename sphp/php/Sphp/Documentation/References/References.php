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
use Sphp\Html\Navigation\Nav;
use Sphp\DateTime\DateTimes;

/**
 * The References class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class References extends AbstractContent implements ArrayAccess, IteratorAggregate {

  private int $count = 1;

  /**
   * @var Reference[]
   */
  private array $links;

  /**
   * Constructor
   */
  public function __construct() {
    $this->links = [];
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->links);
  }

  public function appendFromData(array $references) {
    foreach ($references as $key => $value) {
      if (array_key_exists('group', $value) && array_key_exists('links', $value)) {
        $this->appendGroupFromData($value['group'], $value['links']);
      }
    }
    return $this;
  }

  public function appendGroupFromData(string $name, array $references): ReferenceGroup {
    $group = new ReferenceGroup($name, $references);
    $this->links[] = $group;

    return $group;
  }

  public function appendReferences(array $references) {
    $ol = new Ol();
    $ol->setStart($this->count);
    foreach ($references as $reference) {
      $this->count++;
      /* echo "<pre>link:";
        print_r($reference);
        echo "</pre>"; */
      $link = new Reference(...$reference);
      $ol->append($link);
    }
    $this->links[] = $ol;
    return $this;
  }

  public function appendLink(string $href, string $content, ?string $retrieved): Reference {
    $link = new Reference($href, $content, DateTimes::dateTimeImmutable($retrieved));
    $this->links[] = $link;
    return $link;
  }

  public function getHtml(): string {
    $out = new Nav();
    $out->appendH2('References and Resources');
    $blockGrid = new \Sphp\Bootstrap\Layout\Row();
    $blockGrid->sm(1);
    if (count($this->links) > 1) {
      $blockGrid->lg(2);
    }
    $blockGrid->addCssClass('g-3');
    $out->append($blockGrid);
    foreach ($this->links as $ref) {
      $blockGrid->appendColumn($ref->createCol());
    }
    return $out->getHtml();
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
