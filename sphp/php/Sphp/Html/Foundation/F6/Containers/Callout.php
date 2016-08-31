<?php

/**
 * Callout.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers;

use Sphp\Html\AbstractContainerTag as AbstractContainerTag;
use Sphp\Html\AjaxLoaderInterface as AjaxLoaderInterface;
use Sphp\Html\ContentParserInterface as ContentParserInterface;

use Sphp\Html\Div as Div;
use Sphp\Html\Foundation\F6\Buttons\CloseButton as CloseButton;
use Sphp\Html\Foundation\F6\Core\ColourableTrait as ColourableTrait;

/**
 * Class implements a Foundation 6 callout component
 *
 * Callouts combine panels and alerts from Foundation 5 into one generic container component.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-02
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/callout.html Foundation 6 Callout
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Callout extends AbstractContainerTag implements AjaxLoaderInterface {

  use ColourableTrait;

  /**
   * The inner close button component
   *
   * @var CloseButton
   */
  private $closeButton;

  /**
   * Constructs a new instance
   *
   * @param  mixed|null $content added content
   */
  public function __construct($content = null) {
    parent::__construct("div", null, new Div($content));
    $this->cssClasses()->lock("callout");
    $this->closeButton = new CloseButton("close");
  }

  /**
   * Sets the content padding
   * 
   * Predefined paddings:
   * 
   * * `'small'` for small padding
   * * `null` or `'default'` for (default) padding
   * * `'large'` for large padding
   * 
   * @param  string|null $padding optional CSS class name defining the amount of the content padding
   * @return self for PHP Method Chaining
   * @link   http://foundation.zurb.com/sites/docs/callout.html#sizing Callout Sizing
   */
  public function setPadding($padding = "default") {
    $paddings = ["small", "large"];
    $this->removeCssClass($paddings);
    if (in_array($padding, $paddings)) {
      $this->addCssClass($padding);
    }
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function ajaxAppend($url) {
    $this->content()->ajaxAppend($url);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function ajaxPrepend($url) {
    $this->content()->ajaxPrepend($url);
    return $this;
  }

  /**
   * Sets/unsets the callout closable
   * 
   * Values for `$closable` parameter
   * 
   * * `true`: the callout is closable and the default closing effect is used 
   * * `'slide-out-right'`
   * * ...any other Foundation Motion UI effect string
   * * `false`: the callout is not closable
   * 
   * @param  string|boolean $closable true for closable and false otherwise
   * @return self for PHP Method Chaining
   */
  public function setClosable($closable = true) {
    $this->attrs()->set("data-closable", $closable);
    return $this;
  }

  /**
   * Checks whether the callout is closable or not
   * 
   * @return boolean true if callout is closable and false if not
   */
  public function isClosable() {
    return $this->attrs()->exists("data-closable");
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    $output = parent::contentToString();
    if ($this->isClosable()) {
      $output .= $this->closeButton;
    }
    return $output;
  }

}
