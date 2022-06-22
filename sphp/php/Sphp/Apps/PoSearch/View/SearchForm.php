<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\PoSearch\View;

use Sphp\Html\AbstractContent;
use Sphp\Bootstrap\Components\ToolBar;
use Sphp\Bootstrap\Components\Forms\InputGroup;
use Sphp\DateTime\ImmutableDate;
use Sphp\Html\Forms\Inputs\Menus\Select;
use Sphp\Html\Forms\Inputs\SearchInput;
use Sphp\Html\Forms\Buttons\SubmitButton;
use Sphp\Html\Forms\Form;
use Sphp\Apps\PoSearch\Data\RequestData;
use Sphp\Apps\PoSearch\Data\FileBrowser;
use Sphp\Bootstrap\Components\Forms\SwitchBoard;
use Sphp\Bootstrap\Components\Dropdown;

/**
 * Class SearchForm
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class SearchForm extends AbstractContent {

  private FileBrowser $files;
  private RequestData $requestData;

  public function __construct(FileBrowser $files, ?RequestData $requestData = null) {
    $this->files = $files;
    if ($requestData === null) {
      $requestData = new RequestData();
    }
    $this->requestData = $requestData;
  }

  public function __destruct() {
    unset($this->files, $this->requestData);
  }

  public function createToolbar(): ToolBar {
    $tb = new ToolBar('Translator search engine');
    $tb->addCssClass('mx-2');

    $tb->appendInputGroup($this->createFileMenu());
    $tb->append($this->createFileSelector());
    $tb->append($this->createTypeSelector());
    $tb->appendInputGroup($this->createMsgTypeMenu());
    $tb->appendInputGroup($this->createSearchField());
    $tb->appendInputGroup($this->createPerPageMenu());

    $tb->appendButton((new SubmitButton('<i class="fas fa-search"></i> <strong>FIND</strong>'))
                    ->addCssClass('btn-success'))
            ->addCssClass('mb-1');
    return $tb;
  }

  public function createMsgTypeMenu(): InputGroup {
    $ruleMenu = (new Select('type'));
    $ruleMenu->appendOption('any', 'any', true);
    $ruleMenu->appendOption('singular', 'singular');
    $ruleMenu->appendOption('plural', 'plural');
    //$ruleMenu->appendOption('fuzzy', 'fuzzy');
    if ($this->requestData->getType() !== null) {
      $ruleMenu->setInitialValue($this->requestData->getType());
    }
    $group1 = new InputGroup($ruleMenu);
    $group1->prependLabel('Entry type:');
    $group1->addCssClass('me-1 mb-1');
    return $group1;
  }

  public function createTypeSelector(): Dropdown {
    $data = $this->requestData->getTypes();
    $b = new SwitchBoard();
    $b->addCssClass('m-2');
    $b->setToggler('Any type', 'types[]', 'all');
    $b->appendNewSwitch('types[]', 'singular', 'Singular')->setChecked(in_array('singular', $data));
    $b->appendNewSwitch('types[]', 'plural', 'Plural')->setChecked(in_array('plural', $data));
    $b->appendNewSwitch('types[]', 'fuzzy', 'Fuzzy')->setChecked(in_array('fuzzy', $data));
    $dd = Dropdown::fromButton('Type');
    $dd->getToggler()->addCssClass('btn btn-outline-secondary me-1 mb-1');
    $dd->appendContent($b);
    $dd->setAutoClose('outside')->setOffset(2, 2);

    return $dd;
  }

  public function createSearchField(): InputGroup {
    $searchInput = (new SearchInput('search'))
            ->setSize(20)
            ->setPlaceholder('Search text');
    if ($this->requestData->getSearch() !== null) {
      $searchInput->setInitialValue($this->requestData->getSearch());
    }
    $group2 = new InputGroup($searchInput);
    $group2->prependLabel('msgid contains::');
    $group2->addCssClass('me-1 mb-1');
    return $group2;
  }

  public function createFileSelector(): Dropdown {
    $data = $this->requestData->getFileHashes();
    $b = new SwitchBoard();
    $b->addCssClass('m-2');
    $b->setToggler('All', 'types[]', 'all');
    $b->appendText('POT-files:');
    foreach ($this->files->getPotFiles() as $key => $value) {
      $b->appendNewSwitch('files[]', $key, $value->getFileName())->setChecked(in_array($key, $data));
    }
    $groups = [];
    foreach ($this->files->getPoFiles() as $key => $value) {
      if (!array_key_exists($value->getLang(), $groups)) {
        // $groups[$value->getLang()] = $select->appendOptgroup('Language: ' . $value->getLang());
      }
      //$groups[$value->getLang()]->appendOption($key, $value->getFileName());
    }
    $dd = Dropdown::fromButton('Files');
    $dd->getToggler()->addCssClass('btn btn-outline-secondary me-1 mb-1');
    $dd->appendContent($b);
    $dd->setAutoClose('outside');

    return $dd;
  }

  public function createFileMenu(): InputGroup {
    $select = new Select('hash');
    $select->appendOption(null, 'Select file');
    //$select->appendArray($this->files);
    $templateGroup = $select->appendOptgroup('Templates:');
    foreach ($this->files->getPotFiles() as $key => $value) {
      $templateGroup->appendOption($key, $value->getFileName());
    }
    $groups = [];
    foreach ($this->files->getPoFiles() as $key => $value) {
      if (!array_key_exists($value->getLang(), $groups)) {
        $groups[$value->getLang()] = $select->appendOptgroup('Language: ' . $value->getLang());
      }
      $groups[$value->getLang()]->appendOption($key, $value->getFileName());
    }
    if ($this->requestData->getHash() !== null) {
      $select->setInitialValue($this->requestData->getHash());
    }
    $group = new InputGroup($select);
    $group->prependLabel('File:');
    $group->addCssClass('me-1 mb-1');
    return $group;
  }

  public function createPerPageMenu(): InputGroup {
    $vals = [10, 20, 50];
    foreach ($vals as $i) {
      $perPageOptions[$i] = "$i";
    }
    $select = new Select('view', $perPageOptions);
    $select->setInitialValue($this->requestData->getSliceSize());
    $group = new InputGroup($select);
    $group->prependLabel('Show:');
    $group->addCssClass('me-1 mb-1');
    return $group;
  }

  public function getHtml(): string {
    $form = new Form('/po', 'get');
    $form->useValidation(false);
    $form->addCssClass('po my-1 py-2');
    $form->append(\Sphp\Html\Tags::h3());
    $form->append($this->createToolbar());
    return $form->getHtml();
  }

  /**
   * 
   * @param  ImmutableDate $date
   * @return MonthSelector new instance
   */
  public static function fromDate(ImmutableDate $date): MonthSelector {
    return new static($date->getYear(), $date->getMonth());
  }

}
