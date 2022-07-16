<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Forms;

use Sphp\Bootstrap\Components\Forms\InputGroup;
use Sphp\Html\Forms\Inputs\SearchInput;
use Sphp\Html\Forms\Buttons\Submitter;
use Sphp\Html\Forms\Buttons\SubmitButton;
use Sphp\Html\Forms\Inputs\HiddenInputs;
use Sphp\Html\Forms\Form;
use Sphp\Html\Tags;

/**
 * Implements an abstract search form
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
abstract class AbstractSearchFormBuilder {

  private HiddenInputs $hiddenData;

  
  private SearchInput $searchField;

  private SubmitButton $submitButton;

  /**
   * Constructor
   */
  public function __construct() {
    $this->setSubmitButton(new SubmitButton('<i class="fas fa-search"></i>'));
    $this->hiddenData = new HiddenInputs();
    $this->searchField = new SearchInput();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->hiddenData, $this->searchField, $this->submitButton);
  }

  abstract public function createEmptyForm(): Form;

  public function buildInputGroupForm(string $label = null): Form {
    $form = $this->createEmptyForm();
    $form->append($this->hiddenData);
    $group = new InputGroup();
    if ($label !== null) {
      $group->appendLabel($label);
    }
    $group->append($this->searchField);
    $group->append($this->submitButton);
    $form->append($group);
    return $form;
  }

  public function buildMenuForm(): Form {
    $form = $this->createEmptyForm();
    $form->append($this->hiddenData);
    $ul = Tags::ul();
    $ul->addCssClass('menu');
    $ul->append($this->searchField);
    $ul->append($this->submitButton);
    $form->append($ul);
    return $form;
  }

  /**
   * 
   * @return SearchInput
   */
  public function getSearchField(): SearchInput {
    return $this->searchField;
  }

  /**
   * Creates a new submitter
   * 
   * @return Submitter
   */
  public function getSubmitButton(): Submitter {
    $submitButton = new SubmitButton('<i class="fas fa-search"></i>');
    $submitButton->cssClasses()->protectValue('button');
    return $submitButton;
  }

  /**
   * 
   * @param  SubmitButton $submitButton
   * @return $this
   */
  public function setSubmitButton(Submitter $submitButton) {
    $this->submitButton = $submitButton;
    $this->submitButton->addCssClass('btn btn-success');
    return $this;
  }

  /**
   * 
   * @return HiddenInputs
   */
  public function getHiddenData(): HiddenInputs {
    return $this->hiddenData;
  }

  public function setHiddenData(array $hiddenData) {
    foreach ($hiddenData as $name => $value) {
      $this->hiddenData->insertVariable($name, $value);
    }
    return $this;
  }

}
