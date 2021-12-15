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

use Sphp\Html\Sections\Section;
use Sphp\Html\AbstractContent;
use ATC\Contact\DataObject;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Media\Icons\IconTag;
use Sphp\Apps\Trackers\Data\UserAgents\UserAgent;
use Sphp\Apps\Trackers\Data\UserAgents\UserAgentShareData;
use Sphp\Html\Lists\Ul;

/**
 * Class SearchEngineResultView
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SearchEngineResultView extends AbstractContent {

  /**
   * @var UserAgentShareData 
   */
  private $userAgentShareData;

  /**
   * @var UserAgent 
   */
  private $userAgent;

  /**
   * Constructor
   * 
   * @param UserAgent $ua
   */
  public function __construct(UserAgentShareData $ua = null) {
    $this->userAgentShareData = $ua;
    $this->userAgent = $ua->getUserAgent();
    //$this->fa = new FontAwesome();
    //$this->fa->fixedWidth(true);
  }

  public function __destruct() {
    unset($this->fa, $this->userAgent, $this->userAgentShareData);
  }

  public function getHtml(): string {
    $sect = new Section();
    $sect->addCssClass('ua-search-result');
    if ($this->userAgent->isUnknown()) {
      $sect->appendH2('User Agent is unknown!');
      $sect->append('<div class="ua-string">' . $this->userAgent->raw . '</div>');
    } else {
      $sect->append('<div class="ua-string">' . $this->userAgent->raw . '</div>');
      $sect->appendH2(UserAgentViews::buildHeading($this->userAgent));
      $sect->append($this->buildShare());
      $sect->append(UserAgentViews::buildGeneralInformationView($this->userAgent));
      $sect->append(UserAgentViews::buildDeviceInformation($this->userAgent));
      $sect->append(UserAgentViews::buildPlatformInformation($this->userAgent));
      $sect->append(UserAgentViews::buildRenrerEngineInformation($this->userAgent));
      $sect->append(UserAgentViews::buildSupportList($this->userAgent));
    }
    $var = \Sphp\Html\Tags::pre();
    foreach ((array) $this->userAgent->getBrowsCapData() as $k => $v) {
      $val = '(' . gettype($v) . ') ' . var_export($v, true);
      $var->append("$k => $val\n");
    }
    $sect->append($var);
    return $sect->getHtml();
  }

  private function buildShare() {
    $div = \Sphp\Html\Tags::div('<strong>Traffic Share:</strong> ')->addCssClass('share');
    $div->append(\Sphp\Html\Tags::span(round((100 * $this->userAgentShareData->getShare()), 3) . '%'));
    return $div;
  }

  private function buildHeading(UserAgent $ua): string {
    $out = '';
    $out .= $this->createIcon($ua) . ' ' . $ua->getModel();
    if ($ua->version !== '0.0') {
      $out .= " $ua->version";
    }
    if ($ua->browser_maker !== 'unknown') {
      $out .= ' <small> by ' . $ua->browser_maker . '</small>';
    }
    return $out;
  }

  private function buildGeneralInformationView(UserAgent $ua): string {
    $out = "General information\n";
    //$out .= " :**User agent string:** <span class=\"ua-string\">$ua->raw</span>\n";
    $out .= " :**user agent type:** " . $ua->getUserAgentType() . "\n";
    $out .= " :**manufacturer:**:  " . $ua->getMaker() . "\n";
    $bits = $ua->browser_bits;
    if ($bits > 0) {
      $out .= " :**bit version:**: $ua->browser_bits bit edition\n";
    }
    return $out;
  }

  private function createIcon(UserAgent $ua): ?IconTag {
    $icon = null;
    $fa = new FontAwesome();
    $fa->fixedWidth(true);
    //$fa->setSize('2x');
    switch ($ua->getName()) {
      case 'Chrome':
        $icon = $fa->createIcon('fab fa-chrome');
        break;
      case 'Edge':
        $icon = $fa->createIcon('fab fa-edge');
        break;
      case 'Safari':
        $icon = $fa->createIcon('fab fa-safari');
        break;
      case 'Opera':
        $icon = $fa->createIcon('fab fa-opera');
        break;
      case 'Firefox':
        $icon = $fa->createIcon('fab fa-firefox-browser');
        break;
      case 'IE':
        $icon = $fa->createIcon('fab fa-internet-explorer');
        break;
    }
    if ($icon === null) {
      switch ($ua->getMaker()) {
        case 'Google Inc':
          $icon = $fa->createIcon('fab fa-chrome');
          break;
        case 'Microsoft Corporation':
          $icon = $fa->createIcon('fab fa-microsoft');
          break;
        case 'Apple Inc':
          $icon = $fa->createIcon('fab fa-apple');
          break;
        case 'Java Standard Library':
          $icon = $fa->createIcon('fab fa-java');
          break;
      }
    }
    if ($icon === null && $ua->isCrawler()) {
      $icon = $fa->createIcon('fas fa-robot');
    }
    return $icon;
  }

  public function buildSupportList(UserAgent $ua): Ul {
    $ul = new Ul();
    $fa = new FontAwesome();
    $fa->fixedWidth(true);
    $fa->setSize('lg');
    if ($ua->supportsJavaScript()) {
      $ul->append($fa->createIcon('fab fa-js') . ' JavaScript support');
    }
    if ($ua->getCssVersion() === 3) {
      $ul->append($fa->createIcon('fab fa-css3') . ' CSS3 support');
    }
    if ($ua->supportsCookies()) {
      $ul->append($fa->createIcon('fas fa-cookie-bite') . ' Cookie support');
    }
    if ($ua->supportsJavaApplets()) {
      $ul->append($fa->createIcon('fab fa-java') . ' Java Applets support');
    }
    return $ul;
  }

}
