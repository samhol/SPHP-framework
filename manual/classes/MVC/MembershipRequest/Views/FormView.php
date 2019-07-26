<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC\MembershipRequest\Views;

use Sphp\Html\AbstractContent;
use Sphp\Html\Foundation\Sites\Forms\Inputs\ValidableInlineInput;
use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;
use Sphp\Manual\MVC\MembershipRequest\RequestData;

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
   * @var RequestData
   */
  private $data;

  /**
   * Constructor
   * 
   * @param RequestData $data
   */
  public function __construct(RequestData $data = null) {
    $this->setMemberData($data);
  }

  public function getMemberData(): RequestData {
    return $this->data;
  }

  public function setMemberData(RequestData $memberData = null) {
    if ($memberData === null) {
      $memberData = new RequestData;
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
    $form->setMethod('post');
    $form->setAction('/manual/form/process.php');

    $form->setFormErrorMessage('<i class="fas fa-exclamation-triangle fa-lg"></i> Jäsenhakemuslomake sisältää virheitä');

    // $form->append($this->buildAgeRow());
    $form->append($this->buildNameRow());
    //  $form->append($this->buildTitleRow());
    $form->append($this->buildContactRow());
    $form->append($this->buildTitleRow());
    $form->append($this->buildMessageBodyRow());
    $form->append($this->buildButtonRow());

    //$form->liveValidate();
    return $form;
  }

  private function buildNameRow(): BasicRow {
    $nameRow = new BasicRow();
    $fname = ValidableInlineInput::text('name');
    if ($this->data->contains('name')) {
      $fname->getInput()->setInitialValue($this->data['name']);
    }
    $fname->setLeftInlineLabel('<i class="fa fa-user"></i>');
    $fname->setLabel('Name');
    $fname->setPlaceholder('Name');
    $fname->setPattern('person_name');
    $fname->setErrorMessage('Hakijan etunimi puuttuu tai on virheellinen');
    $nameRow->appendCell($fname)->small(12);
    return $nameRow;
  }

  private function buildTitleField(): ValidableInlineInput {
    $zipcode = ValidableInlineInput::text('title');
    if ($this->data->contains('title')) {
      $zipcode->getInput()->setInitialValue($this->data['title']);
    }
    $zipcode->setLeftInlineLabel('<i class="fas fa-road"></i>');
    $zipcode->setLabel('Title <small class="required">Required</small>');
    $zipcode->setPlaceholder('Title');
    $zipcode->setRequired(true);
    $zipcode->setErrorMessage('Message title is required');
    return $zipcode;
  }

  private function buildTitleRow(): BasicRow {
    $addressRow = new BasicRow();
    $addressRow->appendCell($this->buildTitleField())->small(12);
    return $addressRow;
  }

  private function buildEmailField(): ValidableInlineInput {
    $email = ValidableInlineInput::text('email');
    if ($this->data->contains('email')) {
      $email->getInput()->setInitialValue($this->data['email']);
    }
    $email->setLeftInlineLabel('<i class="fas fa-at"></i>');
    $email->setLabel('Sähköpostiosoite <small class="required">pakollinen</small>');
    $email->setPlaceholder('a@mail.com');
    $email->setErrorMessage('Anna hakijan sähköpostiosoite oikeassa muodossa');
    $email->setRequired(true);
    $email->setPattern('email');
    return $email;
  }

  private function buildPhoneField(): ValidableInlineInput {
    $phone = ValidableInlineInput::text('phone');
    if ($this->data->contains('phone')) {
      $phone->getInput()->setInitialValue($this->data['phone']);
    }
    $phone->setLeftInlineLabel('<i class="fas fa-phone"></i>');
    $phone->setLabel('Phonenumber');
    $phone->setPlaceholder('+358 12 345 6789');
    $phone->setErrorMessage('Invalid phonenumber given');
    $phone->setPattern('phone');
    return $phone;
  }

  private function buildContactRow(): BasicRow {
    $contactRow = new BasicRow();
    $contactRow->appendCell($this->buildEmailField())->small(12)->medium(6);
    $contactRow->appendCell($this->buildPhoneField())->small(12)->medium(6);
    return $contactRow;
  }

  private function buildMessageBodyRow(): BasicRow {
    $additionalInfo = ValidableInlineInput::textarea('message');
    if ($this->data->contains('message')) {
      $additionalInfo->getInput()->setInitialValue($this->data['message']);
    }
    $additionalInfo->setLabel('Message');
    $additionalInfo->setPlaceholder('Message body . . . ');
    $additionalInfo->setRows(4);
    $infoRow = new BasicRow();
    $infoRow->appendCell($additionalInfo)->small(12);
    return $infoRow;
  }

  private function buildButtonRow(): BasicRow {
    $buttons = new ButtonGroup();
    $buttons->appendPushButton('<i class="fas fa-envelope"></i> Lähetä')->addCssClass('success', 'submitter');
    //$buttons->appendResetter('<i class="fas fa-undo-alt"></i> Tyhjennä')->addCssClass('alert');
    $buttons->addCssClass('text-center');
    $buttonRow = new BasicRow();
    $buttonRow->appendCell($buttons);
    return $buttonRow;
  }

  public function getHtml(): string {
    return $this->buildForm();
  }

}
