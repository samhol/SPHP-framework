<?php

/**
 * SamiClassLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual\Sami;

use Sphp\Html\Apps\Manual\AbstractClassLinker;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumbs;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumb;

/**
 * Hyperlink object generator pointing to an existing Sami documentation about a class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SamiClassLinker extends AbstractClassLinker {

  /**
   * Constructs a new instance
   * 
   * @param string $class the name of the class
   * @param SamiUrlGenerator|null $urlGenerator
   * @param string|null $defaultTarget
   * @param string|string[]|null $defaultCssClasses
   */
  public function __construct(string $class, SamiUrlGenerator $urlGenerator = null, string $defaultTarget = null, $defaultCssClasses = null) {
    if ($urlGenerator === null) {
      $urlGenerator = new SamiUrlGenerator();
    }
    parent::__construct($class, $urlGenerator, $defaultTarget, $defaultCssClasses);
  }

  /**
   * Returns a BreadCrumbs component showing the class and the trail of nested namespaces leading to it
   * 
   * @return BreadCrumbs
   */
  public function classBreadGrumbs(): BreadCrumbs {
    $target = $this->getDefaultTarget();
    $namespace = $this->ref->getNamespaceName();
    $namespaceArray = explode('\\', $namespace);
    $breadCrumbs = new BreadCrumbs();
    $breadCrumbs->addCssClass(['sami', 'class']);
    $currentNamespace = [];
    foreach ($namespaceArray as $name) {
      $currentNamespace[] = $name;
      $path = implode("/", $currentNamespace);
      $bc = new BreadCrumb($this->createUrl("$path.html"), $name, $target);
      $bc->setTitle("Namespace $name");
      $breadCrumbs->append($bc);
    }
    $breadCrumbs->appendNew($this->urls()->getClassUrl($this->ref->getName()), $this->ref->getShortName(), $target);
    return $breadCrumbs;
  }

}
