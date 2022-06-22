<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms\Buttons;

use Sphp\Html\ContainerTag;
use Sphp\Stdlib\Strings;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * An abstract implementation of an HTML button tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_button.asp w3schools API
 * @link    https://www.w3.org/html/wg/drafts/html/master/forms.html#the-button-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
abstract class AbstractButton extends ContainerTag implements Button {

  /**
   * Constructor
   *
   * @param string $tagname the tag name of the component
   * @param string $type button type (the value of type attribute)
   * @param mixed $content the content of the button
   */
  public function __construct(string $tagname, string $type, mixed $content = null) {
    if (!Strings::match($type, "/^(submit|reset|button|image)$/")) {
      throw new InvalidArgumentException("Illegal form button type '$type'");
    }
    parent::__construct($tagname, $content);
    $this->attributes()->protect('type', $type);
  }

  public function getName(): ?string {
    return $this->attributes()->getStringValue('name');
  }

  public function setName(?string $name) {
    $this->attributes()->setAttribute('name', $name);
    return $this;
  }

  public function isNamed(): bool {
    return $this->attributes()->isVisible('name');
  }

  public function disable(bool $disabled = true) {
    $this->attributes()->setAttribute('disabled', $disabled);
    return $this;
  }

  public function isEnabled(): bool {
    return !$this->attributes()->isVisible('disabled');
  }

  /**
   * Returns the value of the value attribute.
   *
   * @return string the value of the value attribute
   * @link   https://www.w3schools.com/tags/att_button_value.asp value attribute
   */
  public function getValue() {
    return $this->attributes()->getValue('value');
  }

  /**
   * Sets the value of the value attribute.
   *
   * @param  scalar|null $value the value of the value attribute
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_button_value.asp value attribute
   */
  public function setValue($value) {
    $this->attributes()->setAttribute('value', $value);
    return $this;
  }

}
