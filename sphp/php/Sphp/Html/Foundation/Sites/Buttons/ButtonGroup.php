<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\AbstractComponent;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Html\CssClassifiableContent;
use IteratorAggregate;
use Traversable;
use Sphp\Html\Iterator;
use Sphp\Stdlib\Arrays;

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
class ButtonGroup extends AbstractComponent implements IteratorAggregate {

  use \Sphp\Html\ComponentTrait,
      ButtonTrait;

  /**
   * @var ButtonInterface[] 
   */
  private $buttons;

  /**
   * @var string[]
   */
  private static $stackScreens = ['all', 'small', 'medium'];

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('div');
    $this->cssClasses()->protectValue('button-group');
    $this->buttons = [];
  }

  public function __destruct() {
    unset($this->buttons);
    parent::__destruct();
  }

  public function __clone() {
    parent::__clone();
    $this->buttons = Arrays::copy($this->buttons);
  }

  /**
   * Creates and appends a new  hyperlink button to the group
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
   * Creates and appends a new resetter 
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
   * @return ButtonInterface created instance
   */
  public function appendButton(CssClassifiableContent $button): ButtonInterface {
    if (!$button instanceof ButtonInterface) {
      $button = new Button($button);
    }
    $this->buttons[] = $button;
    return $button;
  }

  /**
   * Appends a new arrow only button to the group
   *
   * @param string $screenReaderLabel the screen reader label text
   * @return ArrowOnlyButton created instance
   */
  public function appendArrowOnlyButton(string $screenReaderLabel): ArrowOnlyButton {
    $btn = new ArrowOnlyButton($screenReaderLabel);
    $this->appendButton($btn);
    return $btn;
  }

  /**
   * Create a new iterator to iterate through content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new Iterator($this->buttons);
  }

  /**
   * Stacks the buttons in the given screen sizes
   * 
   * @precondition `$screenSize` == `small|medium|all`
   * @param  string $screenSize the targeted screen size
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the `$screenSize` does not match precondition
   */
  public function stackFor($screenSize = 'all') {
    if (in_array($screenSize, static::$stackScreens)) {
      $this->setExtended(false);
      if ($screenSize == 'all') {
        $this->addCssClass('stacked');
      } else {
        $this->addCssClass("stacked-for-$screenSize");
      }
    } else {
      throw new InvalidArgumentException("Screen size '$screenSize' was not recognized");
    }
    return $this;
  }

  /**
   * Unstacks the stacked buttons in the given screen sizes
   * 
   * @precondition `$screenSize` == `small|medium|all`
   * @param  string $screenSize the targeted screen size
   * @return $this for a fluent interface
   * @throws InvalidArgumentException if the `$screenSize` does not match precondition
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

  public function contentToString(): string {
    return implode($this->buttons);
  }

}
