<?php

/**
 * Closable.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Containers;

use Sphp\Html\Div;
use Sphp\Html\Foundation\Sites\Core\ClosableInterface;
use Sphp\Html\Foundation\Sites\Buttons\CloseButton;

/**
 * Implements a Foundation Closable.
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ClosableContainer extends Div implements ClosableInterface {

  /**
   * @var CloseButton
   */
  private $closeButton;

  /**
   * Constructs a new instance
   *
   * @param  mixed|null $content added content
   */
  public function __construct($content = null) {
    parent::__construct($content);
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
   * @return $this for a fluent interface
   */
  public function setCloseButton(CloseButton $btn) {
    $this->closeButton = $btn;
    return $this;
  }

  public function setClosable($closable = true) {
    $this->attributes()->set('data-closable', $closable);
    return $this;
  }

  public function isClosable(): bool {
    return $this->attributes()->exists('data-closable');
  }

  public function contentToString(): string {
    $output = parent::contentToString();
    if ($this->isClosable()) {
      $output .= $this->getCloseButton()->getHtml();
    }
    return $output;
  }

}
