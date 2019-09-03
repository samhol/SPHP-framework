<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons;

use Sphp\Stdlib\Datastructures\Collection;

/**
 * Implementation of IconsData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class IconsData implements \IteratorAggregate {

  /**
   * @var IconsData[]
   */
  private $data;

  public function __construct(array $raw) {
    $this->data = $this->parseRaw($raw);
  }

  public function parseRaw(array $raw): array {
    $data = [];
    foreach ($raw as $iconData) {
      $data[$iconData['name']] = new IconData($iconData);
    }
    return $data;
  }

  public function getIcon(string $name): ?IconData {
    if (array_key_exists($name, $this->data)) {
      return $this->data[$name];
    } else {
      return null;
    }
  }

  public function toArray(): array {
    return $this->data;
  }

  public function getIterator(): \Traversable {
    return new \ArrayIterator($this->data);
  }

}
