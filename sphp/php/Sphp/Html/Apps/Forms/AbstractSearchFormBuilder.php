<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\Forms;

use Sphp\Html\Forms\Form;
use Sphp\Html\Foundation\Sites\Forms\Inputs\InputGroup;
use Sphp\Html\Forms\Inputs\SearchInput;
use Sphp\Html\Forms\Buttons\SubmitterInterface;
use Sphp\Html\Forms\Buttons\Submitter;
use Sphp\Html\Forms\Inputs\HiddenInputs;
use Sphp\Html\Media\Icons\FA;
use Sphp\Html\AbstractComponent;
use Sphp\Html\Forms\ContainerForm;
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

  /**
   * @var HiddenInputs
   */
  private $hiddenData;

  /**
   * @var SearchInput
   */
  private $searchField;

  /**
   * @var Submitter
   */
  private $submitButton;

  /**
   * Constructor
   */
  public function __construct() {
    $this->setSubmitButton(new Submitter(FA::search('Search')));
    $this->hiddenData = new HiddenInputs();
    $this->searchField = new SearchInput();
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->hiddenData, $this->searchField, $this->submitButton);
  }

  abstract public function createEmptyForm(): ContainerForm;

  public function buildInputGroupForm(string $label = null): ContainerForm {
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

  public function buildMenuForm(): ContainerForm {
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
   * @return SubmitterInterface
   */
  public function getSubmitButton(): SubmitterInterface {
    $submitButton = new Submitter(FA::search('Search'));
    $submitButton->cssClasses()->protectValue('button');
    return $submitButton;
  }

  /**
   * 
   * @param  Submitter $submitButton
   * @return $this
   */
  public function setSubmitButton(SubmitterInterface $submitButton) {
    $this->submitButton = $submitButton;
    $this->submitButton->cssClasses()->protectValue('button');
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
