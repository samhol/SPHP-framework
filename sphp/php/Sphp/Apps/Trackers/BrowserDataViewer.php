<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers;

use Sphp\Html\Tables\Table;
use Doctrine\Common\Cache\FilesystemCache;
use Roave\DoctrineSimpleCache\SimpleCacheAdapter;
use Monolog\Logger;
use BrowscapPHP\Browscap;

/**
 * Description of BrowserDataViewer
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BrowserDataViewer {

  /**
   * @var iterable
   */
  private $browserData;

  public function __construct(iterable $browserData) {
    $this->browserData = $browserData;
  }

  public function __destruct() {
    unset($this->browserData);
  }

  public function run() {


    $fileCache = new FilesystemCache("./vendor/browscap/browscap-php/resources");
    $cache = new SimpleCacheAdapter($fileCache);

    $logger = new Logger('name');
    $bc = new Browscap($cache, $logger);
    $table = new Table();
    $table->setCaption('Browser data');
    $table->useThead()->thead()->appendHeaderRow(['Maker:', 'Browser:', 'Version:', 'Visits:']);
    $table->useTbody();

    $botTable = new Table();
    $botTable->addCssClass('hover table-scroll')->setCaption('Bots:');
    $botTable->useThead()->thead()->appendHeaderRow(['Maker:', 'Mark:', 'Version:', 'Visits:']);
    $botTable->useTbody();
    foreach ($this->browserData as $key => $value) {
      $browser = $bc->getBrowser($value->userAgent);
      if ($browser->crawler) {
        echo '<pre>';
        var_dump($browser);
        echo '</pre>';
      }
      if ($browser->crawler) {
        $botTable->tbody()->appendBodyRow([$browser->browser_maker, $browser->browser, $browser->version, $value->count]);
      } else {
        $table->tbody()->appendBodyRow([$browser->browser_maker, $browser->browser, $browser->version, $value->count]);
      }
    }
    return $table . $botTable;
  }

}
