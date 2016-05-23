<?php

/**
 * Callout.php (UTF-8)
 * Copyright (c) 2016 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Foundation\F6\Containers;

use Sphp\Html\AbstractContainerTag as AbstractContainerTag;
use Sphp\Html\AjaxLoaderInterface as AjaxLoaderInterface;
use Sphp\Html\Div as Div;
use Sphp\Html\Foundation\F6\Buttons\CloseButton as CloseButton;

/**
 * Class implements a Foundation panel component
 *
 * A panel is a simple, helpful Foundation component that enables to outline
 * sections of a page easily. This allows you to view your page sections as you
 * add content to them, or add emphasis to a section. The width is controlled
 * by the grid columns you put them inside.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-03-02
 * @version 1.0.0
 * @link    http://foundation.zurb.com/ Foundation 6
 * @link    http://foundation.zurb.com/sites/docs/callout.html Foundation 6 Callout
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Callout extends AbstractContainerTag implements AjaxLoaderInterface {

  use \Sphp\Html\Foundation\F6\Core\ColoringTrait;

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
    $this->closeButton->setSmall();
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
   * {@inheritdoc}
   */
  public function ajaxReplace($url) {
    $this->content()->ajaxReplace($url);
    return $this;
  }

  /**
   * 
   * @return self for PHP Method Chaining
   */
  public function setClosable($closeable = true) {
    $this->attrs()->set("data-closable", $closeable);
    return $this;
  }

  /**
   * 
   * @return boolean
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
