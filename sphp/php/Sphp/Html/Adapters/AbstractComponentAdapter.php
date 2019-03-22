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
use Sphp\Html\Component;

/**
 * Abstract base class for HTML component adapters
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractComponentAdapter extends AbstractContent implements Adapter {

  /**
   * @var Component
   */
  private $component;

  /**
   * Constructor
   * 
   * @param Component $component
   */
  public function __construct(Component $component) {
    $this->component = $component;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->component);
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __clone() {
    $this->component = clone $this->component;
  }

  /**
   * 
   * @return Component
   */
  public function getComponent(): Component {
    return $this->component;
  }

  public function getHtml(): string {
    return $this->component->getHtml();
  }

  public function attributes() {
    return $this->component->attributes();
  }

}
