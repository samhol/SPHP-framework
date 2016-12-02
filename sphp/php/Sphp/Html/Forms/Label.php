<?php

/**
 * Label.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Inputs\IdentifiableInputInterface;
use Sphp\Html\ContainerTag;
use Sphp\Core\Types\Strings;

/**
 * Class models an HTML &lt;label&gt; tag
 *
 * The label represents a caption in a user interface. The caption can be
 * associated with a specific form control, known as the label element's
 * labeled control, either using for attribute, or by putting the form
 * control inside the label element itself.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-03-11
 * @link    http://www.w3schools.com/tags/tag_label.asp w3schools HTML API
 * @link    http://dev.w3.org/html5/spec/Overview.html#the-label-element W3C API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Label extends ContainerTag {

  /**
   * Constructs a new instance
   *
   * @param mixed $content the content of the component
   * @param string|null $for the id of the element the label is bound to
   * @link  http://www.w3schools.com/tags/att_label_for.asp for attribute
   */
  public function __construct($content = null, $for = null) {
    parent::__construct('label', $content);
    if (!Strings::isEmpty($for)) {
      $this->setFor($for);
    }
  }

  /**
   * Sets the value of the for attribute
   *
   * **Notes:**
   *
   * - For attribute specifies which form element a label is bound to.
   *
   * @param  string|IdentifiableInputInterface $for the value of the for attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_label_for.asp for attribute
   */
  public function setFor($for) {
    if ($for instanceof IdentifiableInputInterface) {
      $for = $for->identify();
    }
    $this->attrs()->set('for', $for);
    return $this;
  }

  /**
   * Returns the value of the for attribute
   *
   * **Note:** for attribute specifies which form element a label is bound to.
   *
   * @return string the value of the for attribute
   * @link  http://www.w3schools.com/tags/att_label_for.asp for attribute
   */
  public function getFor() {
    return $this->attrs()->get('for');
  }

  /**
   * Sets the value of the form attribute
   *
   * **Notes:**
   *
   * - Specifies a space-separated list of id's to one or more forms the label object belongs to.
   * - parameter can be an array of id's to one or more forms the object belongs to.
   *
   * @param  string|string[] $formIds the value of the form attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_label_form.asp form attribute
   */
  public function setForms($formIds) {
    if (is_array($formIds)) {
      $formIds = implode(' ', $formIds);
    }
    $this->attrs()->set('form', $formIds);
    return $this;
  }

  /**
   * Returns the value(s) of the form attribute
   *
   * **Note:** Returns an array of id's to one or more forms the &lt;label&gt; object belongs to.
   *
   * @return string[] the value(s) of the form attribute
   * @link  http://www.w3schools.com/tags/att_label_form.asp form attribute
   */
  public function getForms() {
    $result = [];
    if ($this->attrs()->exists('form')) {
      $result = explode(' ', $this->attrs()->get('form'));
    }
    return $result;
  }

}
