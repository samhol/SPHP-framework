<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\HtmlAdapters;

use Sphp\Html\AbstractContent;
use Sphp\Html\CssClassifiableContent;
use Sphp\Html\Attributes\ClassAttribute;

/**
 * Implements an Abstract CSS Class Adapter
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AbstractCssClassAdapter extends AbstractContent implements CssClassifiableContent {

  private CssClassifiableContent $component;

  /**
   * Constructor
   * 
   * @param Component $component
   */
  public function __construct(CssClassifiableContent $component) {
    $this->component = $component;
  }

  public function getComponent(): CssClassifiableContent {
    return $this->component;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->component);
  }

  public function cssClasses(): ClassAttribute {
    return $this->component->cssClasses();
  }

  /**
   * Adds the specified CSS class names
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   *
   * 1. A string parameter can contain multiple space separated CSS class names
   * 2. An array parameter can contain only one CSS class name per value
   * 3. Duplicate CSS class names are not stored
   *
   * @param  string ...$cssClasses CSS class names to add
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function addCssClass(string ...$cssClasses) {
    $this->cssClasses()->add(...$cssClasses);
    return $this;
  }

  /**
   * Removes given CSS class names
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   *
   * 1. A string parameter can contain multiple comma separated CSS class names
   * 2. An array parameter can contain only one CSS class name per value
   *
   * @param  string ...$cssClasses CSS class names to remove
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function removeCssClass(string ...$cssClasses) {
    $this->cssClasses()->remove(...$cssClasses);
    return $this;
  }

  /**
   * Determines whether the given CSS class names exists
   *
   * **Important:** Parameter <var>$cssClasses</var> restrictions and rules
   *
   * 1. A string parameter can contain multiple comma separated CSS class names
   * 2. An array parameter can contain only one CSS class name per value
   *
   * @param  string ...$cssClasses CSS class names to search for
   * @return bool true if the given CSS class names exists
   * @link   https://www.w3schools.com/tags/att_global_class.asp class attribute
   */
  public function hasCssClass(string ...$cssClasses): bool {
    return $this->cssClasses()->contains($cssClasses);
  }

  public function getHtml(): string {
    return $this->component->getHtml();
  }

}
