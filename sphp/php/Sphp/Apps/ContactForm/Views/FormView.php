<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\ContactForm\Views;

use Sphp\Html\AbstractContent;
use Sphp\Bootstrap\Components\Forms\ValidableInput;
use Sphp\Bootstrap\Components\Forms\GridForm;
use Sphp\Bootstrap\Layout\Row;
use Sphp\Html\Forms\Buttons\PushButton;
use Sphp\Apps\ContactForm\DataObject;
use Sphp\Media\Icons\FontAwesome;
use Sphp\Media\Icons\FontAwesomeIcon;

/**
 * Description of FormView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FormView extends AbstractContent {

  public FontAwesome $fa;

  /**
   * @var DataObject
   */
  private DataObject $data;
  private string $action;

  /**
   * Constructor
   * 
   * @param DataObject $data
   */
  public function __construct(string $action, DataObject $data = null) {
    $this->setFormData($data);
    $this->fa = new FontAwesome();
    $this->fa->fixedWidth(true);
    $this->action = $action;
  }

  public function __destruct() {
    unset($this->fa, $this->data);
  }

  function getAction(): string {
    return $this->action;
  }

  private function fa(string $iconName): FontAwesomeIcon {
    return $this->fa->createIcon($iconName);
  }

  public function getFormData(): DataObject {
    return $this->data;
  }

  public function setFormData(?DataObject $memberData = null) {
    if ($memberData === null) {
      $memberData = new DataObject;
    }
    $this->data = $memberData;
    return $this;
  }

  /**
   * 
   * @return GridForm
   */
  public function buildForm(): GridForm {
    $form = new GridForm();
    $form->identify('demo-form');
    $form->setMethod('post');
    $form->setAction($this->getAction());
    $form->useValidation(true);
    $form->addCssClass('p-3');
    $form->getGrid()->appendRow()->appendColumn($this->buildNameField())->sm(12)->addCssClass('p-2');
    $contactRow = new Row();
    $contactRow->appendColumn($this->buildEmailField())->sm(12)->md(6)->addCssClass('p-2');
    $contactRow->appendColumn($this->buildPhoneField())->sm(12)->md(6)->addCssClass('p-2');
    $form->append($contactRow);
    $form->getGrid()->appendRow()->appendColumn($this->buildMessageField())->sm(12);
    $form->getGrid()->appendRow()->addCssClass('g-3')->appendColumn($this->buildSubmitter())->sm(12);
    return $form;
  }

  private function buildNameField(): ValidableInput {
    $nameField = ValidableInput::text('name');
    $nameField->getInput()->setInitialValue($this->data?->offsetGet('name'));
    $nameField->setLabel('Name <small class="required">required</small>');
    $nameField->setPreLabel($this->fa('fa fa-user'));
    $nameField->setInvalidToolTip('Name <small class="required">is required</small>');
    $nameField->getInput()->setPlaceholder('name');
    $nameField->setRequired(true);
    //$name->setPattern('person_name');
    $nameField->setValidTooltip('Name is valid');
    return $nameField;
  }

  private function buildEmailField(): ValidableInput {
    $emailField = ValidableInput::email('email');
    $emailField->getInput()->setInitialValue($this->data['email']);
    $emailField->setPreLabel($this->fa('fa-solid fa-envelope'));
    $emailField->setLabel('Email address <small class="required">required</small>');
    $emailField->getInput()->setPlaceholder('a@mail.com');
    $emailField->setValidToolTip('Email address is valid');
    $emailField->setInvalidToolTip('Please enter a correct Email address');
    $emailField->setRequired(true);
    return $emailField;
  }

  private function buildPhoneField(): ValidableInput {
    $phoneField = ValidableInput::text('phone');
    $phoneField->getInput()->setInitialValue($this->data['phone']);
    $phoneField->setPreLabel($this->fa('fas fa-phone'));
    $phoneField->setLabel('Phone number');
    $phoneField->getInput()
            ->setPlaceholder('+358 12 345 6789')
            ->setPattern("^\+[0-9]{1,3} ?[0-9]{2,} ?[\d ]{4,14}$");
    $phoneField->setInvalidToolTip('Please enter a correct phonenumber');
    return $phoneField;
  }

  private function buildMessageField(): ValidableInput {
    $messageField = ValidableInput::textarea('message');
    $messageField->setRequired(true);
    $messageField->setInvalidToolTip('Please insert a message');
    $messageField->getInput()->setInitialValue($this->data['message']);
    $messageField->setLabel('Message <small class="required">required</small>');
    $messageField->getInput()
            ->setPlaceholder('Message content . . . ')
            ->setRows(4);
    return $messageField;
  }

  private function buildSubmitter(): PushButton {
    $buttons = (new PushButton($this->fa('fas fa-envelope') . ' submit'))->addCssClass('submitter btn btn-success g-recaptcha m-3');
    $buttons->setAttribute('data-sitekey', '6LdvQa8UAAAAAFT6l3lyifzSD-C4GsY7S59-r5HF')
            ->setAttribute('data-callback', 'onSubmit')
            ->setAttribute('data-action', 'submit');
    return $buttons;
  }

  public function getHtml(): string {
    return $this->buildForm()->getHtml();
  }

}
