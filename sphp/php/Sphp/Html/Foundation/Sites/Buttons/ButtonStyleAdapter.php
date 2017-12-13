<?php

/**
 * ButtonStyleAdapter.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\Sites\Buttons;

use Sphp\Html\Foundation\Sites\Core\AbstractLayoutManager;
use Sphp\Html\CssClassifiableContent;
use Sphp\Html\Forms\Buttons\Submitter;
use Sphp\Html\Forms\Buttons\Resetter;
use Sphp\Html\Forms\Buttons\Button as PushButton;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Span;

/**
 * Implements button styling adapter for Foundation Sites
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/buttons.html Foundation Buttons
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
Class ButtonStyleAdapter extends AbstractLayoutManager implements ButtonInterface {

  use ButtonTrait;

  /**
   * Constructs a new instance
   * 
   * @param CssClassifiableContent $component
   */
  public function __construct(CssClassifiableContent $component) {
    parent::__construct($component);
    $this->cssClasses()->set('button');
  }

  public function setLayouts(...$layouts) {
    $colors = array_intersect(Arrays::flatten($layouts), static::$styles);
    foreach ($colors as $colorCandidate) {
      $this->setColor($colorCandidate);
    }
  }

  public function unsetLayouts() {
    $this->disable(false)->isDropdown(false)->isDropdown(false);
  }

  /**
   * Creates a new instance adapted from mixed content
   *
   * @param  string|null $from adaptee component or content of the button
   * @return ButtonStyleAdapter new instance
   */
  public static function create($from): ButtonStyleAdapter {
    if (!$from instanceof CssClassifiedComponent) {
      $from = new Span($from);
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
   * @return ButtonStyleAdapter new instance
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public static function hyperlink($href = null, $content = null, $target = null): ButtonStyleAdapter {
    return new static(new Hyperlink($href, $content, $target));
  }

  /**
   * 
   * @param  mixed $content optional
   * @param  string|null $name optional
   * @param  string|null $value optional
   * @return ButtonStyleAdapter new instance
   */
  public static function submitter(string $content = null, $name = null, $value = null): ButtonStyleAdapter {
    return new static(new Submitter($content, $name, $value));
  }

  /**
   * 
   * @param  mixed $content
   * @return ButtonStyleAdapter new instance for form resetting
   */
  public static function resetter($content = null): ButtonStyleAdapter {
    return new static(new Resetter($content));
  }

  /**
   * 
   * @param  mixed $content
   * @return ButtonStyleAdapter new instance containing a push button
   */
  public static function pushButton($content = null): ButtonStyleAdapter {
    return new static(new PushButton($content));
  }

  public function addCssClass(...$cssClasses) {
    
  }

  public function hasCssClass(...$cssClasses): bool {
    return $this->getCompoenet()->hasCssClass($cssClasses);
  }

  public function removeCssClass(...$cssClasses) {
    
  }

}
