<?php

/**
 * TraversableFormTrait.php (UTF-8)
 * Copyright (c) 2011 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\TraversableTrait;
use Sphp\Html\ContainerInterface;
use Sphp\Html\TraversableContent;

/**
 * Trait implements parts of the {@link TraversableFormInterface}
 *
 * The form element represents a collection of form-associated elements, some
 * of which can represent editable values that can be submitted to a server
 * for processing.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.w3schools.com/tags/tag_form.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
trait TraversableFormTrait {

  use FormTrait,
      TraversableTrait;

  /**
   * Returns all named {@link InputInterface} components in the form
   *
   * @return ContainerInterface containing matching sub components
   */
  public function getNamedInputComponents(): TraversableContent {
    $search = function($element) {
      $element instanceof InputInterface && $element->isNamed();
    };
    return $this->getComponentsBy($search);
  }

  /**
   * Returns all named {@link HiddenInput} components from the form
   *
   * @return ContainerInterface containing matching sub components
   */
  public function getHiddenInputs(): Inputs\HiddenInputs {
    $search = function($element) {
      return $element instanceof HiddenInput;
    };
    return $this->getComponentsBy($search);
  }

}
