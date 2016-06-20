<?php

/**
 * VisibilityTrait.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\ComponentInterface as ComponentInterface;
use Sphp\Html\Attributes\MultiValueAttribute as MultiValueAttribute;

/**
 * Class implements {@link Visibility} interface functionality
 * 
 * {@link Visibility} defines Foudation styled CSS border radius settings
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-01-29
 * @link    http://foundation.zurb.com/ Foundation 6
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class VisibilityHandler implements \Sphp\Html\ContentInterface {

  use VisibilityHandlingTrait;

  /**
   * 
   * @var ComponentInterface 
   */
  private $htmlComponent;

  public function __construct(ComponentInterface $htmlComponent) {
    $this->htmlComponent = $htmlComponent;
  }

  /**
   * 
   * @return AttributeManager
   */
  public function attrs() {
    return $this->htmlComponent->attrs();
  }

  /**
   * Returns the class attribute object
   * 
   * @return MultiValueAttribute the class attribute object
   */
  public function cssClasses() {
    return $this->htmlComponent->attrs()->classes();
  }

  public function getHtml() {
    return $this->htmlComponent->getHtml();
  }

}
