<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons;

/**
 * Implementation of FaIconInformation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FaIconInformation implements IconInformation {

  /**
   * @var string
   */
  private $name;

  /**
   * @var array
   */
  private $data;

  public function __construct(string $name, array $raw) {
    $this->name = $name;
    $this->data = $raw;
  }

  public function getName(): string {
    return $this->name;
  }

  public function getSearchTerms(): array {
    return $this->data['search']['terms'];
  }
  public function getStyles(): array {
    return $this->data['styles'];
  }
  public function getUnicode(): string {
    return $this->data['unicode'];
  }

  public function getVersionsFor(string $type): array {
    $result = [];
    if (array_key_exists($type, $this->data['versions'])) {
      foreach ($this->data['versions'][$type] as $version) {
        $result [] = "devicon-{$this->getName()}-$version";
      }
    }
    return $result;
  }

  public function toArray(): array {
    return $this->data;
  }

}
