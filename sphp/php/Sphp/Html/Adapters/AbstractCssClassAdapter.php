<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Adapters;

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

  use \Sphp\Html\CssClassifiableTrait;

  /**
   * @var CssClassifiableContent
   */
  private $component;

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

  public function getHtml(): string {
    return $this->component->getHtml();
  }

}
