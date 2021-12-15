<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\PoSearch;

use Sphp\DateTime\Time\StopWatch;
use Sphp\Apps\PoSearch\View\{
  ResultView,
  SearchForm,
  DownloadView,
  ResultSynopsis,
  PaginationView
};
use Sphp\Apps\PoSearch\Data\{
  FileBrowser,
  RequestData,
  PoEntryCollection,
  EntryContainerFile
};

/**
 * The SearchController class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SearchController {

  private RequestData $requestData;
  private ?PoEntryCollection $entries = null;
  private StopWatch $timer;
  private FileBrowser $poFiles;
  private ?EntryContainerFile $poFile = null;

  public function __construct(FileBrowser $poFiles) {
    $this->requestData = new RequestData($poFiles);
    $this->timer = new StopWatch();
    $this->timer->start();
    $this->poFiles = $poFiles;
    // $this->parsePathsAndCurrent();
    $this->parseEntries();
  }

  protected function parseEntries(): void {
    $hash = $this->requestData->getHash();
    if ($hash !== null && $this->poFiles->isValidHash($hash)) {
      $this->poFile = $this->poFiles->getFile($hash);
      $data = new Data\EntryFileFilter($this->poFile);
      $type = $this->requestData->getType();
      if ($type === 'plural') {
        $data->searchSingulars(false);
      } else if ($type === 'singular') {
        $data->searchPlurals(false);
      }
      if ($this->requestData->hasSearchValue()) {
        $data->searchIDsLike($this->requestData->getSearch());
      }
      $this->entries = $data->getIterator();
    } else {
      $this->poFile = null;
    }
    /* if ($this->poFile !== null) {
      $allEntries = $this->poFile->getEntryCollection();
      $type = $this->requestData->getType();
      if ($type === 'plural') {
      $allEntries->searchSingulars(false);
      } else if ($type === 'singular') {
      $allEntries->searchPlurals(false);
      }
      if ($this->requestData->hasSearchValue()) {
      $allEntries->searchIDsLike($this->requestData->getSearch());
      }
      $this->entries = $allEntries->getEntries();
      } */
  }

  protected function getCurrentSlice(): array {
    $count = $this->entries->count();
    $page = $this->requestData->getPage();
    $sliceSize = $this->requestData->getSliceSize();
    if ($count > $page * $sliceSize) {
      $first = $page * $sliceSize;
    } else {
      $this->requestData->setPage(0);
      $first = 0;
    }
    $slice = array_slice($this->entries->toArray(), $first, $sliceSize);
    return $slice;
  }

  public function run(): void {

    //echo '<pre>';
    //echo "</pre>"; 
    // $hash = ($this->poFile !== null) ? $this->poFile->getHash() : null;
    $form = new SearchForm($this->poFiles, $this->requestData);
    echo $form;
    if ($this->poFile === null) {
      echo new DownloadView($this->poFiles, 'po-app/download-file.php');
    } else {
      $page = $this->requestData->getPage();
      $firstIndex = $page * $this->requestData->getSliceSize() + 1;
      $slice = $this->getCurrentSlice();
      $rv = new ResultView($slice, $firstIndex);
      $this->timer->stop();
      $rs = new ResultSynopsis($this->entries, $this->timer->getMilliSeconds(), $this->poFile);
      echo $rs . $rv;

      echo '<hr>';
      echo new PaginationView($this->requestData, count($this->entries));
    }
  }

}
