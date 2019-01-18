<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Foundation\Sites\Core\ColourableLayoutManager;
use Sphp\Html\Component;

/**
 * Implements a layout manager for Block Grid columns
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/block_grid.html Foundation Block Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class CalloutLayoutManager extends ColourableLayoutManager {

  /**
   * @var string[]
   */
  private $paddings = ['small', 'large'];

  /**
   * Constructor
   *
   * @param Component $component
   */
  public function __construct(Component $component) {
    parent::__construct($component);
    $this->cssClasses()->protectValue('callout');
  }

  /**
   * Sets the number of columns within the row for different screen sizes
   * 
   * @param  string[],... $layouts individual layout settings
   * @return $this for a fluent interface
   */
  public function setLayouts(...$layouts) {
    $this->unsetLayouts();
    parent::setLayouts($layouts);
    foreach (is_array($layouts) ? $layouts : [$layouts] as $layout) {
      $this->setPadding($layout);
    }
    return $this;
  }

  /**
   * Unsets all layout settings 
   * 
   * @return $this for a fluent interface
   */
  public function unsetLayouts() {
    $this->unsetPaddings();
    parent::unsetLayouts();
    return $this;
  }

  /**
   * Sets the content padding
   * 
   * Predefined paddings:
   * 
   * * `null` for (default) padding
   * * `'small'` for small padding
   * * `'large'` for large padding
   * 
   * @param  string|null $padding optional CSS class name defining the amount of the content padding
   * @return $this for a fluent interface
   * @link   http://foundation.zurb.com/sites/docs/callout.html#sizing Callout Sizing
   */
  public function setPadding(string $padding = null) {
    $this->setOneOf(['small', 'large'], $padding);
    return $this;
  }

  /**
   * Unsets the content padding
   *
   * @return $this for a fluent interface
   */
  public function unsetPaddings() {
    $this->cssClasses()
            ->remove($this->paddings);
    return $this;
  }

}
