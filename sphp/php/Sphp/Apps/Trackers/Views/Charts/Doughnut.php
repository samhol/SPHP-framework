<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Views\Charts;

use Sphp\Html\AbstractContent;
use Sphp\Html\Media\Canvas;

/**
 * Class Pie
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Doughnut extends AbstractContent {

  /**
   * @var string
   */
  private $dataUrl;

  public function __construct(string $dataUrl) {
    $this->setDataUrl($dataUrl);
    //<canvas id="doughnut33" data-json-data-url="/app/stats-app/ajax/json.php?userCount" style="display: block; height: 483px; width: 566px;"></canvas>
  }

  public function setDataUrl(string $dataUrl) {
    $this->dataUrl = $dataUrl;
    return $this;
  }

  public function getDataUrl(): string {
    return $this->dataUrl;
  }

  public function createCanvas(): Canvas {
    $canvas = new Canvas();
    $canvas->setAttribute('data-json-url', $this->getDataUrl());
    $canvas->setSize(250, 250);
    return $canvas;
  }

  public function getHtml(): string {
    return $this->createCanvas()->getHtml();
  }

}
