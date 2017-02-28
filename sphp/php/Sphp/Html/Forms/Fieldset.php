<?php

/**
 * Fieldset.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;fieldset&gt; tag
 *
 * The fieldset element is expected to establish a new block formatting context
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-11
 * @link    http://www.w3schools.com/tags/tag_fieldset.asp w3schools HTML API
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-fieldset-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Fieldset extends ContainerTag {

  /**
   * the legend of the fieldset component
   *
   * @var Legend
   */
  private $legend;

  /**
   * Constructs a new instance
   *
   * @param  string|Legend $legend the legend of the fieldset component
   * @param  mixed $content the content of the component
   */
  public function __construct($legend = null, $content = null) {
    parent::__construct('fieldset', $content);
    $this->legend = $legend;
    if ($legend !== null) {
      $this->setLegend($legend);
    }
  }

  /**
   * Sets the {@link Legend} of the fieldset component
   *
   * @param  string|Legend $legend the legend of the fielset component
   * @return self for a fluent interface
   */
  public function setLegend($legend) {
    if (!($legend instanceof Legend)) {
      $legend = new Legend($legend);
    }
    $this->legend = $legend;
    return $this;
  }

  /**
   * Returns the {@link Legend} of the fieldset component
   *
   * @return Legend the legend of the fieldset component or null
   */
  public function getLegend() {
    return $this->legend;
  }

  /**
   * Activates the Fieldset component
   *
   * @param  boolean $enabled true if the component is enabled, otherwise false
   * @return self for a fluent interface
   */
  public function enable($enabled = true) {
    return parent::setAttr("disabled", !$enabled);
  }

  public function contentToString() {
    return $this->getLegend() . parent::contentToString();
  }

}
