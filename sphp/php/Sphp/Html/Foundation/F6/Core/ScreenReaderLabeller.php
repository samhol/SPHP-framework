<?php

/**
 * ScreenReaderLabeller.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\Attributes\MultiValueAttribute as MultiValueAttribute;
use InvalidArgumentException;

/**
 * Trait implements {@link ScreenReaderLabelable} interface functionality
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-01-29
 * @link    http://foundation.zurb.com/ Foundation 6
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ScreenReaderLabeller implements \Sphp\Html\ContentInterface {
use \Sphp\Html\ContentTrait;
  /**
   * 
   * @var ComponentInterface 
   */
  private $htmlComponent;

  /**
   * 
   * @param ComponentInterface $htmlComponent
   */
  public function __construct(ComponentInterface $htmlComponent) {
    $this->htmlComponent = $htmlComponent;
  }


  /**
   * Returns and optionally sets the inner label for screen reader text
   * 
   * @param  ScreenReaderLabel|null new optional inner label for screen reader text
   * @return ScreenReaderLabel the inner label for screen reader text
   */
  public function getScreeReaderLabel(ScreenReaderLabel $label = null) {
    
  }

  public function getHtml() {
    return $this->htmlComponent->getHtml();
  }

}
