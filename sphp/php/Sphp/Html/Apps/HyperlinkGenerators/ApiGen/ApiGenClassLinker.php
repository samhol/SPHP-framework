<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators\ApiGen;

use Sphp\Html\Apps\HyperlinkGenerators\AbstractClassLinker;
use Sphp\Html\Apps\HyperlinkGenerators\ApiGen\ApiGenUrlGenerator;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumbs;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumb;

/**
 * Hyperlink object generator pointing to an existing ApiGen documentation about a class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ApiGenClassLinker extends AbstractClassLinker {

  /**
   * Constructor
   * 
   * @param string $class the name of the class
   * @param ApiGenUrlGenerator|null $urlGenerator
   * @param string|null $defaultTarget
   * @param string|string[]|null $defaultCssClasses
   */
  public function __construct(string $class, ApiGenUrlGenerator $urlGenerator = null, string $defaultTarget = null, $defaultCssClasses = null) {
    if ($urlGenerator === null) {
      $urlGenerator = new ApiGenUrlGenerator();
    }
    parent::__construct($class, $urlGenerator, $defaultTarget, $defaultCssClasses);
  }

  /**
   * Returns a BreadCrumbs component showing the class and the trail of nested namespaces leading to it
   * 
   * @return BreadCrumbs new instance
   */
  public function classBreadGrumbs(): BreadCrumbs {
    $target = $this->getDefaultTarget();
    $namespace = $this->ref->getNamespaceName();
    $namespaceArray = explode('\\', $namespace);
    $breadCrumbs = new BreadCrumbs();
    $breadCrumbs->addCssClass(['api', 'class']);
    $currentNamespace = [];
    foreach ($namespaceArray as $name) {
      $currentNamespace[] = $name;
      $path = implode(".", $currentNamespace);
      $bc = new BreadCrumb($this->createUrl("namespace-$path.html"), $name, $target);
      $bc->setTitle("Namespace $name");
      $breadCrumbs->append($bc);
    }
    $breadCrumbs->appendNew($this->urls()->getClassUrl($this->ref->getName()), $this->ref->getShortName(), $target);
    return $breadCrumbs;
  }

}
