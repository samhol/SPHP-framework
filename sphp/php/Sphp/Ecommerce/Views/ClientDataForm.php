<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Ecommerce\Views;

use Sphp\Html\AbstractContent;
use Sphp\Bootstrap\Components\Forms\ValidableInputCol;
use Sphp\Bootstrap\Layout\Row;
use Sphp\Html\Forms\Form;
use Sphp\Html\Forms\Fieldset;
use Sphp\Security\CRSFToken;
use Sphp\Html\Forms\Buttons\SubmitButton;

/**
 * The ClientDataForm class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ClientDataForm extends AbstractContent {

  private array $data;

  public function __construct(array $data = []) {
    $this->data = $data;
  }

  protected function buildForm(): Form {
    $form = new Form('/save-customer.php', 'post');
    $form->append($this->buildClientInfoInputs());
    $form->append($this->buildSubmitter());
    $form->addCssClass('needs-validation');
    $form->useValidation(false);
    $tokenInput = new CRSFToken( );
    $form->append($tokenInput->insertIntoForm($form, 'customer-token'));
    return $form;
  }

  protected function buildSubmitter(): SubmitButton {
    $submitter = new SubmitButton('Tallenna tietosi');
    return $submitter;
  }

  protected function buildClientInfoInputs(): Fieldset {

    $fieldset = new Fieldset('yhteystietosi:');
    $fieldset->addCssClass('m-3');
    $row = new Row;
    $row->setGutters('g-3');

    $fnameInput = ValidableInputCol::text('fname');
    $fnameInput->default(12)->md(6)
            ->setFloatingLabel('Etunimi')
            ->setRequired(true)
            ->setValidToolTip('Etunimi on annettu')
            ->setInvalidToolTip('Ole hyvä ja anna etunimesi');
    $row->appendColumn($fnameInput);

    $lnameInput = ValidableInputCol::text('lname');
    $lnameInput->default(12)->md(6)
            ->setRequired(true)
            ->setFloatingLabel('Sukunimi')
            ->setValidToolTip('Sukunimi on annettu')
            ->setInvalidToolTip('Ole hyvä ja anna sukunimesi');
    $row->appendColumn($lnameInput);

    $phoneInput = ValidableInputCol::text('phone');
    $phoneInput->default(12)->md(6)
            ->setRequired(true)
            ->setFloatingLabel('Puhelinnumero')
            ->setInvalidToolTip('Virheellinen puhelinnumero');
    $row->appendColumn($phoneInput);

    $emailInput = ValidableInputCol::text('email');
    $emailInput->default(12)->md(6)
            ->setRequired(true)
            ->setFloatingLabel('Sähköpostiosoite')
            ->setInvalidToolTip('Virheellinen sähköpostiosoite');
    $row->appendColumn($emailInput);

    $streetInput = ValidableInputCol::text('address_street');
    $streetInput->default(12)->md(6)
            ->setRequired(true)
            ->setFloatingLabel('Katuosoite')
            ->setValidToolTip('Katuosoite on annettu')
            ->setInvalidToolTip('Virheellinen katuosoite');
    // ->getInput()->setPlaceholder('Katuosoite');
    $row->appendColumn($streetInput);

    $zipInput = ValidableInputCol::text('address_zip');
    $zipInput->default(12)->md(3)
            ->setRequired(true)
            ->setFloatingLabel('Postinumero')
            ->setValidToolTip('Postinumero on annettu')
            ->setInvalidToolTip('Virheellinen postinumero');
    $row->appendColumn($zipInput);

    $cityInput = ValidableInputCol::text('address_city');
    $cityInput->default(12)->md(3)
            ->setRequired(true)
            ->setFloatingLabel('Kunta')
            ->setValidToolTip('Kunnan nimi on annettu')
            ->setInvalidToolTip('Virheellinen kunnan nimi');
    $row->appendColumn($cityInput);

    $fieldset->append($row);
    $commonRow = new Row;
    $agreedInput = ValidableInputCol::checkbox('agreed');
    $agreedInput->default(12)->md(3)->addCssClass('p-3')
            ->setRequired(true)
            ->setLabelText('Hyväksyn toimitusehdot')
            ->setValidToolTip('Toimitusehdot on hyväksytty')
            ->setInvalidToolTip('Ole hyvä ja hyväksy toimitusehdot');
    $commonRow->appendColumn($agreedInput);
    $commonRow->setGutters('g-3');
    $fieldset->append($commonRow);
    return $fieldset;
  }

  public function getHtml(): string {
    return $this->buildForm()->getHtml();
  }

}
