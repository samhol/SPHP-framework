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
class FontAwesomeIconGroup implements IconGroup {

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

  public function getGroupName(): string {
    return $this->name;
  }

  public function getLabel(): string {
    return $this->data['label'];
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

  public function toArray(): array {
    return $this->data;
  }

  public function getIconNames(): array {
    $names = [];
    $typeMap = ['solid' => 'fas', 'regular' => 'far', 'brands' => 'fab'];
    foreach ($this->getStyles() as $styleName) {
      $style = $typeMap[$styleName];
      $names[] = "$style fa-{$this->getGroupName()}";
    }
    return $names;
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
    return 'Font Awesome';
  }

}
