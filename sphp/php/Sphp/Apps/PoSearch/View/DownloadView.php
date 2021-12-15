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
use Sphp\Html\Sections\Section;
use Sphp\Html\Tags;
use Sphp\Apps\PoSearch\Data\FileBrowser;

/**
 * The DownloadView class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DownloadView extends AbstractContent {

  private FileBrowser $files;
  private string $root;

  public function __construct(FileBrowser $Files, string $root = '') {
    $this->files = $Files;
    $this->root = $root;
  }

  public function __destruct() {
    unset($this->files);
  }

  public function getHtml(): string {
    $section = Tags::div()->addCssClass('po download m-3');
    $section->appendH3('Downloadable Gettext po- and mo-files');
    $list = new \Sphp\Html\Lists\Dl;
    $list->addCssClass('mx-2 mb-5');
    $section->append($list);
    foreach ($this->files->getFormData() as $lang => $paths) {
      $list->appendTerm("$lang:");
      foreach ($paths as $hash => $filename) {
        $poFile = $this->files->getFile($hash);
        $spl = $poFile->getFileInfo();
        $ext = strtoupper($spl->getExtension());
        $out = "<var>{$poFile->getFileName()}: </var>";
        $out .= Tags::a($this->root . "?po&hash=" . $poFile->getHash(), 'Download ' . $ext . '-file')->setAttribute('download', true)->addCssClass('po');
        if ($poFile instanceof \Sphp\Apps\PoSearch\Data\PoFile && $poFile->hasMoFile()) {
          $out .= ' | ' . Tags::a($this->root . "?mo&hash=" . $poFile->getHash(), 'Download MO-file')->setAttribute('download', true)->addCssClass('mo');
        }
        $list->appendDescription($out)->addCssClass('ms-3 p-0');
      }
    }
    return $section->getHtml();
  }

}
