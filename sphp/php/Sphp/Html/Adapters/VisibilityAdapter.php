<?php


/**
 * VisibilityAdapter.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Adapters;

use Sphp\Html\ContentInterface;
use Sphp\Html\ComponentInterface;

/**
 * Description of VisibilityAdapter
 *
 * @author Sami Holck
 */
class VisibilityAdapter implements ContentInterface {

  //put your code here
  use \Sphp\Html\ContentTrait;

  private $component;

  public function __construct(ComponentInterface $component) {
    $this->component = $component;
  }

  /**
   * Sets whether the component is in use or not
   *
   * @param  boolean $hide true if the button is in use, false otherwise
   * @return self for PHP Method Chaining
   */
  public function setHidden($hide = true) {
    if (!$hide) {
      $this->unhide();
    } else {
      $this->hide();
    }
    return $this;
  }

  /**
   * Hides the component from the document
   *
   * **Note:**
   *
   * The element will not be displayed at all (has no effect on layout). Adds
   * an inline style property `display: none;` to the component.
   *
   * @return self for PHP Method Chaining
   */
  public function hide() {
    $this->component->inlineStyles()->setProperty('display', 'none');
    return $this;
  }

  /**
   * Unhides the component (Removes the inline hiding property)
   *
   * **Notes:**
   *
   *  Removes only inline style property `display: hidden;` . The component
   *  might still be defined as hidden in CSS style sheets or by a JavaScript command.
   *
   * @return self for PHP Method Chaining
   */
  public function unhide() {
    if ($this->component->inlineStyles()->getProperty('display') === 'none') {
      $this->component->inlineStyles()->unsetProperty('display');
    }
    return $this;
  }

  public function getHtml() {
    return $this->component->getHtml();
  }

}
