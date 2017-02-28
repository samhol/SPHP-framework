<?php

/**
 * ValidableForm.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Forms;

use Sphp\validation\FormValidator as FormValidator;
use Sphp\validation\RequiredValueValidatorr;
use Sphp\Stdlib\Arrays;

/**
 * A form validation wrapper
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-10-14
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ValidableForm implements \Sphp\Html\ContentInterface {

  use \Sphp\Html\ContentTrait;

  /**
   * the form to validate
   *
   * @var FormValidator
   */
  private $formValidator;

  /**
   * the form to validate
   *
   * @var FormInterface
   */
  private $form;

  /**
   * Constructs a new instance of the {@link self} object
   * 
   * @param FormInterface $form the form to validate
   */
  public function __construct(FormInterface $form) {
    $this->formValidator = new FormValidator();
    $this->form = $form;
  }

  /**
   * Returns the form component
   * 
   * @return FormInterface
   */
  public function getForm() {
    return $this->form;
  }

  /**
   * Sets the validator used to validate the form
   * 
   * @param FormValidator $v
   * @return self for a fluent interface
   */
  public function setFormValidator(FormValidator $v) {
    $this->formValidator = $v;
    $this->form->addCssClass("sph-validable");
    return $this;
  }

  /**
   * Returns the validator used to validate the form
   * 
   * @return FormValidator the validator used to validate the form
   */
  public function getFormValidator() {
    return $this->formValidator;
  }

  /**
   * Builds a default validator from the form inputs
   * 
   * @return self for a fluent interface
   */
  public function buildDefaultValidator() {
    $inputs = $this->form->getNamedInputComponents();
    $formValidator = new FormValidator();
    foreach ($inputs as $input) {
      if ($input->isRequired()) {
        $formValidator->appendValidator($input->getName(), new RequiredValueValidator());
      }
    }
    $this->setFormValidator($formValidator);
    return $this;
  }

  /**
   * Validates the form data
   * 
   * @return self for a fluent interface
   */
  public function validate() {
    $this->formValidator->validate($this->form->getData());
    return $this;
  }

  /**
   * Visualizes the current form validation state
   * 
   * @return self for a fluent interface
   */
  public function visualizeValidation() {
    $topics = $this->formValidator->getErrors();
    //echo $topics->toJson();
    foreach ($this->form->getNamedInputComponents() as $input) {
      $topic = $input->getName();
      if ($topics->hasTopic($topic)) {
        $id = $input->identify();
        //$json = $topics->getTopic($topic)->toJson();
        foreach ($topics->getTopic($topic) as $message) {
          $messages[] = "'$message'";
        }
        $json = Arrays::implode($messages);

        //$this->script[] = "$('#$id').visualizeValidation(" . $topics->getTopic($topic)->toJson() . ");";
      }
    }
    return $this;
  }

  /**
   * Returns the component as html-markup string
   *
   * @return string html-markup of the component
   * @throws \Exception if html parsing fails
   */
  public function getHtml() {
    return $this->form;
  }

}
