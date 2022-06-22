<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Datastructures;

use Countable;
use Iterator;

/**
 * Class PriorityList
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PriorityList implements Iterator, Countable, Arrayable {

  const EXTR_DATA = 0x00000001;
  const EXTR_PRIORITY = 0x00000002;
  const EXTR_BOTH = 0x00000003;

  /**
   * Internal list of all items.
   *
   * @var array[]
   */
  private $items = [];

  /**
   * Serial assigned to items to preserve LIFO.
   *
   * @var int
   */
  private int $serial = 0;

  /**
   * Serial order mode
   * @var integer
   */
  private int $isLIFO = 1;

  /**
   * Internal counter to avoid usage of count().
   *
   * @var int
   */
  private int $count = 0;

  /**
   * Whether the list was already sorted.
   *
   * @var bool
   */
  private bool $sorted = false;

  /**
   * Constructor
   * 
   * @param bool $isLifo
   */
  public function __construct(bool $isLifo = true) {
    $this->items = [];
    $this->isLIFO = $isLifo === true ? 1 : -1;
    $this->sorted = false;
  }

  public function __destruct() {
    unset($this->items);
  }

  /**
   * Insert a new item.
   *
   * @param  string  $name
   * @param  mixed   $value
   * @param  int     $priority
   * @return void
   */
  public function insert(string $name, mixed $value, int $priority = 0): void {
    if (!isset($this->items[$name])) {
      $this->count++;
    }
    $this->sorted = false;
    $this->items[$name] = [
        'data' => $value,
        'priority' => (int) $priority,
        'serial' => $this->serial++,
    ];
  }

  /**
   * @param string $name
   * @param int    $priority
   *
   * @return $this
   *
   * @throws \Exception
   */
  public function setPriority(string $name, int $priority) {
    if (!isset($this->items[$name])) {
      throw new \Exception("item $name not found");
    }

    $this->items[$name]['priority'] = (int) $priority;
    $this->sorted = false;

    return $this;
  }

  /**
   * Remove a item.
   *
   * @param  string $name
   * @return void
   */
  public function contains(string $name): bool {
    return array_key_exists($name, $this->items);
  }

  /**
   * Remove a item.
   *
   * @param  string $name
   * @return void
   */
  public function remove(string $name): void {
    if (isset($this->items[$name])) {
      $this->count--;
    }

    unset($this->items[$name]);
  }

  /**
   * Remove all items.
   *
   * @return void
   */
  public function clear(): void {
    $this->items = [];
    $this->serial = 0;
    $this->count = 0;
    $this->sorted = false;
  }

  /**
   * Get a item.
   *
   * @param  string $name
   * @return mixed
   */
  public function get(string $name) {
    $item = null;
    if (isset($this->items[$name])) {
      $item = $this->items[$name]['data'];
    }
    return $item;
  }

  /**
   * Sort all items.
   *
   * @return void
   */
  protected function sort(): void {
    if (!$this->sorted) {
      uasort($this->items, [$this, 'compare']);
      $this->sorted = true;
    }
  }

  /**
   * Compare the priority of two items.
   *
   * @param  array $item1
   * @param  array $item2
   * @return int
   */
  protected function compare(array $item1, array $item2): int {
    return ($item1['priority'] === $item2['priority']) ?
            ($item1['serial'] > $item2['serial'] ? -1 : 1) * $this->isLIFO :
            ($item1['priority'] > $item2['priority'] ? -1 : 1);
  }

  /**
   * Get serial order mode
   *
   * @return bool
   */
  public function isLIFO(): bool {
    return 1 === $this->isLIFO;
  }

  /**
   *
   * @return void
   */
  public function rewind(): void {
    $this->sort();
    reset($this->items);
  }

  /**
   * {@inheritDoc}
   */
  public function current(): mixed {
    $this->sorted || $this->sort();
    $node = current($this->items);
    return $node ? $node['data'] : false;
  }

  /**
   * {@inheritDoc}
   */
  public function key(): mixed {
    $this->sorted || $this->sort();
    return key($this->items);
  }

  /**
   * {@inheritDoc}
   */
  public function next() {
    $node = next($this->items);
    return $node ? $node['data'] : false;
  }

  /**
   * {@inheritDoc}
   */
  public function valid(): bool {
    return current($this->items) !== false;
  }

  /**
   * {@inheritDoc}
   */
  public function count(): int {
    return $this->count;
  }

  /**
   * Return list as array
   *
   * @param  int $flag 
   * @return array
   */
  public function toArray($flag = self::EXTR_DATA): array {
    $this->sort();

    if ($flag == self::EXTR_BOTH) {
      return $this->items;
    }

    return array_map(
            function ($item) use ($flag) {
              return ($flag == PriorityList::EXTR_PRIORITY) ? $item['priority'] : $item['data'];
            },
            $this->items
    );
  }

}
