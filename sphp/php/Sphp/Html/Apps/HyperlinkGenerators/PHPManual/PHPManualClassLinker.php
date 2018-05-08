<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators\PHPManual;

use Sphp\Html\Apps\HyperlinkGenerators\AbstractClassLinker;
use Sphp\Html\Navigation\Hyperlink;
/**
 * PHP class link generator pointing to an existing PHP Manual documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class PHPManualClassLinker extends AbstractClassLinker {

  /**
   * Constructor
   * 
   * @param string $class
   * @param PHPManualUrlGenerator|null $p
   * @param string|null $defaultTarget
   * @param string|string[]|null $defaultCssClasses
   */
  public function __construct(string $class, PHPManualUrlGenerator $p = null, string $defaultTarget = null, $defaultCssClasses = null) {
    if ($p === null) {
      $p = new PHPManualUrlGenerator();
    }
    parent::__construct($class, $p, $defaultTarget, $defaultCssClasses);
  }

  public function hyperlink(string $url = null, string $content = null, string $title = null): Hyperlink {
    if ($title === null) {
      $title = 'PHP manual';
    } else {
      $title = 'PHP manual: ' . $title;
    }
    return parent::hyperlink($url, $content, $title);
  }

}
