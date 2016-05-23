<?php

/**
 * ButtonTag.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms\Buttons;

use Sphp\Html\ContainerTag as ContainerTag;
use Sphp\Html\Forms\InputInterface as InputInterface;
use Sphp\Html\Forms\InputTrait as InputTrait;

/**
 * Class Models an HTML &lt;button&gt; tag
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-02-06
 * @version 1.1.0
 * @link    http://www.w3schools.com/tags/tag_button.asp w3schools API link
 * @link    http://www.w3.org/html/wg/drafts/html/master/forms.html#the-button-element W3C API link
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Button extends ContainerTag implements InputInterface {

  use InputTrait;

  /**
   * the tag name of the HTML component
   */
  const TAG_NAME = "button";

  /**
   * Constructs a new instance
   *
   * @param  string $type the value of type attribute
   * @param  mixed $content the content of the button tag
   * @param  string $name the value of name attribute
   * @param  string $value the value of value attribute
   * @link   http://www.w3schools.com/tags/att_button_type.asp type attribute
   * @link   http://www.w3schools.com/tags/att_button_name.asp name attribute
   * @link   http://www.w3schools.com/tags/att_button_value.asp value attribute
   * @link   http://www.php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct($type, $content = null, $name = null, $value = null) {
    parent::__construct(self::TAG_NAME, $content);
    $this->lockAttr("type", $type);
    if (isset($name)) {
      $this->setName($name);
    }
    if (isset($value)) {
      $this->setValue($value);
    }
  }

  /**
   * Returns the value of the value attribute
   *
   * @return string napin arvo
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_button_value.asp value attribute
   */
  public function getValue() {
    return $this->getAttr("value");
  }

  /**
   * Sets the value of the value attribute
   *
   * @param  string $value napin arvo
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_button_value.asp value attribute
   */
  public function setValue($value) {
    return parent::setAttr("value", $value);
  }

  /**
   * Returns the value of the type attribute
   *
   * @return string the value of the type attribute
   * @link   http://www.w3schools.com/tags/att_button_type.asp type attribute
   */
  public function getType() {
    return parent::getAttrValue("type");
  }

}
