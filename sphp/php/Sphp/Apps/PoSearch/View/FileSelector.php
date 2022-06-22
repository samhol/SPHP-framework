<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
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
 * Class FileSelector
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FileSelector extends AbstractContent {

  private FileBrowser $files;
  private RequestData $requestData;

  public function __construct(FileBrowser $files, ?RequestData $requestData = null) {
    $this->files = $files;
    if ($requestData === null) {
      $requestData = new RequestData($files);
    }
    $this->requestData = $requestData;
  }

  public function __destruct() {
    unset($this->files, $this->requestData);
  }

  public function createFileSelector(): Dropdown {
    $data = $this->requestData->getFileHashes();
    $b = new SwitchBoard();
    $b->addCssClass('m-2');
    $b->setToggler('All', 'types[]', 'all');
    $b->appendText('POT-files:');
    $dd = Dropdown::fromButton('Files');
    $row = new \Sphp\Bootstrap\Layout\Row();
    foreach ($this->files->getPotFiles() as $key => $value) {
      $b->appendNewSwitch('files[]', $key, $value->getFileName());
    } 

    foreach ($this->files->getLanguages() as $lang) {
  
      $sb = new SwitchBoard($lang);
      $sb->setDescription($lang);
      $dd->appendContent($sb);
      foreach ($this->files->getPoFiles($lang) as $poFile) {

        $sb->appendNewSwitch('files[]', $key, $poFile->getFileName());
      }
    }
    $dd->getToggler()->addCssClass('btn btn-outline-secondary me-1 mb-1');
    $dd->appendContent($b);
    $dd->setAutoClose('outside');

    return $dd;
  }

  public function getHtml(): string {
    return $this->createFileSelector()->getHtml();
  }

}
