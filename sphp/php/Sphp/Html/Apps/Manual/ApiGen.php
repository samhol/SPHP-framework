<?php

/**
 * ApiGen.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

use Sphp\Html\Navigation\Hyperlink;
use Sphp\Core\Util\ReflectionClassExt;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumb;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumbs;

/**
 * Hyperlink generator pointing to an exising ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
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
  public function __construct(UrlGenerator $urlGenerator = null, $defaultCssClasses = ['api', 'apigen']) {
    if ($urlGenerator === null) {
      $urlGenerator = new UrlGenerator();
    }
    parent::__construct($urlGenerator, $defaultCssClasses);
  }

  public function classLinker($class) {
    $gen = new ApiGenClassPathParser($class, $this->getUrlGenerator()->getRoot(), $this->getUrlGenerator()->getTarget());
    return new ApiGenClassLinker($class, $gen, $this->getDefaultCssClasses());
  }

  /**
   * Returns a hyperlink object pointing to an PHP function page
   *
   * @param  string $funName the name of the function
   * @return Hyperlink hyperlink object pointing to an PHP function page
   */
  public function functionLink($funName) {
    $path = $this->getUrlGenerator()->create("function-$path.html");
    return $this->hyperlink($this->getUrlGenerator()->create($path), $funName, "$funName() method")->addCssClass('function');
  }

  /**
   * Returns a hyperlink object pointing to PHP's predefined constants page
   * 
   * @param  string $constantName the name of the constant
   * @return Hyperlink hyperlink object pointing to PHP's predefined constants page
   */
  public function constantLink($constantName) {
    $path = str_replace('\\', '.', $constantName);
    return $this->hyperlink("constant-$path.html", $constantName, "$constantName constant")->addCssClass('constant');
  }

  /**
   * Returns a hyperlink object pointing to an API namespace page
   *
   * @param  string $namespace namespace name
   * @param  boolean $fullName true if the full namespace name is visible, false otherwise
   * @return Hyperlink hyperlink object pointing to an API namespace page1
   */
  public function namespaceLink($namespace, $fullName = true) {
    $ns = ReflectionClassExt::parseNamespace($namespace);
    $path = str_replace('\\', '.', $ns);
    if ($fullName) {
      $name = $ns;
    } else {
      $nsArr = ReflectionClassExt::parseNamespaceToArray($namespace);
      $name = array_pop($nsArr);
    }
    return $this->hyperlink("namespace-" . $path . ".html", $name, "The $ns namespace");
  }

  /**
   * Returns a BreadCrumbs component showint the trail of nested namespaces
   * 
   * @param  string $namespace
   * @return BreadCrumbs
   */
  public function namespaceBreadGrumbs($namespace) {
    $nsArr = ReflectionClassExt::parseNamespaceToArray($namespace);
    //$root = "";
    $bcs = (new BreadCrumbs())->addCssClass('apigen namespace');
    $cuur = [];
    foreach ($nsArr as $name) {
      //$root .= "\\$name";
      $cuur[] = $name;
      $path = implode(".", $cuur);
      $bc = new BreadCrumb($this->getUrlGenerator()->getRoot() . "namespace-$path.html", $name, "apigen");
      $bcs->append($bc);
    }
    return $bcs;
  }

}
