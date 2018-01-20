<?php

/**
 * Label.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Inputs\IdentifiableInput;
use Sphp\Html\ContainerTag;

/**
 * Implements an HTML &lt;label&gt; tag
 *
 * The label represents a caption in a user interface. The caption can be
 * associated with a specific form control, known as the label element's
 * labeled control, either using for attribute, or by putting the form
 * control inside the label element itself.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_label.asp w3schools HTML API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-label-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Label extends ContainerTag implements LabelInterface {

  /**
   * Constructs a new instance
   *
   * @param mixed $content the content of the component
   * @param string|IdentifiableInput|null $for the id of the element the label is bound to
   * @link  http://www.w3schools.com/tags/att_label_for.asp for attribute
   */
  public function __construct($content = null, $for = null) {
    parent::__construct('label', $content);
    if ($for !== null) {
      $this->setFor($for);
    }
  }

  public function setFor($for) {
    if ($for instanceof IdentifiableInput) {
      $for = $for->identify();
    }
    $this->attributes()->set('for', $for);
    return $this;
  }

  public function getFor() {
    return $this->attributes()->getValue('for');
  }

  public function setForms($formIds) {
    if (is_array($formIds)) {
      $formIds = implode(' ', $formIds);
    }
    $this->attributes()->set('form', $formIds);
    return $this;
  }

  public function getForms(): array {
    $result = [];
    if ($this->attributes()->exists('form')) {
      $result = explode(' ', $this->attributes()->getValue('form'));
    }
    return $result;
  }

}
