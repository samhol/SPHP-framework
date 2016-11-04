<?php

/**
 * ApiGen.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumb;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumbs;

/**
 * Hyperlink object generator pointing to an exising ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @link    http://www.apigen.org/ ApiGen
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @see Hyperlink
 */
class ApiGen extends AbstractPhpApiLinker {

  /**
   * Constructs a new instance
   * 
   * @param UrlGenerator $urlGenerator the url pointing to the ApiGen documentation
   * @param string|null $defaultCssClasses the default CSS classes used in the generated links or `null` for none
   * @link  http://www.w3schools.com/tags/att_a_target.asp target attribute
   * @link  http://www.w3schools.com/tags/att_global_class.asp CSS class attribute
   */
  public function __construct(ApiGenUrlGenerator $urlGenerator = null, $defaultTarget = null, $defaultCssClasses = ['api', 'apigen']) {
    if ($urlGenerator === null) {
      $urlGenerator = new ApiGenUrlGenerator();
    }
    parent::__construct($urlGenerator, $defaultTarget, $defaultCssClasses);
  }

  public function classLinker($class) {
    return new ApiGenClassLinker($class, $this->urls(), $this->getDefaultTarget(), $this->getDefaultCssClasses());
  }

  public function functionLink($function, $linkText = null) {
    if ($linkText === null) {
      $linkText = $function;
    }
    $path = $this->urls()->getFunctionUrl($function);
    return $this->hyperlink($path, $function, "function $function()")->addCssClass('function');
  }

  public function constantLink($constant, $linkText = null) {
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
   * @param  string $linkText optional link text
   * @param  boolean $fullName true if the full namespace name is visible, false otherwise
   * @return Hyperlink hyperlink object pointing to an API namespace page1
   */
  public function namespaceLink($namespace, $fullName = true) {
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
  public function namespaceBreadGrumbs($namespace) {
    $namespaceArray = explode('\\', $namespace);
    $breadGrumbs = (new BreadCrumbs())->addCssClass(['apigen', 'namespace']);
    $currentNamespaceArray = [];
    foreach ($namespaceArray as $name) {
      $currentNamespaceArray[] = $name;
      $path = implode(".", $currentNamespaceArray);
      $root = implode("\\", $currentNamespaceArray);
      $breadCrumb = new BreadCrumb($this->createUrl("namespace-$path.html"), $name, $this->getDefaultTarget());
      $breadCrumb->setTitle("NameSpace $root");
      $breadGrumbs->append($breadCrumb);
    }
    return $breadGrumbs;
  }

}
