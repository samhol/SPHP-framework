<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Trackers\Data\UserAgents;

/**
 * AbstractUserAgent
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractUserAgent {

  /**
   * @var string
   */
  protected $name;

  /**
   * @var bool
   */
  protected $crawler;

  /**
   * @var string
   */
  protected $manufacturer;

  public function __construct() {
    settype($this->name, 'string');
    settype($this->manufacturer, 'string');
    settype($this->crawler, 'bool');
    /* echo '<pre>';
      print_r($this);
      echo '</pre>'; */
  }

  /**
   * 
   * @return bool
   */
  public function isCrawler(): bool {
    return (bool) $this->crawler;
  }

  public function getName(): ?string {
    return $this->name;
  }

  public function getModel(): ?string {
    $out = null;
    if (!empty($this->getName())) {
      if ($this->getName() === 'IE' && $this->getMaker() === 'Microsoft Corporation') {
        $out = 'Internet Explorer';
      } else {
        $out = (string) $this->getName();
      }
    }
    return $out;
  }

  /**
   * 
   * @return bool
   */
  public function isUnknown(): bool {
    return !$this->isCrawler() && $this->getName() === 'Default Browser';
  }

  public function getMaker(): ?string {
    return $this->manufacturer;
  }

  public function setMaker(string $maker = null) {
    $this->manufacturer = $maker;
    return $this;
  }

}
