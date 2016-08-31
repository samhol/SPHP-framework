<?php

/**
 * ApiGenClassLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Core\Util\ReflectionClassExt as ReflectionClassExt;
use Sphp\Html\Foundation\F6\Navigation\BreadCrumbs as BreadCrumbs;
use Sphp\Html\Foundation\F6\Navigation\BreadCrumb as BreadCrumb;

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
   * Returns a BreadCrumbs component showing the class and the trail of nested namespaces leading to it
   * 
   * @param  string $namespace
   * @return BreadCrumbs
   */
  public function classBreadGrumbs() {
    $namespace = $this->ref->getNamespaceName();
    $nsArr = ReflectionClassExt::parseNamespaceToArray($namespace);
    //$root = "";
    $bcs = (new BreadCrumbs())->addCssClass("apigen class");
    $cuur = [];
    foreach ($nsArr as $name) {
      //$root .= "\\$name";
      $cuur[] = $name;
      $path = implode(".", $cuur);
      $bc = new BreadCrumb($this->getApiRoot() . "namespace-" . $path . ".html", $name, "apigen");
      $bcs->append($bc);
    }
    $bc = new BreadCrumb($this->getApiRoot() . $this->getClassPath(), $this->ref->getShortName(), "apigen");
    $bcs->append($bc);
    return $bcs;
  }

  /**
   * {@inheritdoc}
   */
  protected function getClassPath() {
    $path = str_replace('\\', '.', $this->ref->getName());
    return "class-" . $path . ".html";
  }

  /**
   * {@inheritdoc}
   */
  protected function getMethodPath($method) {
    return $this->getClassPath() . "#_" . $method;
  }

  /**
   * {@inheritdoc}
   */
  protected function getConstantPath($constant) {
    return $this->getClassPath() . "#_" . $constant;
  }

  /**
   * {@inheritdoc}
   */
  protected function getNamespacePath() {
    $ns = $this->ref->getNamespaceName();
    $path = str_replace('\\', '.', $ns);
    return "namespace-" . $path . ".html";
  }

}
