<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Lists;

use Sphp\Html\ContainerTag;

/**
 * Implementation of an HTML dd tag
 *
 * This component is used to describe a term/name ({@link Dt} object) in a description list.
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://www.w3schools.com/tags/tag_dd.asp w3schools HTML API
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Dd extends ContainerTag implements DlContent {

  /**
   * Constructor
   *
   * @param  mixed $content optional content of the component
   * @link   https://php.net/manual/en/language.oop5.magic.php#object.tostring __toString() method
   */
  public function __construct(mixed $content = null) {
    parent::__construct('dd', $content);
  }

}
