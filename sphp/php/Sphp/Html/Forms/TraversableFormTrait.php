<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms;

use Sphp\Html\TraversableTrait;
use Sphp\Html\Container;
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
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
trait TraversableFormTrait {

  use FormTrait,
      TraversableTrait;

  /**
   * Returns all named input components in the form
   *
   * @return TraversableContent containing matching sub components
   */
  public function getNamedInputComponents(): TraversableContent {
    $search = function($element) {
      $element instanceof InputInterface && $element->isNamed();
    };
    return $this->getComponentsBy($search);
  }

  /**
   * Returns all named hidden input components from the form
   *
   * @return Container containing matching sub components
   */
  public function getHiddenInputs(): Inputs\HiddenInputs {
    $search = function($element) {
      return $element instanceof HiddenInput;
    };
    return $this->getComponentsBy($search);
  }

}
