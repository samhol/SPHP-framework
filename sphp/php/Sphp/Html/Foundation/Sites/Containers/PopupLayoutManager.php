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
 * Implements a layout manager for modal popups columns
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/docs/components/block_grid.html Foundation Block Grid
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PopupLayoutManager extends ColourableLayoutManager {

  /**
   * CSS classes corresponding to the sizes
   *
   * @var string[]
   */
  private $sizes = [
      'tiny', 'small', 'large', 'full'
  ];

  /**
   * Constructor
   *
   * @param Component $component
   */
  public function __construct(Component $component) {
    parent::__construct($component);
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
      $this->setSize($layout);
    }
    return $this;
  }

  /**
   * Unsets all layout settings 
   * 
   * @return $this for a fluent interface
   */
  public function unsetLayouts() {
    $this->setSize(null);
    parent::unsetLayouts();
    return $this;
  }

  /**
   * Sets the size of the popup
   *
   * **Available size options:**
   * 
   * * `'tiny'`: set the width to 30%
   * * `'small'`: set the width to 50%
   * * `'large'`: set the width to 90%
   * * `'full'`: set the width and height to 100%
   * 
   * **Note:** Default on `'small'` screens is 100% (`'full'`) width.
   * 
   * @param  string|null $size the size of the component
   * @return $this for a fluent interface
   */
  public function setSize(string $size = null) {
    $this->setOneOf($this->sizes, $size);
    return $this;
  }

}
