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
use Sphp\Html\Scripts\Script;
use Sphp\Html\Scripts\ExternalScript;
use Sphp\Html\Div;

/**
 * Class TypeSharePie
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TypeSharePie extends AbstractContent {

  private $browserShare;

  public function __construct(float $browserShare) {
    $this->setBrowserShare($browserShare);
  }

  public function getSctipts(): Script {
    return new ExternalScript('https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.bundle.min.js');
  }

  public function getBrowserShare(): float {
    return $this->browserShare;
  }

  public function getCrawlerShare(): float {
    return 100 - $this->getBrowserShare();
  }

  public function setBrowserShare($browserShare) {
    $this->browserShare = $browserShare;
    return $this;
  }

  public function getHtml(): string {
    $canvas = new \Sphp\Html\Media\Canvas();
    $canvas->setSize(150, 150)->setAttribute('id', 'myPie');
    $wrapper = new Div($canvas);
    $wrapper->css()->setProperty('width', '250px');
    $script = <<<SCRIPT
<script>
  pieData = {
    datasets: [{
        data: [{$this->getBrowserShare()},{$this->getCrawlerShare()}],
        backgroundColor: [
          'rgba(103, 164, 70, 0.54)',
          'rgba(168, 117, 101, 0.3)'
        ],
        borderColor: [
          'rgba(242, 242, 242, 1)',
          'rgba(242, 242, 242, .7)'
        ],
        hoverBorderColor: [
          'rgba(242, 242, 242, .6)',
          'rgba(242, 242, 242, .6)'
        ],
        hoverBorderWidth: 2
      }],
    labels: [
      'Browsers',
      'Crawlers'
    ]
  };
      var doTooltip =  function (tooltipItem, data) {
              console.log(tooltipItem);
              var label, value, i = tooltipItem.datasetIndex;
              label = data.labels[tooltipItem.index] || '';
              value = data.datasets[i].data[tooltipItem.index];
              console.log(value, i);
              label += ': ' + value + '% of all traffic';
              return label;
            }
  window.onload = function () {

    var ctxPie = document.getElementById('myPie').getContext('2d');
    var myPieChart = new Chart(ctxPie, {
      type: 'doughnut',
      data: pieData,
      options: {
        tooltips: {
          callbacks: {
            label: doTooltip
          }
        }
      }
    });
  };
</script>
SCRIPT;

    return $wrapper . $script;
  }

}
