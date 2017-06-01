<?php

/**
 * Closable.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\ComponentInterface;
use Sphp\Html\ContainerComponentInterface;
use Sphp\Html\Foundation\Sites\Buttons\CloseButton;

/**
 * Implements a Foundation Equalizer.
 *
 * Equalizer makes it dead simple to gives multiple items equal height.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-04-28
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Closable extends \Sphp\Html\AbstractContainerTag {

  /**
   *
   * @var CloseButton
   */
  private $closeButton;

  /**
   * Constructs a new instance
   *
   * @param  string $tagname the name of the tag
   * @param  AttributeManager|null $attrManager the attribute manager of the component
   * @param  ContainerInterface|null $contentContainer the inner content container of the component
   */
  public function __construct($tagname, AttributeManager $attrManager = null, ContainerInterface $contentContainer = null) {
    parent::__construct($tagname, $attrManager, $contentContainer);
    $this->closeButton = new CloseButton();
  }

  /**
   * Returns the Modal reveal controller
   * 
   * @return CloseButton
   */
  public function getCloseButton() {
    return $this->closeButton;
  }

  /**
   * Returns the Modal reveal controller
   * 
   * @return CloseButton
   */
  public function setCloseButton(CloseButton $btn) {
    $this->closeButton = $btn;
    return $this;
  }

  public function contentToString(): string {
    $this->closeButton->getHtml() . parent::contentToString();
  }

}
