<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Adapters;

use Sphp\Html\CssClassifiableContent;

/**
 * Implements an Abstract CSS Class Adapter
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class AbstractCssClassAdapter implements CssClassifiableContent {

  use \Sphp\Html\CssClassifiableTrait,
      \Sphp\Html\ContentTrait;

  /**
   * @var CssClassifiableContent
   */
  private $component;

  /**
   * Constructor
   * 
   * @param ComponentInterface $component
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

  public function cssClasses(): ClassAttribute {
    
  }

  public function getHtml(): string {
    return $this->component->getHtml();
  }

}
