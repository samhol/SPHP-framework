<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons;

use Sphp\Stdlib\Parsers\ParseFactory;

/**
 * Implementation of DataFactory
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class DataFactory {

  /**
   * 
   * @param  string $path
   * @return IconSetData
   */
  public static function deviconsFromJson(string $path): IconSetData {
    $raw = ParseFactory::fromFile($path);
    return static::devicons($raw);
  }

  /**
   * 
   * @param  array $raw
   * @return IconSetData
   */
  public static function devicons(array $raw): IconSetData {
    $data = [];
    foreach ($raw as $iconData) {
      $data[$iconData['name']] = new DevIconData($iconData);
    }
    return new IconSetData($data);
  }

  /**
   * 
   * @param  string $path
   * @return IconSetData
   */
  public static function fontawesomeFromYaml(string $path): IconSetData {
    return static::fontawesome(ParseFactory::yaml()->fileToArray($path));
  }

  /**
   * 
   * @param  array $raw
   * @return IconSetData
   */
  public static function fontawesome(array $raw): IconSetData {
    $data = [];
    foreach ($raw as $name => $iconData) {
      $data[$name] = new FaIconGroup($name, $iconData);
    }
    return new IconSetData($data);
  }

}
