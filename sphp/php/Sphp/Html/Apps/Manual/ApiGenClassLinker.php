<?php

/**
 * ApiGenClassLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Core\Util\ReflectionClassExt;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumbs;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumb;

/**
 * PHP class link generator pointing to an exising ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ApiGenClassLinker extends AbstractClassLinker {

  /**
   * 
   * @param string $class
   * @param ApiGenUrlGenerator $pathParser
   * @param string|null $defaultTarget
   * @param string|string[]|null $defaultCssClasses
   */
  public function __construct($class, ApiGenUrlGenerator $pathParser, $defaultTarget = null, $defaultCssClasses = null) {
    parent::__construct($class, $pathParser, $defaultTarget, $defaultCssClasses);
  }

  /**
   * Returns a BreadCrumbs component showing the class and the trail of nested namespaces leading to it
   * 
   * @param  string $namespace
   * @return BreadCrumbs
   */
  public function classBreadGrumbs() {
    $namespace = $this->ref->getNamespaceName();
    $nsArr = ReflectionClassExt::parseNamespaceToArray($namespace);
    $bcs = (new BreadCrumbs())->addCssClass('apigen class');
    $cuur = [];
    foreach ($nsArr as $name) {
      $cuur[] = $name;
      $path = implode('.', $cuur);
      $bc = new BreadCrumb($this->createUrl("namespace-$path.html"), $name, $this->getDefaultTarget());
      $bcs->append($bc);
    }
    $bclass = new BreadCrumb($this->getLink(), $this->ref->getShortName(), $this->getDefaultTarget());
    $bcs->append($bclass);
    return $bcs;
  }

}
