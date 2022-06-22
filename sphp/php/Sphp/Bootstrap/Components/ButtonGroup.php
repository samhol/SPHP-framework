<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Bootstrap\Components;

use Sphp\Html\AbstractComponent;
use Sphp\Html\PlainContainer;
use IteratorAggregate;
use Traversable;
use Sphp\Html\Navigation\A;
use Sphp\Html\Component; 
use Sphp\Html\Forms\Buttons\PushButton;
use Sphp\Html\Forms\Buttons\SubmitButton;
use Sphp\Html\Forms\Buttons\ResetButton;

/**
 * Implements a Button Group
 *
 *  Button groups are containers for related action items. They're great for 
 *  displaying a group of actions in a bar.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://foundation.zurb.com/ Foundation
 * @link    https://foundation.zurb.com/sites/docs/button-group.html Foundation Button Groups
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ButtonGroup extends AbstractComponent implements IteratorAggregate {

  /**
   * @var ButtonInterface[] 
   */
  private $buttons;

  /**
   * @var string[]
   */
  private static $stackScreens = ['all', 'small', 'medium'];
  private PlainContainer $container;

  /**
   * Constructor
   *
   * @param string $ariaLabel
   */
  public function __construct(string $ariaLabel = null) {
    parent::__construct('div');
    $this->container = new PlainContainer();
    $this->cssClasses()->protectValue('btn-group');
    $this->attributes()->protect('role', 'group');
    $this->setAttribute('aria-label', $ariaLabel);
  }

  public function setAriaLabel(string $ariaLabel = null) {
    $this->setAttribute('aria-label', $ariaLabel);
    return $this;
  }

  public function setStyle(string ...$class) {
    $this->addCssClass(...$class);
    return $this;
  }

  public function __destruct() {
    unset($this->container);
  }

  public function __clone() {
    $this->container = clone $this->container;
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
   * @return A created instance
   * @link   https://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   https://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendHyperlink(string $href, $content, string $target = null): A {
    $button = new A($href, $content, $target);
    $this->appendButton($button);
    return $button;
  }

  /**
   * Creates and appends a new push button
   * 
   * @param  string|null $content the content of the button
   * @return PushButton created instance
   * @link   https://www.w3schools.com/tags/att_button_value.asp value attribute
   * @link   https://www.w3schools.com/tags/att_button_name.asp name attribute
   */
  public function appendPushButton($content = null): PushButton {
    $button = new PushButton($content);
    $button->addCssClass('btn');
    $this->appendButton($button);
    return $button;
  }

  /**
   * Creates and appends a new submitter
   * 
   * @param  string|null $content the content of the button
   * @param  string|null $name the value of name attribute
   * @param  string|null $value the value of value attribute
   * @return SubmitButton created instance
   * @link   https://www.w3schools.com/tags/att_button_value.asp value attribute
   * @link   https://www.w3schools.com/tags/att_button_name.asp name attribute
   */
  public function appendSubmitter($content = null, $name = null, $value = null): SubmitButton {
    $button = new SubmitButton($content, $name, $value);
    $this->appendButton($button);
    return $button;
  }

  /**
   * Creates and appends a new resetter 
   * 
   * @param  string|null $content the content of the button
   * @return ResetButton created instance
   */
  public function appendResetter($content = null): ResetButton {
    $button = new ResetButton($content);
    $this->appendButton($button);
    return $button;
  }

  /**
   * Appends a new button to the group
   *
   * @param  Component $button the appended button
   * @return $this
   */
  public function appendButton(Component $button) {
    $button->addCssClass('btn');
    $this->container->append($button);
    return $this;
  }

  public function appendDropDown($toggler, array $items = []): Dropdown {
    if (!$toggler instanceof Component) {
      $toggler = new PushButton($toggler);
      $toggler->addCssClass('btn');
    }
    $dropDown = new Dropdown($toggler, $items);
    $this->append($dropDown);
    return $dropDown;
  }

  /**
   * Appends a new button to the group
   *
   * @param  Component $button the appended button
   * @return $this
   */
  public function append(... $button) {
    //$button->addCssClass('btn');
    foreach ($button as $value) {
      $this->container->append($value);
    }
    return $this;
  }

  /**
   * Create a new iterator to iterate through content
   *
   * @return Traversable<int, Component> iterator
   */
  public function getIterator(): Traversable {
    return $this->container->getIterator();
  }

  public function contentToString(): string {
    return $this->container->getHtml();
  }

}
