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
use Sphp\Html\Tags;
use Sepia\PoParser\Catalog\Entry;
use Sphp\Bootstrap\Components\ButtonGroup;
use Sphp\Html\Lists\Dl;
use Sphp\Html\Layout\Section;
use Sphp\Apps\PoSearch\Data\EntryContainerFile;
use Sphp\Apps\PoSearch\Data\PoEntryCollection;
use Sphp\Apps\PoSearch\Data\PoFile;

/**
 * The ResultSynopsis class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ResultSynopsis extends AbstractContent {

  /**
   * @var Entry[]
   */
  private iterable $entries;
  private ?float $duration;
  private EntryContainerFile $file;

  public function __construct(iterable $entries, ?float $duration, EntryContainerFile $file) {
    $this->entries = $entries;
    $this->duration = $duration;
    $this->file = $file;
  }

  public function __destruct() {
    unset($this->entries, $this->file);
  }

  protected function getFileInfo(): Section {
    $list = new Dl();
    $list->addCssClass('ps-3 px-1');
    $tot = $this->file->count();
    $p = $this->file->getEntryCollection()->count(PoEntryCollection::PLURALS);
    $s = $this->file->getEntryCollection()->count(PoEntryCollection::SINGULARS);
    $list->appendTerm('File contains total <var>' . $tot . '</var> entries');
    $list->appendDescription('plural entries: <var>' . $p . '</var>');
    $list->appendDescription(' singular entries: <var>' . $s . '</var>');
    $list->appendTerm('Found <var>' . count($this->entries) . '</var> matches (in ' . round($this->duration, 3) . ' milliseconds) ');
    $out = new Section();
    $out->appendH3('Searching entries from <small>' . $this->file->getFileName() . '.' . $this->file->getFileInfo()->getExtension() . '</small> file:')
            ->addCssClass('p-2 m-1');
    $out->append($list);
    return $out;
  }

  public function buildDownloadButtons(): ButtonGroup {
    $buttons = new ButtonGroup('Gettext File load links');
    $buttons->addCssClass('btn-group-sm my-2 mx-4 ');
    $href = '/po-app/download-file.php?po&hash=' . $this->file->getHash();
    $dlIcon = '<i class="fas fa-download fa-fw"></i>';
    $cont = "$dlIcon <strong>Download PO-file</strong>";
    $buttons->appendHyperlink($href, $cont)
            ->addCssClass('btn-success p-2')
            ->setAttribute('download', true);
    if ($this->file instanceof PoFile && $this->file->hasMoFile()) {
      $cont = "$dlIcon <strong>Download MO-file</strong>";
      $href = '/po-app/download-file.php?mo&hash=' . $this->file->getHash();
      $buttons->appendHyperlink($href, $cont)
              ->addCssClass('btn-danger p-2')
              ->setAttribute('download', true);
    }
    return $buttons;
  }

  public function getHtml(): string {
    /* echo '<pre>';
      print_r( $this->file->getEntryCollection()->getCatalog()->getHeader()->asArray());
      print_r( $this->file->getEntryCollection()->getCatalog()->getHeaders());
      echo '</pre>'; */
    $out = Tags::div()->addCssClass('po synopsis my-1');
    $out->append($this->getFileInfo());
    $out->append($this->buildDownloadButtons());
    return $out->getHtml();
  }

}
