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
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class InputTag extends AbstractInputTag implements ValidableInput {

  public function setRequired(bool $required = true) {
    $this->attrs()->setBoolean('required', $required);
    return $this;
  }

  public function isRequired(): bool {
    return $this->attrExists('required');
  }
}
