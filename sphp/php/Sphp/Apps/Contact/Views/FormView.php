<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Contact\Views;

use Sphp\Html\AbstractContent;
use Sphp\Html\Foundation\Sites\Forms\Inputs\ValidableInlineInput;
use Sphp\Html\Forms\ContainerForm;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\Foundation\Sites\Buttons\Button;
use Sphp\Apps\Contact\DataObject;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Media\Icons\FontAwesomeIcon;
use Sphp\Bootstrap\Layout\Row;
/**
 * Description of FormView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FormView extends AbstractContent {

  /**
   * @var FontAwesome
   */
  private $fa;

  /**
   * @var DataObject
   */
  private $data;

  /**
   * @var string 
   */
  private $action;

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

  public function setFormData(DataObject $memberData = null) {
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
  public function buildForm(): ContainerForm {
    $form = new ContainerForm();
    $form->setMethod('post');
    $form->setAction($this->getAction());
    //$form->setFormErrorMessage($this->fa('fas fa-exclamation-triangle fa-lg') . ' <strong>Yhteydenottolomake sisältää virheitä</strong>');
    $form->append($this->buildNameRow());
    $form->append($this->buildContactRow());
    $form->append($this->buildMessageRow());
    $form->append($this->buildButtonRow());
    $form->useValidation(false);
    $form->liveValidate();
    return $form;
  }

  private function buildNameRow(): BasicRow {
    $nameRow = new Row();
    $name = ValidableInlineInput::text('name');
    if ($this->data->contains('name')) {
      $name->getInput()->setInitialValue($this->data['name']);
    }
    $name->setLeftInlineLabel($this->fa('fa fa-user'));
    $name->setLabel('Nimi <small class="required">on pakollinen</small>');
    $name->setPlaceholder('Nimesi');
    $name->setRequired(true);
    //$name->setPattern('person_name');
    $name->setErrorMessage('Anna nimesi');
    $nameRow->appendColumn($name)->small(12);
    return $nameRow;
  }

  private function buildEmailField(): ValidableInlineInput {
    $email = ValidableInlineInput::text('email');
    if ($this->data->contains('email')) {
      $email->getInput()->setInitialValue($this->data['email']);
    }
    $email->setLeftInlineLabel($this->fa('fas fa-at'));
    $email->setLabel('Sähköpostiosoite <small class="required">on pakollinen</small>');
    $email->setPlaceholder('a@mail.com');
    $email->setErrorMessage('Anna sähköpostiosoite oikeassa muodossa');
    $email->setRequired(true);
    $email->setPattern('email');
    return $email;
  }

  private function buildPhoneField(): ValidableInlineInput {
    $phone = ValidableInlineInput::text('phone');
    if ($this->data->contains('phone')) {
      $phone->getInput()->setInitialValue($this->data['phone']);
    }
    $phone->setLeftInlineLabel($this->fa('fas fa-phone'));
    $phone->setLabel('Puhelinnumero <small class="required">on pakollinen</small>');
    $phone->setPlaceholder('+358 12 345 6789');
    $phone->setRequired(true);
    $phone->setErrorMessage('Anna puhelinnumero oikeassa muodossa');
    $phone->setPattern('phone');
    return $phone;
  }

  private function buildContactRow(): BasicRow {
    $contactRow = new BasicRow();
    $contactRow->appendCell($this->buildEmailField())->small(12)->medium(6);
    $contactRow->appendCell($this->buildPhoneField())->small(12)->medium(6);
    return $contactRow;
  }

  private function buildMessageRow(): BasicRow {
    $additionalInfo = ValidableInlineInput::textarea('message');
    $additionalInfo->setRequired(true);
    $additionalInfo->setErrorMessage('Viestikenttä on pakollinen');
    if ($this->data->contains('message')) {
      $additionalInfo->getInput()->setInitialValue($this->data['message']);
    }
    $additionalInfo->setLabel('Viesti <small class="required">on pakollinen</small>');
    $additionalInfo->setPlaceholder('Viestin sisältö . . . ');
    $additionalInfo->setRows(4);
    $infoRow = new BasicRow();
    $infoRow->appendCell($additionalInfo)->small(12);
    return $infoRow;
  }

  private function buildButtonRow(): BasicRow {
    $buttons = Button::pushButton($this->fa('fas fa-envelope') . ' Lähetä')->addCssClass('submitter radius');
    $buttonRow = new BasicRow();
    $buttonRow->appendCell($buttons);
    return $buttonRow;
  }

  public function getHtml(): string {
    return $this->buildForm();
  }

}
