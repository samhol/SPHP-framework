<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators\ApiGen;

use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumb;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumbs;

/**
 * Hyperlink object generator pointing to an existing ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://www.apigen.org/ ApiGen
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 * @see Hyperlink
 */
class ApiGen extends AbstractPhpApiLinker {

  /**
   * Constructor
   * 
   * @param ApiGenUrlGenerator $urlGenerator the URL pointing to the ApiGen documentation
   */
  public function __construct(ApiGenUrlGenerator $urlGenerator = null) {
    if ($urlGenerator === null) {
      $urlGenerator = new ApiGenUrlGenerator();
    }
    parent::__construct($urlGenerator);
  }

  public function constantLink(string $constant, string $linkText = null): Hyperlink {
    if ($linkText === null) {
      $linkText = $constant;
    }
    $path = str_replace('\\', '.', $constant);
    return $this->hyperlink($this->createUrl("constant-$path.html"), $linkText, "PHP constant $constant")->addCssClass('constant');
  }

  /**
   * Returns a hyperlink object pointing to an API namespace page
   *
   * @param  string $namespace namespace name
   * @param  boolean $fullName true if the full namespace name is visible, false otherwise
   * @return Hyperlink hyperlink object pointing to an API namespace page
   */
  public function namespaceLink(string $namespace, string $fullName = true): Hyperlink {
    if ($fullName) {
      $name = $namespace;
    } else {
      $nsArr = explode('\\', $namespace);
      $name = array_pop($nsArr);
    }
    $url = $this->urls()->getNamespaceUrl($namespace);
    return $this->hyperlink($url, $name, "The $namespace namespace");
  }

  /**
   * Returns a BreadCrumbs component showing the trail of nested namespaces
   * 
   * @param  string $namespace namespace name
   * @return BreadCrumbs breadcrumb showing the trail of nested namespaces
   */
  public function namespaceBreadGrumbs(string $namespace): BreadCrumbs {
    $namespaceArray = explode('\\', $namespace);
    $breadGrumbs = (new BreadCrumbs())->addCssClass(['api', 'namespace']);
    $currentNamespaceArray = [];
    foreach ($namespaceArray as $name) {
      $currentNamespaceArray[] = $name;
      $path = implode(".", $currentNamespaceArray);
      $breadCrumb = new BreadCrumb($this->createUrl("namespace-$path.html"), $name, $this->getDefaultTarget());
      $breadGrumbs->append($breadCrumb);
    }
    return $breadGrumbs;
  }

}
