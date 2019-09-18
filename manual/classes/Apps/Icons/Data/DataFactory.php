<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\Apps\Icons\Data;

use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Media\Icons\DevIcons;
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
    $data = [];
    $groupData['factoryName'] = 'Devicon';
    $groupData['factory'] = new DevIcons();
    foreach ($raw as $rawGroup) {
      $groupData['name'] = $rawGroup['name'];
      $groupData['svg'] = $rawGroup['versions']['svg'];
      $groupData['font'] = $rawGroup['versions']['font'];
      $groupData['label'] = $rawGroup['name'];
      $groupData['searchTerms'] = $rawGroup['tags'];
      $data[$rawGroup['name']] = new DeviconGroupData($groupData);
    }
    return new IconSetData($data);
  }


  /**
   * 
   * @param  string $path
   * @return IconSetData
   */
  public static function fontawesomeFromYaml(string $path): IconSetData {
    $data = [];
    $groupData = [];
    $groupData['factoryName'] = 'Font Awesome';
    $groupData['factory'] = new FontAwesome();
    foreach (ParseFactory::yaml()->fileToArray($path) as $name => $rawGroup) {
      $groupData['name'] = $name;
      $groupData['styles'] = $rawGroup['styles'];
      $groupData['unicode'] = $rawGroup['unicode'];
      $groupData['changes'] = $rawGroup['changes'];
      $groupData['label'] = $rawGroup['label'];
      $groupData['searchTerms'] = $rawGroup['search']['terms'];
      $data[$name] = new FaIconGroupData($groupData);
    }
    return new IconSetData($data);
  }

}
