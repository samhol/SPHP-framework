<?php

/**
 * NonEmptyInputTag.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\ContainerTag as ContainerTag;

/**
 * Class Models an HTML &lt;button&gt; tag
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-02-06
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class NonEmptyInputTag extends ContainerTag implements InputInterface {

  use InputTrait;

  /**
   * Constructs a new instance
   *
   * @param  string $tagName the tag name of the component
   * @param  mixed $content the content of the component
   */
  public function __construct($tagName, $content = null) {
    parent::__construct($tagName, $content);
  }

  /**
   * Returns the value of the value attribute
   *
   * @return string the value of the value attribute
   * @return self for PHP Method Chaining
   */
  public function getValue() {
    return $this->getAttr("value");
  }

  /**
   * Sets the value of the value attribute
   *
   * @param  string $value the value of the value attribute
   * @return self for PHP Method Chaining
   */
  public function setValue($value) {
    return $this->setAttr("value", $value);
  }

}
