<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

use Sphp\Stdlib\Strings;

/**
 * Implements a factory for Devicons icon objects
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://konpa.github.io/devicon/ Devicon home
 * @filesource
 */
class DevIcons extends IconFactory {

  public function createIcon(string $name, string $tagName = 'i'): IconTag {
    if (!Strings::startsWith($name, 'devicon') || Strings::startsWith($name, 'devicon-plain')) {
      //var_dump((!Strings::startsWith($name, 'devicon')), Strings::startsWith($name, 'devicon-plain'));
      //echo $name;
      $name = "devicon-$name";
    }
    return parent::createIcon($name, $tagName);
  }

}
