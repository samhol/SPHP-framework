<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons\Data;

/**
 * Implementation of AbstractData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class AbstractData {

  /**
   * @var array
   */
  private $props;

  public function __construct(array $data) {
    $this->props = $data;
  }

  public function __destruct() {
    unset($this->props);
  }
  public function hasProperty(string $name):bool {
    return array_key_exists($name, $this->props);
  }

  public function getProperty(string $name) {
    if (!array_key_exists($name, $this->props)) {
      throw new Exception("$name not present");
    }
    return $this->props[$name];
  }

  public function __get(string $name) {
    return $this->getProperty($name);
  }
  
  public function __isset(string $name):bool {
    return $this->hasProperty($name);
  }

  public function toArray(): array {
    return $this->props;
  }

}
