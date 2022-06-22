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

use Sphp\Ecommerce\Data\Product;
use Sphp\Html\AbstractContent;
use Sphp\Bootstrap\Components\Forms\ValidableInputCol;
use Sphp\Bootstrap\Layout\Row;
use Sphp\Html\Forms\Form;
use Sphp\Security\CRSFToken;
use Sphp\Html\Forms\Buttons\SubmitButton;
use Sphp\Bootstrap\Components\Forms\LabelledInput;
use Sphp\Forms\NumberInputToolBar;

/**
 * The ClientDataForm class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ProductDataForm extends AbstractContent {

  private ?Product $product;
  private string $action;
  private ?string $method;

  public function __construct(string $action = '/save-customer.php', ?string $method = null) {
    $this->action = $action;
    $this->method = $method;
    $this->setProduct(null);
  }

  public function __destruct() {
    unset($this->product);
  }

  public function setProduct(?Product $product): void {
    if ($product === null) {
      $product = new \Sphp\Ecommerce\Data\SimpleProduct([]);
    }
    $this->product = $product;
  }

  protected function buildForm(): Form {
    $form = new Form($this->action, $this->method);
    $form->addCssClass('m-3');
    $form->setEnctype('multipart/form-data');
    $form->append('<h3>Product data:</h3>');
    $form->append($this->buildProductInputs());
    $form->append($this->buildSubmitter());
    $form->addCssClass('needs-validation');
    $form->useValidation(false);
    $tokenInput = new CRSFToken();
    $form->append($tokenInput->insertIntoForm($form, 'product-token'));
    return $form;
  }

  protected function buildSubmitter(): SubmitButton {
    $submitter = new SubmitButton('Save Product');
    return $submitter;
  }

  private function buildTitleField(): ValidableInputCol {
    $input = ValidableInputCol::text('title', $this->product->getName());
    $input->default(12)->md(6)
            ->setRequired(true)
            ->setFloatingLabel('Product Title')
            ->setValidToolTip('Product title is OK')
            ->setInvalidToolTip('Please add Product title');
    return $input;
  }

  private function buildCatField(): ValidableInputCol {
    $input = ValidableInputCol::text('cat', $this->product->getCategory());
    $input->md(6)
            ->setRequired(true)
            ->setFloatingLabel('Product Category')
            ->setValidToolTip('Product Category is OK')
            ->setInvalidToolTip('Please add Product Category');
    return $input;
  }

  private function buildIdField(): ValidableInputCol {
    $input = ValidableInputCol::text('id', $this->product->getId());
    $input->default(12)->md(6)
            ->setFloatingLabel('Product ID')
            ->setRequired(true)
            ->setValidToolTip('Product ID is OK')
            ->setInvalidToolTip('Please add Product ID');
    return $input;
  }

  private function buildPriceField(): LabelledInput {
    $input = LabelledInput::number('price', $this->product->getPrice());
    $input->getInput()->addCssClass('no-controls');
    $input->prependLabel('Price:');
    $input->appendText('€');
    $input->setRequired(true)
            ->setValidToolTip('Product Price is OK')
            ->setInvalidToolTip('Please add Product Price');
    return $input;
  }

  private function buildTaxField(): LabelledInput {
    $input = LabelledInput::number('tax', $this->product->getTax());
    $input->getInput()->addCssClass('no-controls');
    $input->prependLabel('Tax:');
    $input->appendText('%');
    $input->setRequired(true)
            ->setValidToolTip('Product Tax is OK')
            ->setInvalidToolTip('Please add Product Tax');
    return $input;
  }

  private function buildDescriptionField(): ValidableInputCol {
    $input = ValidableInputCol::textarea('description', $this->product->getDescription());
    $input->getInput()->css()->setProperty('height', '100px');
    $input->setFloatingLabel('Product Description')
            ->setValidToolTip('Product Description is OK')
            ->setInvalidToolTip('Please add Product Description');
    return $input;
  }

  private function buildProductInputs(): Row {
    $row = new Row;
    $row->setGutters('g-3');

    $countInput = new NumberInputToolBar('count', 1);
    $countInput->getInput()->setRange(0, null);
    $row->appendColumn('Product Count:' . $countInput)->default(12);
    $row->appendColumn($this->buildTitleField());
    $row->appendColumn($this->buildIdField());
    $row->appendColumn($this->buildCatField());
    $row->appendColumn($this->buildFileInput());
    $row->appendColumn($this->buildPriceField())->default(12)->md(6);
    $row->appendColumn($this->buildTaxField())->default(4)->md(3);
    $row->appendColumn($this->buildDescriptionField())->default(12);

    return $row;
  }

  private function buildFileInput() {
    $div = new \Sphp\Html\Div();
    $photoFileInput = LabelledInput::file('photo');

    $photoFileInput->prependLabel('Product photo');
    $photoFileInput
            ->setValidToolTip('Product photo is OK')
            ->setInvalidToolTip('Please add Product photo');
    if (is_file($this->product->getImgPath())) {
      $photoFileInput->setRequired(true);
    } else {
      $div->append('<strong>CurrentPhoto:</strong> ');
      $div->append('<var>' . $this->product->getImgPath() . '</var>');
      $photoFileInput->setRequired(false);
    }
    return $div . $photoFileInput;
  }

  public function getHtml(): string {
    return $this->buildForm()->getHtml();
  }

}
