<?php

/**
 * InputColumn.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>.
 */

namespace Sphp\Html\Foundation\F6\Forms;

use Sphp\Html\AbstractComponent as AbstractComponent;
use Sphp\Html\Foundation\F6\Grids\ColumnInterface as ColumnInterface;
use Sphp\Html\Foundation\F6\Grids\ColumnTrait as ColumnTrait;
use Sphp\Html\Forms\InputInterface as InputInterface;
use Sphp\Html\Forms\Label as Label;
use Sphp\Html\Forms\LabelableInterface as LabelableInterface;

/**
 * Class implements Foundation framework based component to create  multi-device layouts
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-03-02
 * @link    http://foundation.zurb.com/ Foundation
 * @link    http://foundation.zurb.com/docs/components/grid.html Foundation grid
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class InputColumn extends AbstractComponent implements ColumnInterface, InputInterface {

  use ColumnTrait;

  /**
   *
   * @var Label
   */
  private $label;

  /**
   * The inner input component
   *
   * @var InputInterface 
   */
  private $input;

  /**
   * Constructs a new instance
   *
   * @param  InputInterface $input the actual input component
   * @param  int $s column width for small screens (1-12)
   * @param  int|boolean $m column width for medium screens (1-12) or false for inheritance
   * @param  int|boolean $l column width for large screens (1-12) or false for inheritance
   * @param  int|boolean $xl column width for x-large screens (1-12) or false for inheritance
   * @param  int|boolean $xxl column width for xx-large screen)s (1-12) or false for inheritance
   */
  public function __construct(InputInterface $input, $s = 12, $m = false, $l = false, $xl = false, $xxl = false) {
    parent::__construct("div");
    $this->cssClasses()->lock("column");
     $widthSetter = function ($width, $sreenSize) {
      if ($width > 0 && $width < 13) {
        $this->cssClasses()->add("$sreenSize-$width");
      }
    };
    $widthSetter($s, "small");
    $widthSetter($m, "medium");
    $widthSetter($l, "large");
    $widthSetter($xl, "xlarge");
    $widthSetter($xxl, "xxlarge");
    $this->input = $input;
  }

  /**
   * Returns the label of the component
   * 
   * @return Label the label of the component
   */
  protected function getLabel() {
    return $this->label;
  }

  /**
   * Sets the visible contents of the input label
   * 
   * @param  mixed $label the contents of the label 
   * @return self for PHP Method Chaining
   */
  public function setLabel($label) {
    if (!$this->attrs()->exists("id")) {
      $this->attrs()->setUnique("id");
    }
    if (!($label instanceof Label)) {
      $label = new Label($label);
    } if ($this->input instanceof LabelableInterface) {
      $label->setFor($this);
    }
    $this->label = $label;
    return $this;
  }

  /**
   * Disables the input component
   * 
   * A disabled input component is unusable and un-clickable. 
   * Disabled input components in a form will not be submitted.
   *
   * @param  boolean $disabled true if the component is disabled, otherwise false
   * @return self for PHP Method Chaining
   */
  public function disable($disabled = true) {
    $this->input->disable($disabled);
    return $this;
  }

  /**
   * Checks whether the input component is enabled or not
   * 
   * @param  boolean true if the input component is enabled, otherwise false
   */
  public function isEnabled() {
    return $this->input->isEnabled();
  }

  /**
   * Returns the name of the form input
   *
   * @return string|null the name of the form input
   */
  public function getName() {
    return $this->input->getName();
  }

  /**
   * Sets the name of the form input
   *
   * **Note:** Only form elements with a name attribute will have their values 
   * passed when submitting a form.
   *
   * @param  string $name the name of the form input
   * @return self for PHP Method Chaining
   */
  public function setName($name) {
    $this->input->setName($name);
    return $this;
  }

  /**
   * Checks whether the form input has a name
   *
   * **Note:** Only form elements with a name attribute will have their values 
   * passed when submitting a form.
   *
   * @return boolean true if the input has a name , otherwise false
   */
  public function isNamed() {
    return $this->input->isNamed();
  }

  /**
   * Returns the value of the form input
   *
   * @return  scalar|scalar[] the value
   */
  public function getValue() {
    return $this->input->getValue();
  }

  /**
   * Sets  the value of the form input
   *
   * @param  string|string[] $value the value of the form input
   * @return self for PHP Method Chaining
   */
  public function setValue($value) {
    $this->input->setValue($value);
    return $this;
  }

  /**
   * {@inheritdoc}
   */
  public function contentToString() {
    return $this->label . $this->input;
  }

}
