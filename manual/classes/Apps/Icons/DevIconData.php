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
 * Implementation of IconData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DevIconData implements IconGroup {

  /**
   * @var array
   */
  private $data;

  public function __construct(array $raw) {
    $this->data = $raw;
  }

  public function getGroupName(): string {
    return $this->data['name'];
  }

  public function getLabel(): string {
    return ucFirst($this->data['name']);
  }

  public function getSearchTerms(): array {
    return $this->data['tags'];
  }

  public function getVersionsFor(string $type): ?array {
    if (array_key_exists($type, $this->data['versions'])) {
      $result = [];
      foreach ($this->data['versions'][$type] as $version) {
        $result [] = "devicon-{$this->getGroupName()}-$version";
      }
      return $result;
    } else {
      return null;
    }
  }

  public function toArray(): array {
    return $this->data;
  }

  public function getIconNames(): array {
    return $this->getVersionsFor('font');
  }

  /**
   * 
   * @return IconData[]
   */
  public function getIcons(): array {
    $icons = [];
    foreach ($this->getIconNames() as $name) {
      $icons[] = new IconData($name, $this->getLabel());
    }
    return $icons;
  }

  public function getIconSetName(): string {
    return 'Devicon';
  }

}
