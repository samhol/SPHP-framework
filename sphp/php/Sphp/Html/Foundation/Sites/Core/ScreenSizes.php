<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Exceptions\OutOfRangeException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Datastructures\Arrayable;
use Traversable;
use Sphp\Stdlib\Datastructures\Collection;

/**
 * Defines Screen Sizes and types and implements screen size parsing functions
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ScreenSizes implements \IteratorAggregate, \Countable, Arrayable {

  /**
   * Foundation screen size names
   *
   * @var string[]
   */
  private $sizes = ['small', 'medium', 'large', 'xlarge', 'xxlarge'];

  /**
   * Constructor
   * 
   * @param array $sizes
   */
  public function __construct(array $sizes = null) {
    if ($sizes !== null) {
      $this->sizes = $sizes;
    }
  }

  /**
   * Returns all screen size names
   * 
   * @return string[] all screen size names
   */
  public function toArray(): array {
    return $this->sizes;
  }

  /**
   * Checks whether the given screen size exists
   * 
   * @param  string $size screen size name
   * @return boolean true if the given size exists
   */
  public function sizeExists(string $size): bool {
    return in_array($size, $this->sizes);
  }

  /**
   * Returns next larger screen size
   * 
   * @param  string $currentSize
   * @return string next larger screen size
   * @throws InvalidArgumentException if given current size does not exist
   * @throws OutOfRangeException the size given is already the smallest
   */
  public function getNextSize(string $currentSize): string {
    $sizes = $this->toArray();
    $key = array_search($currentSize, $sizes);
    if ($key === false) {
      throw new InvalidArgumentException("Screensize '$currentSize' does not exist");
    } else if ($key === count($sizes) - 1) {
      throw new OutOfRangeException("Screensize '$currentSize' has no next larger size");
    } else {
      return $sizes[$key + 1];
    }
  }

  /**
   * Returns previous smaller screen size
   * 
   * @param  string $currentSize
   * @return string previous smaller screen size
   * @throws InvalidArgumentException if given current size does not exist
   * @throws OutOfRangeException the size given is already the smallest
   */
  public function getPreviousSize(string $currentSize): string {
    $sizes = $this->toArray();
    $key = array_search($currentSize, $sizes);
    if ($key === false) {
      throw new InvalidArgumentException("Screensize '$currentSize' does not exist");
    } else if ($key === 0) {
      throw new OutOfRangeException("Screensize '$currentSize' has no previous smaller size");
    } else {
      return $sizes[$key - 1];
    }
  }

  /**
   * Count the number of inserted screen size names
   *
   * @return int the number of inserted screen size names
   * @link   http://php.net/manual/en/class.countable.php Countable
   */
  public function count(): int {
    return count($this->sizes);
  }
  
  public function getIterator(): Traversable {
    return new Collection($this->sizes);
  }
}
