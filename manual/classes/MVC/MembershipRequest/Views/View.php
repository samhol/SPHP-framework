<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\MVC\MembershipRequest\Views;

use Sphp\Html\Foundation\Sites\Forms\Inputs\ValidableInlineInput;
use Sphp\Html\Foundation\Sites\Forms\GridForm;
use Sphp\Html\Foundation\Sites\Grids\BasicRow;
use Sphp\Html\Foundation\Sites\Buttons\ButtonGroup;
use Sphp\Html\Foundation\Sites\Grids\DivGrid;
use Sphp\Html\Foundation\Sites\Grids\ContainerCell;
use Sphp\MVC\MembershipRequest\ResultData;

/**
 * Implements a contact form view
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class View {

  public function getResultView(ResultData $data): DivGrid {
    $resultGrid = new DivGrid();
    $resultView = new ResultView;
    $callout = $resultView->generateResultCallout($data);
    $callout->setClosable(true);

    $resultGrid->append($callout);
    $cell = new ContainerCell();
    $resultGrid->append($cell);
    return $resultGrid;
  }

  /**
   * 
   * @param  MembershipRequestData $initialData
   * @return GridForm
   */
  public function buildForm(MembershipRequestData $initialData = null): GridForm {
    $required = true;
    $form = new GridForm();
    $form->useValidation(true);
    $form->setMethod('post');
    $form->setAction('/_srcs/membership-form/process.php');

    $form->setFormErrorMessage('<i class="fas fa-exclamation-triangle"></i> Jäsenhakemuslomake sisältää virheitä');

    $age = ValidableInlineInput::text('dob');
    $age->setLeftInlineLabel('<i class="fa fa-user"></i>');
    $age->setLabel('Syntymäaika <small class="required">pakollinen juniorijäsenille</small>');
    $age->setPlaceholder('pp.kk.vvvv');
    $now = date('j.n.Y');
    $age->setPattern('d-m-y');
    $age->setErrorMessage("Anna hakijan syntymäaika muodossa <var>päivä.kuukausi.vuosi</var>. Esim. $now");

    $ageRow = new BasicRow();
    $ageRow->appendCell($age)->small(12)->medium(6);
    $form->append($ageRow);

    $fname = ValidableInlineInput::text('fname');
    $fname->setLeftInlineLabel('<i class="fa fa-user"></i>');
    $fname->setLabel('Etunimi <small class="required">pakollinen</small>');
    $fname->setPlaceholder('Etunimi');
    $fname->setRequired($required);
    $fname->setPattern('person_name');
    $fname->setErrorMessage('Hakijan etunimi puuttuu tai on virheellinen');


    $lname = ValidableInlineInput::text('lname');
    $lname->setLeftInlineLabel('<i class="fa fa-user"></i>');
    $lname->setLabel('Sukunimi <small class="required">pakollinen</small>');
    $lname->setPlaceholder('Sukunimi');
    $lname->setRequired($required);
    $lname->setPattern('person_name');
    $lname->setErrorMessage('Hakijan sukunimi puuttuu tai on virheellinen');

    $nameRow = new BasicRow();
    $nameRow->appendCell($fname)->small(12)->medium(6);
    $nameRow->appendCell($lname)->small(12)->medium(6);
    $form->append($nameRow);

    $street = ValidableInlineInput::text('street');
    $street->setLeftInlineLabel('<i class="fas fa-road"></i>');
    $street->setLabel('Katuosoite <small class="required">pakollinen</small>');
    $street->setPlaceholder('Katuosoite');
    $street->setRequired($required);
    $street->setErrorMessage('Anna hakijan katuosoite');


    $zipcode = ValidableInlineInput::text('zipcode');
    $zipcode->setLeftInlineLabel('<i class="fas fa-road"></i>');
    $zipcode->setLabel('Postinumero <small class="required">pakollinen</small>');
    $zipcode->setPlaceholder('Postinumero');
    $zipcode->setRequired($required);
    $zipcode->setErrorMessage('Anna hakijan postinumero');

    $city = ValidableInlineInput::text('city');
    $city->setLeftInlineLabel('<i class="fas fa-city"></i>');
    $city->setLabel('Kotikunta <small class="required">pakollinen</small>');
    $city->setPlaceholder('Kotikunta');
    $city->setRequired($required);
    $city->setPattern('finnish_municipalities');
    $city->setErrorMessage('Hakijan kotikunta puuttuu tai on virheellinen');

    $addressRow = new BasicRow();
    $addressRow->appendCell($street)->small(12)->large(5);
    $addressRow->appendCell($zipcode)->small(12)->medium(4)->large(3);
    $addressRow->appendCell($city)->small(12)->medium(8)->large(4);
    $form->append($addressRow);

    $email = ValidableInlineInput::text('email');
    $email->setLeftInlineLabel('<i class="fas fa-at"></i>');
    $email->setLabel('Sähköpostiosoite <small class="required">pakollinen</small>');
    $email->setPlaceholder('joku@email.com');
    $email->setErrorMessage('Anna hakijan sähköpostiosoite oikeassa muodossa');
    $email->setRequired($required);
    $email->setPattern('email');

    $phone = ValidableInlineInput::text('phone');
    $phone->setLeftInlineLabel('<i class="fas fa-phone"></i>');
    $phone->setLabel('Puhelinnumero');
    $phone->setPlaceholder('+358 12 345 6789');
    $phone->setErrorMessage('Virheellinen puhelinnumero');
    $phone->setPattern('phone');

    $contactRow = new BasicRow();
    $contactRow->appendCell($email)->small(12)->medium(6);
    $contactRow->appendCell($phone)->small(12)->medium(6);
    $form->append($contactRow);

    $additionalInfo = ValidableInlineInput::textarea('information');
    $additionalInfo->setLabel('Lisätietoja');
    $additionalInfo->setPlaceholder('Muuita tietoa . . . ');
    $additionalInfo->setRows(4);

    $infoRow = new BasicRow();
    $infoRow->appendCell($additionalInfo)->small(12);
    $form->append($infoRow);

    $buttons = new ButtonGroup();
    $buttons->appendPushButton('<i class="fas fa-envelope"></i> Lähetä')->addCssClass('success', 'submitter');
    $buttons->appendResetter('<i class="fas fa-undo-alt"></i> Tyhjennä')->addCssClass('alert');
    $buttons->addCssClass('text-center');

    $buttonRow = new BasicRow();
    $buttonRow->appendCell($buttons);
    $form->append($buttonRow);
    $form->liveValidate();
    return $form;
  }

}
