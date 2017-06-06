<?php

/**
 * ButtonAdapter.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\Foundation\Sites\Core\ColourableAdapter;
use Sphp\Html\Forms\Buttons\Submitter;
use Sphp\Html\Forms\Buttons\Resetter;
use Sphp\Html\Navigation\Hyperlink;

/**
 * Implements button styling for Foundation Sites
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-04-11
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
Class Button extends ColourableAdapter implements ButtonInterface {
use ButtonTrait;
  /**
   * CSS classes corresponding to the size constants
   *
   * @var string[]
   */
  private $sizes = [
      'tiny', 'small', 'large', 'expand'
  ];

  public function __construct(\Sphp\Html\ComponentInterface $component) {
    parent::__construct($component);
    $this->getComponent()->cssClasses()->set('button');
  }

  /**
   * Sets the size of the button 
   * 
   * Predefined values of <var>$size</var> parameter:
   * 
   * * `'tiny'` for tiny buttons
   * * `'small'` for small buttons
   * * `'medium'` for "medium" (default) buttons
   * * `'large'` for large buttons
   * * `'extend'` for extended buttons (takes the full width of the container)
   * 
   * @param  string $size optional CSS class name defining button size. 
   *         `medium` value corresponds to no explicit size definition.
   * @return self for a fluent interface
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-sizing Button Sizing
   */
  public function setSize($size = null) {
    $this->getComponent()->cssClasses()->remove($this->sizes);
    if ($size !== null) {
      $this->getComponent()->cssClasses()->add($size);
      if (!in_array($size, $this->sizes)) {
        $this->sizes[] = $size;
      }
    }
    return $this;
  }

  /**
   * Sets the button size to default
   * 
   *  Removes all specified size related CSS classes
   * 
   * @return self for a fluent interface
   * @link   http://foundation.zurb.com/docs/components/buttons.html#button-sizing Button Sizing
   */
  public function setDefaultSize() {
    return $this->setSize('medium');
  }

  public function cssClasses() {
    return $this->getComponent()->cssClasses();
  }

  /**
   * Creates a new instance adapted from mixed content
   *
   * @param  string|null $from adaptee component or content of the button
   * @return self new instance
   */
  public static function create($from) {
    if (!$from instanceof \Sphp\Html\ComponentInterface) {
      $from = new \Sphp\Html\Span($from);
    }
    return new static($from);
  }

  /**
   * Creates a new instance adapted from hyperlink
   *
   * **Notes:**
   *
   * * The href attribute specifies the URL of the page the link goes to.
   * * If the href attribute is not present, the &lt;a&gt; tag is not a hyperlink.
   *
   * @param  string|null $href optional URL of the link
   * @param  string|null $content optional the content of the component
   * @param  string|null $target optional value of the target attribute
   * @return self new instance
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public static function hyperlink($href = null, $content = null, $target = null) {
    return new static(new Hyperlink($href, $content, $target));
  }

  /**
   * 
   * @param  mixed $content optional
   * @param  string|null $name optional
   * @param  string|null $value optional
   * @return self new instance
   */
  public static function submitter($content = null, $name = null, $value = null) {
    return new static(new Submitter($content, $name, $value));
  }

  /**
   * 
   * @param  mixed $content
   * @return self new instance for form resetting
   */
  public static function resetter($content = null) {
    return new static(new Resetter($content));
  }

}
