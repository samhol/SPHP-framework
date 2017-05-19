<?php

/**
 * LabelableAdapter.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\Html\Forms\Inputs\IdentifiableInputInterface;
use Sphp\Html\Adapters\AbstractComponentAdapter;

/**
 * A trait implementation of the {@link LabelableInterface}
 *
 * A trait for creating  the {@link Label} component pointing to the html input
 * component that implements the {@link LabelableInterface}.
 *
 * **Important:** This trait requires {@link \Sphp\Html\ComponentInterface}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-05-05
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class LabelableAdapter extends AbstractComponentAdapter implements LabelableInterface {

  /**
   * @var IdentifiableInputInterface
   */
  private $input;

  public function __construct(IdentifiableInputInterface $input) {
    parent::__construct($input);
    $this->input = $input;
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->input);
  }

  /**
   * 
   * @return IdentifiableInputInterface
   */
  public function getInput(): IdentifiableInputInterface {
    return $this->input;
  }

  /**
   * Creates a label component for the input component
   *
   *  **Postcondition:** <var>self::attrExists("id") === true</var>
   *
   * @return Label created label component
   */
  public function createLabel($label = null) {
    return new Label($label, $this->input);
  }

}
