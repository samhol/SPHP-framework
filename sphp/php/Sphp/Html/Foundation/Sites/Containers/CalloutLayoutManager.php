<?php

/**
 * CalloutLayoutManager.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Foundation\Sites\Core\ColourableLayoutManager;
use Sphp\Html\ComponentInterface;

/**
 * Implements a layout manager for Block Grid columns
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/block_grid.html Foundation Block Grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class CalloutLayoutManager extends ColourableLayoutManager {

  /**
   * @var string[]
   */
  private $paddings = ['small', 'large'];

  /**
   * Constructs a new instance
   *
   * @param ComponentInterface $component
   */
  public function __construct(ComponentInterface $component) {
    parent::__construct($component);
    $this->cssClasses()->protect('callout');
  }

  /**
   * Sets the number of columns within the row for different screen sizes
   * 
   * @param  string[] $layouts individual layout settings
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
