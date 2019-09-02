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
class IconsData {

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
      $data[] = new IconsData($iconData);
    }
    return $data;
  }

  public function filterByIconName(string $name) {
    $nameFilter = function(IconData $value)use ($name) {
      return $value->getName() === $name;
    };
    return new Static(array_filter($this->data, $nameFilter));
  }

  public function toArray(): array {
    return $this->data;
  }

}
