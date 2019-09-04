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

/**
 * Implementation of IconsData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class IconsData implements IteratorAggregate {

  /**
   * @var IconInformation[]
   */
  private $data;

  /**
   * Constructor
   * 
   * @param array $raw raw icon data
   */
  public function __construct(array $raw) {
    $this->data = $raw;
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
    if (array_key_exists($name, $this->data)) {
      return $this->data[$name];
    } else {
      return null;
    }
  }

  /**
   * 
   * @return IconInformation[]
   */
  public function toArray(): array {
    return $this->data;
  }

  /**
   * 
   * @return Traversable new instance of iterator containing the icon data
   */
  public function getIterator(): Traversable {
    return new ArrayIterator($this->data);
  }

}
