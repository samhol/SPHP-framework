<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers;

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
    $ul = new \Sphp\Html\Lists\Ul;
    foreach ($this->browserData as $key => $value) {
      $ul->append("$value->userAgent: $value->count");
    }
    return $ul;
  }

}
