<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers;

use Sphp\Apps\Trackers\Data\UserAgents\UserAgentParser;
use Sphp\Apps\Trackers\Views\UserAgents\SearchEngineFormView;
use Sphp\Apps\Trackers\Views\UserAgents\SearchEngineResultView;
use Sphp\Apps\Trackers\Data\UserAgents\UserAgentShareData;
use Sphp\Apps\Trackers\Data\UserAgents\UserAgent;
use Sphp\Apps\Trackers\Data\UserAgents\UserAgents;
/**
 * Class SearchEngine
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SearchEngine {

  /**
   * @var UserAgents
   */
  private $parser;
  private $executed = false;
  private $searchEngineForm;

  public function __construct(UserAgents $parser = null) {
    if ($parser === null) {
      $parser = UserAgentParser::instance();
    }
    $this->parser = $parser;
    $this->searchEngineForm = new SearchEngineFormView('/stats/ua/search');
    $this->out = '';
  }

  public function __destruct() {
    unset($this->parser, $this->searchEngineForm);
  }

  public function getView() {
    return $this->out;
  }

  public function getUserAgent(): ?UserAgentShareData {
    if (filter_has_var(INPUT_GET, 'current-ua')) {
      $uaString = \Sphp\Network\Utils::getHttpUserAgent();
    } else if (filter_has_var(INPUT_GET, 'ua')) {
      $uaString = filter_input(INPUT_GET, 'ua', FILTER_SANITIZE_STRING);
    } else {
      $uaString = null;
    }
    if ($uaString !== null) {
      $userAgent = $this->parser->getUserAgentShareData($uaString);
      //$userAgent->raw = $uaString;
    } else {
      $userAgent = null;
    }
    return $userAgent;
  }

  public function run() {
    $ua = $this->getUserAgent();
    if ($ua !== null) {
      // $this->searchEngineForm->setFormData($ua->raw);
    }
    $this->out = '';
    $this->out .= $this->searchEngineForm;
    $userAgent = $this->getUserAgent();
    if ($userAgent !== null) {
      $this->executed = true;
     // print_r($ua);
      $this->out .= new SearchEngineResultView($userAgent);
    }
    return $this;
  }

}
