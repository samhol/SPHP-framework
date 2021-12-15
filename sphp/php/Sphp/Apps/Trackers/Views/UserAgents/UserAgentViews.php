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

use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Media\Icons\IconTag;
use Sphp\Apps\Trackers\Data\UserAgents\UserAgent;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Dl;
use Sphp\Html\Lists\Dd;

/**
 * Class UserAgentViews
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class UserAgentViews {

  private static function buildValue($dl, string $name, $value): void {
    //$out = null;
    if ($value !== 'unknown') {
      $dd = new Dd();
      $dd->appendInlineMd("**$name:** `$value`");
      $dl->append($dd);
    }
    // return $out;
  }

  public static function buildHeading(UserAgent $ua): string {
    $out = '';
    $out .= static::createIcon($ua) . ' ' . $ua->getModel();

    if ($ua->version !== '0.0') {
      $out .= " $ua->version";
    }
    if ($ua->getMaker() !== 'unknown') {
      $out .= ' <small> by ' . $ua->getMaker() . '</small>';
    }
    return $out;
  }

  public static function buildGeneralInformationView(UserAgent $ua): ?Dl {
    $out = new Dl;
    $out->appendTerm('General information');
    static::buildValue($out, 'user agent type', $ua->getUserAgentType());
    $bits = $ua->browser_bits;
    if ($bits > 0) {
      $out->appendDescription()
              ->appendInlineMd("**bit version:**: `$bits bit edition`");
    }
    static::buildValue($out, 'manufacturer', $ua->getMaker());
    return $out;
  }

  public static function buildPlatformInformation(UserAgent $ua): ?Dl {
    if ($ua->hasKnownPlatform()) {
      $out = new Dl;
      $out->appendTerm('Platform information');
      $platform = $ua->getPlatform();
      static::buildValue($out, 'platform', $platform);
      $bits = $ua->platform_bits;
      if ($bits > 0) {
        $out->appendDescription()
                ->appendInlineMd("**bit version:**: `$bits bit edition`");
      }
      static::buildValue($out, 'platform version', $ua->platform_version);
      static::buildValue($out, 'description', $ua->platform_description);
      static::buildValue($out, 'manufacturer', $ua->platform_maker);
    } else {
      $out = null;
    }
    return $out;
  }

  public static function buildDeviceInformation(UserAgent $ua): ?Dl {
    $deviceName = $ua->device_name;
    if ($deviceName !== 'unknown') {
      $out = new Dl;
      $out->appendTerm('Device information');
      static::buildValue($out, 'device type', $ua->device_type);
      static::buildValue($out, 'name', $deviceName);
      static::buildValue($out, 'pointing method', $ua->device_pointing_method);
      static::buildValue($out, 'brand name', $ua->device_brand_name);
      static::buildValue($out, 'manufacturer', $ua->device_maker);
      static::buildValue($out, 'code name', $ua->device_code_name);
    } else {
      $out = null;
    }
    return $out;
  }

  public static function buildRenrerEngineInformation(UserAgent $ua): ?Dl {
    if ($ua->renderingengine_name !== 'unknown') {
      $out = new Dl;
      $out->appendTerm('Render Engine information');
      static::buildValue($out, 'name', $ua->renderingengine_name);
      static::buildValue($out, 'version', $ua->renderingengine_version);
      $out->appendDescription()->appendInlineMd('**description:** ' . $ua->renderingengine_description);
      static::buildValue($out, 'manufacturer', $ua->renderingengine_maker);
    } else {
      $out = null;
    }
    return $out;
  }

  public static function createIcon(UserAgent $ua): ?IconTag {
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

  public static function buildSupportList(UserAgent $ua): Ul {
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
