<?php

/**
 * PopupLayoutManager.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Foundation\Sites\Core\ColourableLayoutManager;
use Sphp\Html\ComponentInterface;

/**
 * Implements a layout manager for modal popups columns
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-02-13
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/docs/components/block_grid.html Foundation Block Grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
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
   * Constructs a new instance
   *
   * @param ComponentInterface $component
   */
  public function __construct(ComponentInterface $component) {
    parent::__construct($component);
  }

  /**
   * Sets the number of columns within the row for different screen sizes
   * 
   * @param  string[] $layouts individual layout settings
   * @return self for a fluent interface
   */
  public function setLayouts($layouts) {
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
   * @return self for a fluent interface
   */
  public function unsetLayouts() {
    $this->unsetSizing();
    parent::unsetLayouts();
    return $this;
  }

  /**
   * Sets the content padding
   * 
   * Predefined paddings:
   * 
   * * `'small'` for small padding
   * * `'default'` for (default) padding
   * * `'large'` for large padding
   * 
   * @param  string|null $size optional CSS class name defining the amount of the content padding
   * @return self for a fluent interface
   * @link   http://foundation.zurb.com/sites/docs/callout.html#sizing Callout Sizing
   */
  public function setSize($size) {
    if (in_array($size, $this->paddings)) {
      $this->unsetSizing();
      $this->addCssClass($size);
    }
    return $this;
  }

  /**
   * Unsets the content padding
   *
   * @return self for a fluent interface
   */
  public function unsetSizing() {
    $this->cssClasses()
            ->remove(self::$sizes);
    return $this;
  }

}
