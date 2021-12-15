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
 * Class Browser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class UserAgent implements \Serializable {

  /**
   * @var int
   */
  private $id;

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

  /**
   * @var string
   */
  private $version;

  /**
   * @var string
   */
  private $majorVersion;

  /**
   * @var string
   */
  private $minorVersion;

  /**
   * @var string
   */
  private $raw;

  /**
   * @var bool
   */
  private $isMobileDevice;

  /**
   *
   * @var \stdClass
   */
  private $data;

  public function __construct(array $data = null) {
    if ($data !== null) {
      foreach ($data as $prop => $value) {
        if (property_exists($this, $prop)) {
          $this->$prop = $value;
        }
      }
    }
    settype($this->id, 'integer');
    settype($this->isMobileDevice, 'bool');
    settype($this->name, 'string');
    settype($this->manufacturer, 'string');
    settype($this->raw, 'string');
    settype($this->crawler, 'bool');
  }

  public function __destruct() {
    unset($this->data);
  }

  public function __isset(string $param): bool {
    return property_exists($this, $param);
  }

  public function __get(string $param) {
    $out = null;
    if (property_exists($this, $param)) {
      $out = $this->$param;
      if ($out === 'unknown') {
        $out = null;
      }
    } else {
      $data = $this->getBrowsCapData();
      if (isset($data->$param)) {
        $data->$param = $data->$param;
        $out = $data->$param;
      }
    }
    return $out;
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

  public function isUnknown(): bool {
    return (!$this->isCrawler() && $this->getName() === 'Default Browser') || empty($this->getRaw());
  }

  public function getBrowsCapData(): \stdClass {
    if ($this->data === null) {
      $this->data = UserAgentParser::instance()->getBrowscapData($this->raw);
    }
    return $this->data;
  }

  public function getDbId(): ?int {
    return $this->id;
  }

  public function setCrawler(bool $crawler) {
    $this->crawler = $crawler;
    return $this;
  }

  public function getUserAgentType(): string {
    return $this->browser_type;
  }

  public function setUserAgentType(string $type) {
    $this->browser_type = $type;
    return $this;
  }

  /**
   * 
   * @return bool

    public function isCrawler(): bool {
    return (bool) $this->crawler;
    } */
  public function setName(string $name = null) {
    $this->name = $name;
    return $this;
  }

  public function setMajorVersion(string $majorVersion = null) {
    $this->majorVersion = $majorVersion;
    return $this;
  }

  public function getMajorVersion(): ?string {
    return $this->majorVersion;
  }

  public function setMinorVersion(string $minorVersion = null) {
    $this->minorVersion = $minorVersion;
    return $this;
  }

  public function getMinorVersion(): ?string {
    return $this->minorVersion;
  }

  public function setVersion(string $version = null) {
    $this->version = $version;
    return $this;
  }

  public function setRaw(string $raw) {
    $this->raw = $raw;
    return $this;
  }

  public function getRaw(): ?string {
    return $this->raw;
  }

  public function getBrowserParam(string $param) {
    $out = null;
    if (isset($this->data->$param)) {
      $out = $this->data->$param;
      if ($out === 'unknown') {
        $out = null;
      }
    }
    return $out;
  }

  public function getDeviceType(): ?string {
    return $this->getBrowserParam('device_type');
  }

  public function getVersion(): ?string {
    return $this->version;
  }

  public function hasKnownPlatform(): bool {
    return $this->platform !== 'unknown' ||
            $this->platform_version !== 'unknown' ||
            $this->platform_description !== 'unknown' ||
            $this->platform_maker !== 'unknown';
  }

  public function getPlatform(): ?string {
    $out = null;
    if ($this->platform_description !== 'unknown') {
      $out = $this->platform_description;
    }
    return $out;
  }

  public function getPlatformBits(): int {
    return (int) $this->platform_bits;
  }

  public function getMaker(): ?string {
    $maker = $this->manufacturer;
    //var_dump($maker);
    if ($maker === null) {
      $maker = $this->browser_maker;
    }
    return $maker;
  }

  public function setMaker(string $maker = null) {
    $this->manufacturer = $maker;
    return $this;
  }

  public function getPlatformMaker(): ?string {
    $out = null;
    if ($this->platform_maker !== 'unknown') {
      $out = $this->platform_maker;
    }
    return $out;
  }

  public function isMobileDevice(): bool {
    return $this->isMobileDevice;
  }

  public function setIsMobileDevice(bool $isMobileDevice) {
    $this->isMobileDevice = $isMobileDevice;
    return $this;
  }

  public function getOperatingSystem(): ?string {
    $out = $this->platform_description;
    $out .= ' by ';
    $out .= $this->platform_maker;
    return $out;
  }

  public function supportsJavaScript(): bool {
    return (bool) $this->javascript;
  }

  public function supportsJavaApplets(): bool {
    return (bool) $this->javaapplets;
  }

  public function supportsCookies(): bool {
    return (bool) $this->cookies;
  }

  public function getCssVersion(): ?int {
    $output = null;
    if ($this->cssversion != 0) {
      $output = (int) $this->cssversion;
    }
    return $output;
  }

  public function serialize(): string {
    return serialize($this->data);
  }

  public function unserialize($serialized): void {
    $this->data = unserialize($serialized);
  }

}
