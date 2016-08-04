<?php

/**
 * VisibilityHandler.php (UTF-8)
 * Copyright (c) 2015 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Core;

use Sphp\Html\ContentInterface as ContentInterface;
use Sphp\Html\ComponentInterface as ComponentInterface;
use Sphp\Html\ContentTrait as ContentTrait;
use Sphp\Html\Attributes\MultiValueAttribute as MultiValueAttribute;

/**
 * Class implements {@link VisibilityInterface} interface functionality
 * 
 * {@link VisibilityInterface} defines Foudation styled CSS visibility settings
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2015-01-29
 * @link    http://foundation.zurb.com/ Foundation 6
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class VisibilityHandler implements ContentInterface, VisibilityHandlingInterface {

  use VisibilityHandlingTrait,
      ContentTrait;

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
   * Returns the class attribute object
   * 
   * @return MultiValueAttribute the class attribute object
   */
  public function cssClasses() {
    return $this->htmlComponent->attrs()->classes();
  }

  /**
   * {@inheritdoc}
   */
  public function getHtml() {
    return $this->htmlComponent->getHtml();
  }

}
