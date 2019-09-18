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
 * Implementation of IconData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DeviconGroupData extends IconGroupData {


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
  /**
   * 
   * @return IconData[]
   */
  public function getIcons(): array {
    $icons = [];
    $iconData['factoryName'] = $this->getProperty('factoryName');
    $iconData['factory'] = $this->getProperty('factory');
    $iconData['name'] = $this->getProperty('name');
    $iconData['label'] = $this->getProperty('label');
    $iconData['searchTerms'] = $this->getProperty('searchTerms');
    foreach ($this->getProperty('font') as $style) {
      $iconData['type'] = 'font';
      $iconData['style'] = $style;
      $icons[] = new DeviconData($iconData);
    }
    foreach ($this->getProperty('svg') as $style) {
      $iconData['type'] = 'svg';
      $iconData['style'] = $style;
      $icons[] = new DeviconData($iconData);
    }
    return $icons;
  }


}
