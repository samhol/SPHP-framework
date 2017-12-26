<?php

/**
 * LabelInterface.php(UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Inputs\IdentifiableInput;

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
interface LabelInterface {

  /**
   * Sets the value of the for attribute
   *
   * **Notes:**
   *
   * - For attribute specifies which form element a label is bound to.
   *
   * @param  string|IdentifiableInput $for the value of the for attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_label_for.asp for attribute
   */
  public function setFor($for);

  /**
   * Returns the value of the for attribute
   *
   * **Note:** for attribute specifies which form element a label is bound to.
   *
   * @return string the value of the for attribute
   * @link  http://www.w3schools.com/tags/att_label_for.asp for attribute
   */
  public function getFor();

  /**
   * Sets the value of the form attribute
   *
   * **Notes:**
   *
   * - Specifies a space-separated list of id's to one or more forms the label object belongs to.
   * - parameter can be an array of id's to one or more forms the object belongs to.
   *
   * @param  string|string[] $formIds the value of the form attribute
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_label_form.asp form attribute
   */
  public function setForms($formIds);

  /**
   * Returns the value(s) of the form attribute
   *
   * **Note:** Returns an array of id's to one or more forms the &lt;label&gt; object belongs to.
   *
   * @return string[] the value(s) of the form attribute
   * @link  http://www.w3schools.com/tags/att_label_form.asp form attribute
   */
  public function getForms(): array;
}
