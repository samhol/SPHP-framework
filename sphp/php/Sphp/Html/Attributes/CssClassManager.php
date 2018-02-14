<?php

/**
 * CssClassManager.php (UTF-8)
 * Copyright (c) 2018 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Attributes;

/**
 * Description of CssClassManager
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2018-02-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CssClassManager {

  /**
   * @var ClassAttribute
   */
  private $component;

  /**
   * @var array
   */
  private $rules;

  /**
   * Constructs a new instance
   * 
   * @param CssClassifiableContent $component
   */
  public function __construct(ClassAttribute $component, array $rules = []) {
    $this->component = $component;
    $this->rules = $rules;
  }

  protected function run() {
    foreach ($this->rules as $name => $group) {
      
    }
  }

  /**
   * Destroys the instance
   * 
   * The destructor method will be called as soon as there are no other references 
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->component);
  }

  public function getCompoenet(): CssClassifiableContent {
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
