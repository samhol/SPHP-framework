<?php

/**
 * ButtonGroup.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\CssClassifiableContent;
use Traversable;

/**
 * Implements a Button Group
 *
 *  Button groups are containers for related action items. They're great for 
 *  displaying a group of actions in a bar.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/sites/docs/button-group.html Foundation Button Groups
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ButtonGroup extends AbstractContainerComponent implements \IteratorAggregate {

  use ButtonTrait;

  /**
   * @var string[]
   */
  private static $stackScreens = ['all', 'small', 'medium'];

  /**
   * Constructs a new instance
   *
   * @param  null|ButtonInterface|ButtonInterface[] $buttons the appended buttons
   */
  public function __construct($buttons = null) {
    parent::__construct('div');
    $this->cssClasses()->protect('button-group');
    if (is_array($buttons)) {
      $this->appendButton($buttons);
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
   * @param  string|null $href the URL of the link
   * @param  string|null $content the content of the button
   * @param  string|null $target the value of the target attribute
   * @return Button created instance
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendHyperlink(string $href, $content, string $target = null): Button {
    $button = Button::hyperlink($href, $content, $target);
    $this->appendButton($button);
    return $button;
  }

  /**
   * Creates and appends a new push button
   * 
   * @param  string|null $content the content of the button
   * @param  string|null $name the value of name attribute
   * @param  string|null $value the value of value attribute
   * @return Button created instance
   * @link   http://www.w3schools.com/tags/att_button_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_button_name.asp name attribute
   */
  public function appendPushButton($content = null): Button {
    $button = Button::pushButton($content);
    $this->appendButton($button);
    return $button;
  }

  /**
   * Creates and appends a new submitter
   * 
   * @param  string|null $content the content of the button
   * @param  string|null $name the value of name attribute
   * @param  string|null $value the value of value attribute
   * @return Button created instance
   * @link   http://www.w3schools.com/tags/att_button_value.asp value attribute
   * @link   http://www.w3schools.com/tags/att_button_name.asp name attribute
   */
  public function appendSubmitter($content = null, $name = null, $value = null): Button {
    $button = Button::submitter($content, $name, $value);
    $this->appendButton($button);
    return $button;
  }

  /**
   * Creates and appends a new submitter
   * 
   * @param  string|null $content the content of the button
   * @return Button created instance
   */
  public function appendResetter($content = null): Button {
    $button = Button::resetter($content);
    $this->appendButton($button);
    return $button;
  }

  /**
   * Appends a new button to the group
   *
   * @param  CssClassifiableContent $button the appended button
   * @return $this for a fluent interface
   */
  public function appendButton(CssClassifiableContent $button) {
    if (!$button->hasCssClass('button')) {
      $button->addCssClass('button');
    }
    $this->getInnerContainer()->append($button);
    return $this;
  }

  /**
   * Create a new iterator to iterate through content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return $this->getInnerContainer()->getIterator();
  }

  /**
   * Stacks the buttons in the given screen sizes
   * 
   * @precondition `$screenSize` == `small|medium|all`
   * @param  string $screenSize the targeted screen size
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the `$screenSize` does not match precondition
   */
  public function stackFor($screenSize = 'all') {
    if (in_array($screenSize, static::$stackScreens)) {
      if ($screenSize == 'all') {
        $this->addCssClass('stacked');
      } else {
        $this->addCssClass("stacked-for-$screenSize");
      }
    } else {
      throw new \InvalidArgumentException("Screen size '$screenSize' was not recognized");
    }
    return $this;
  }

  /**
   * Unstacks the stacked buttons in the given screen sizes
   * 
   * @precondition `$screenSize` == `small|medium|all`
   * @param  string $screenSize the targeted screen size
   * @return $this for a fluent interface
   * @throws \Sphp\Exceptions\InvalidArgumentException if the `$screenSize` does not match precondition
   */
  public function unStackFor($screenSize = 'all') {
    if (in_array($screenSize, static::$stackScreens)) {
      if ($screenSize == 'all') {
        $this->cssClasses()
                ->remove(['stacked', 'stacked-for-small', 'stacked-for-medium']);
      } else {
        $this->cssClasses()
                ->remove("stacked-for-$screenSize");
      }
    } else {
      throw new InvalidArgumentException("Screen size '$screenSize' was not recognized");
    }
    return $this;
  }

}
