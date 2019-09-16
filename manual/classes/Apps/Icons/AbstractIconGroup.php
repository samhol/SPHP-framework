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
 * Implementation of AbstractIconGroup
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractIconGroup implements \IteratorAggregate, IconGroup{

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
      $icons[] = new IconData($name, $this->getLabel(), $this->getFactoryClass());
    }
    return $icons;
  }

  public function count(): int {
    return count($this->getIconNames());
  }
  
  public function getIterator():\Traversable {
    return new \ArrayIterator($this->getIcons());
  }
  
  public function getFactoryClass(): string {
    return \Sphp\Html\Media\Icons\IconFactory::class;
  }

}
