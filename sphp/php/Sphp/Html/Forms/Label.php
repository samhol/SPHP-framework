<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms;

use Sphp\Html\IdentifiableContent;
use Sphp\Html\ContainerTag;

/**
 * Implementation of an HTML label tag
 *
 * The label represents a caption in a user interface. The caption can be
 * associated with a specific form control, known as the label element's
 * labeled control, either using for attribute, or by putting the form
 * control inside the label element itself.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_label.asp w3schools HTML API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-label-element W3C API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class Label extends ContainerTag implements LabelInterface {

  /**
   * Constructor
   *
   * @param mixed $content the content of the component
   * @param string|IdentifiableContent|null $for the id of the element the label is bound to
   * @link  https://www.w3schools.com/tags/att_label_for.asp for attribute
   */
  public function __construct($content = null, $for = null) {
    parent::__construct('label', $content);
    if ($for !== null) {
      $this->setFor($for);
    }
  }

  public function setFor($for = null) {
    if ($for instanceof IdentifiableContent) {
      $for = $for->identify();
    }
    $this->attributes()->setAttribute('for', $for);
    return $this;
  }

  public function getFor(): ?string {
    return $this->attributes()->getStringValue('for');
  }

  public function setForms(string ... $formIds) {
    $this->attributes()->setAttribute('form', implode(' ', $formIds));
    return $this;
  }

  public function getForms(): array {
    $result = [];
    if ($this->attributes()->isVisible('form')) {
      $result = explode(' ', $this->attributes()->getStringValue('form'));
    }
    return $result;
  }

}
