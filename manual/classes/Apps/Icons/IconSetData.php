<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons;

use IteratorAggregate;
use Traversable;
use ArrayIterator;
use Sphp\Stdlib\Datastructures\Collection;

/**
 * Implementation of IconsData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class IconSetData implements IteratorAggregate {

  /**
   * @var Collection
   */
  private $data;

  /**
   * Constructor
   * 
   * @param array $raw raw icon data
   */
  public function __construct(iterable $raw) {
    $this->data = new Collection($raw);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->data);
  }

  /**
   * 
   * @param  string $name
   * @return IconInformation|null
   */
  public function getIcon(string $name): ?IconInformation {
    if ($this->data->offsetExists($name)) {
      return $this->data[$name];
    } else {
      return null;
    }
  }

  public function filter(callable $callback) {
    return new static($this->data->filter($callback)->toArray());
  }

  /**
   * 
   * @return IconInformation[]
   */
  public function toArray(): array {
    return $this->data->toArray();
  }

  /**
   * 
   * @return Traversable new instance of iterator containing the icon data
   */
  public function getIterator(): Traversable {
    return new ArrayIterator($this->data->toArray());
  }

}
