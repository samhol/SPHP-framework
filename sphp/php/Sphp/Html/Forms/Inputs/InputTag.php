<?php

/**
 * InputTag.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Forms\Inputs;

/**
 * Implements an HTML &lt;input&gt; tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_input.asp w3schools API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class InputTag extends AbstractInputTag implements ValidableInput {

  public function setRequired(bool $required = true) {
    $this->attributes()->setBoolean('required', $required);
    return $this;
  }

  public function isRequired(): bool {
    return $this->attributeExists('required');
  }
}
