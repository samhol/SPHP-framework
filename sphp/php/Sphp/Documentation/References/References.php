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
use Sphp\Html\Navigation\Nav;
use Sphp\Documentation\Linkers\Html\W3schoolsURLs;
use Sphp\DateTime\Date;
use DateTimeInterface;

/**
 * The References class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class References extends AbstractContent implements ArrayAccess, IteratorAggregate {

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
    foreach ($references as $ref) {
      if (is_iterable($ref)) {
        $this->setRef(...$ref);
      } else if ($ref instanceof Reference) {
        $this->set($ref);
      }
    }
    return $this;
  }

  public function groupExists(string $group): bool {
    return array_key_exists($group, $this->links);
  }

  public function setW3SchoolsReference(string $element, Date|DateTimeInterface|string|null $retrieved = null) {
    $urlBuilder = new W3schoolsURLs();
    if (str_starts_with($element, '[') && str_ends_with($element, ']')) {
      $attr = trim($element, '[]');
      $text = "HTML $attr attribute";
    } else {
      $text = "HTML &lt;$element&gt; tag";
    }
    $ref = new Reference($urlBuilder($element), $text, $retrieved);
    $this->set($ref);
    return $this;
  }

  public function set(Reference $ref) {
    if (!$this->groupExists($group = $ref->getGroup())) {
      $this->links[$group] = new ReferenceGroup($group);
    }
    $this->links[$group]->set($ref);
  }

  public function setRef(string $href, string $content, Date|DateTimeInterface|string|null $retrieved = null): Reference {
    $ref = new Reference($href, $content, $retrieved);
    $this->set($ref);
    return $ref;
  }

  public function setPHPManualRef(string $item, Date|DateTimeInterface|string|null $retrieved = null): Reference {
    $php = new \Sphp\Documentation\Linkers\PHP\PHPManual\PHPManualURLs();
    $url = $php->build($item);
    return $this->setRef($url, $item, $retrieved);
  }

  public function getHtml(): string {
    $out = new Nav();
    $out->appendH2('References and Resources');
    $blockGrid = new \Sphp\Bootstrap\Layout\Row();
    $blockGrid->default(1);
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
