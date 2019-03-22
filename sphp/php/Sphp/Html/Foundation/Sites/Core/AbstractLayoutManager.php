<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Core;

use Sphp\Html\AbstractContent;
use Sphp\Html\Attributes\ClassAttribute;
use Sphp\Html\CssClassifiableContent;

/**
 * Implements an abstract layout manager for responsive HTML components
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/grid.html Foundation grid
 * @link    http://foundation.zurb.com/grid.html Foundation grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractLayoutManager extends AbstractContent implements LayoutManager {

  /**
   * @var CssClassifiableContent
   */
  private $component;

  /**
   * Constructor
   * 
   * @param CssClassifiableContent $component
   */
  public function __construct(CssClassifiableContent $component) {
    $this->component = $component;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->component);
  }

  public function getComponent(): CssClassifiableContent {
    return $this->component;
  }

  /**
   * Returns the class attribute object
   * 
   * @return ClassAttribute the class attribute object
   */
  public function cssClasses(): ClassAttribute {
    return $this->component->cssClasses();
  }

  /**
   * 
   * @param  array $group
   * @param  string $value
   * @return $this for a fluent interface
   */
  protected function setOneOf(array $group, string $value = null) {
    if ($value === null) {
      $this->cssClasses()->remove($group);
    } else if (in_array($value, $group)) {
      $this->cssClasses()->remove($group)->add($value);
    }
    return $this;
  }

  public function getHtml(): string {
    return $this->component->getHtml();
  }

}
