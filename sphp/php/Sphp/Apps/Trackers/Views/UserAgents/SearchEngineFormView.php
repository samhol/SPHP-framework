<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Views\UserAgents;

use Sphp\Html\AbstractContent;
use Sphp\Foundation\Sites\Forms\Inputs\ValidableInlineInput;
use Sphp\Foundation\Sites\Forms\GridForm;
use Sphp\Foundation\Sites\Grids\BasicRow;
use ATC\Contact\DataObject;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Media\Icons\FontAwesomeIcon;

/**
 * Class SearchEngine
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SearchEngineFormView extends AbstractContent {

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

  public function setFormData(string $memberData = null) {
    $this->data = $memberData;
    return $this;
  }

  /**
   * 
   * @return GridForm
   */
  public function buildForm(): GridForm {
    $form = new GridForm();
    $form->addCssClass('ua-search-form');
    $form->setMethod('get');
    $form->setAction($this->getAction());
    $form->setFormErrorMessage($this->fa('fas fa-exclamation-triangle fa-lg') . ' <strong>Search form is invalid</strong>');
    $form->append($this->buildSearchFieldRow());
    $form->append($this->buildButtonRow());
    $form->useValidation(false);
    $form->liveValidate();
    return $form;
  }

  private function buildSearchFieldRow(): BasicRow {
    $nameRow = new BasicRow();
    $name = ValidableInlineInput::text('ua');
    if ($this->data !== null) {
      $name->getInput()->setInitialValue($this->data);
    }
    $name->setLeftInlineLabel($this->fa('far fa-user-circle'));
    $name->setLabel('User Agent string <small class="required">is required</small>');
    $name->setPlaceholder('Search for User Agent information');
    $name->setRequired(true);
    //$name->setPattern('person_name');
    $name->setErrorMessage('Enter a User Agent string');
    $nameRow->appendCell($name)->small(12);
    return $nameRow;
  }

  private function buildButtonRow(): BasicRow {
    $group = new \Sphp\Foundation\Sites\Buttons\ButtonGroup;
    // $group->addCssClass('radius');
    $buttonRow = new BasicRow();
    $group->appendSubmitter($this->fa('fas fa-search') . ' search');
    $group->appendHyperlink('?current-ua', $this->fa('fas fa-user') . ' current user agent');
    $buttonRow->appendCell($group)->auto();
    return $buttonRow;
  }

  public function getHtml(): string {
    return $this->buildForm()->getHtml();
  }

}
