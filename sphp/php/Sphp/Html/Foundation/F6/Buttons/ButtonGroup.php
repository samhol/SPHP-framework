<?php

/**
 * ButtonGroup.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Buttons;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Lists\Li as Li;
use Sphp\Core\Types\BitMask as BitMask;
use Sphp\Html\Foundation\F6\Core\Screen as Screen;

/**
 * Class implements a Foundation Button Group
 *
 *  Button groups are containers for related action items. They're great for 
 *  displaying a group of actions in a bar.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-25
 * @version 2.0.1
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/button_groups.html Foundation Button Groups
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ButtonGroup extends AbstractComponent implements \IteratorAggregate {

  use ButtonTrait;

  /**
   * Constructs a new instance
   *
   * @param  null|ButtonInterface|ButtonInterface[] $buttons the appended buttons
   */
  public function __construct($buttons = null) {
    parent::__construct("div");
    $this->lockCssClass("button-group");
    if (is_array($buttons)) {
      $this->appendButtons($buttons);
    }
    if ($buttons instanceof ButtonInterface) {
      $this->appendButton($buttons);
    }
  }

  /**
   * Creates and appends a new {@link HyperlinkButton} to the group
   *
   * **Notes:**
   * 
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the implemented &lt;a&gt; tag is not a hyperlink in HTML5.
   * * If the $content is empty, the $href is also the content of the object.
   * 
   * @param  string $href the URL of the link
   * @param  string $content the content of the button
   * @param  string $target the value of the target attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendLink($href, $content, $target = "_self") {
    $this->appendButton(new HyperlinkButton($href, $content, $target));
    return $this;
  }

  /**
   * Creates and appends a new {@link FormButton} to the group
   * 
   * **Important!**
   *
   * Parameter `mixed $content` can be of any type that converts to a
   * string. So also an object of any class that implements magic method
   * `__toString()` is allowed.
   *
   * @param  mixed $content the content of the button tag
   * @param  string $type the value of type attribute
   * @param  string $name the value of name attribute
   * @param  string $value the value of value attribute
   * @link   http://www.w3schools.com/tags/att_button_type.asp type attribute
   * @link   http://www.w3schools.com/tags/att_button_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_button_value.asp value attribute
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function appendFormButton($content = null, $type = null, $name = null, $value = null) {
    $this->appendButton(new FormButton($content, $type, $name, $value));
    return $this;
  }

  /**
   * Appends a button to the group
   *
   * @param  ButtonInterface $button the appended button
   * @return self for PHP Method Chaining
   */
  public function appendButton(ButtonInterface $button) {
    $this->content()->append($button);
    return $this;
  }

  /**
   * Appends aa array of buttons to the group
   *
   * @param  ButtonInterface[] $buttons the appended buttons
   * @return self for PHP Method Chaining
   */
  public function appendButtons(array $buttons) {
    foreach ($buttons as $button) {
      $this->appendButton($button);
    }
    return $this;
  }

  /**
   * Returns a new iterator to iterate through inserted {@link ButtonInterface} components
   *
   * @return \ArrayIterator iterator to iterate through inserted {@link ButtonInterface} components
   */
  public function getIterator() {
    return $this->content()->getIterator();
  }

  /**
   * Stacks the buttons in the given screen sizes
   * 
   * @param  int $targetScreens the targeted screensizes as a bitmask
   * @return self for PHP Method Chaining
   */
  public function stack($targetScreens = Screen::ALL_SIZES) {
    $flags = new BitMask($targetScreens);
    if ($flags->contains(Screen::ALL_SIZES)) {
      $this->addCssClass("stacked");
    } else {
      if ($flags->contains(Screen::SMALL)) {
        $this->addCssClass("stacked-for-small");
      }
      if ($flags->contains(Screen::MEDIUM)) {
        $this->addCssClass("stacked-for-medium");
      }
      if ($flags->contains(Screen::LARGE)) {
        $this->addCssClass("stacked-for-large");
      }
    }
    return $this;
  }

  /**
   * Unstacks the stacked buttons in the given screen sizes
   * 
   * @param  int $targetScreens the targeted screensizes as a bitmask
   * @return self for PHP Method Chaining
   */
  public function unStack($targetScreens = Screen::ALL_SIZES) {
    $flags = new BitMask($targetScreens);
    if ($flags->contains(Screen::ALL_SIZES)) {
      $this->removeCssClass("stacked");
    } else {
      if ($flags->contains(Screen::SMALL)) {
        $this->removeCssClass("stacked-for-small");
      }
      if ($flags->contains(Screen::MEDIUM)) {
        $this->removeCssClass("stacked-for-medium");
      }
      if ($flags->contains(Screen::LARGE)) {
        $this->removeCssClass("stacked-for-large");
      }
    }
    return $this;
  }

}
