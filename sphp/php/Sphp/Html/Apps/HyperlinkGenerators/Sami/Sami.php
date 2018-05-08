<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators\Sami;

use Sphp\Html\Apps\HyperlinkGenerators\ClassLinker;
use Sphp\Html\Apps\HyperlinkGenerators\AbstractPhpApiLinker;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumb;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumbs;
use Sphp\Html\Adapters\QtipAdapter;

/**
 * Hyperlink object generator pointing to an existing ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://github.com/FriendsOfPHP/Sami Sami: an API documentation generator
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 * @see Hyperlink
 */
class Sami extends AbstractPhpApiLinker {

  /**
   * Constructor
   * 
   * @param SamiUrlGenerator $urlGenerator the URL pointing to the Sami documentation
   */
  public function __construct(SamiUrlGenerator $urlGenerator = null) {
    if ($urlGenerator === null) {
      $urlGenerator = new SamiUrlGenerator();
    }
    parent::__construct($urlGenerator);
  }

  public function classLinker(string $class): ClassLinker {
    $classLinker = new SamiClassLinker($class, $this->urls());
    $classLinker->setDefaultAttributes($this->getDefaultAttributes());
    return $classLinker;
  }

  public function functionLink(string $function, string $linkText = null): Hyperlink {
    if ($linkText === null) {
      $linkText = $function;
    }
    $path = $this->urls()->getFunctionUrl($function);
    return $this->hyperlink($path, $function, "function $function()")->addCssClass('api', 'sphp', 'function');
  }

  public function constantLink(string $constant, string $linkText = null): Hyperlink {
    if ($linkText === null) {
      $linkText = $constant;
    }
    $path = str_replace('\\', '/', $constant);
    return $this->hyperlink($this->createUrl("constant-$path.html"), $linkText, "PHP constant $constant")->addCssClass('api', 'sphp', 'constant');
  }

  /**
   * Returns a hyperlink object pointing to an API namespace page
   *
   * @param  string $namespace namespace name
   * @param  string $linkText optional link text
   * @param  boolean $fullName true if the full namespace name is visible, false otherwise
   * @return Hyperlink hyperlink object pointing to an API namespace page1
   */
  public function namespaceLink(string $namespace, bool $fullName = true): Hyperlink {
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
    $breadGrumbs = (new BreadCrumbs())->addCssClass('api', 'sphp', 'namespace');
    $currentNamespaceArray = [];
    foreach ($namespaceArray as $name) {
      $currentNamespaceArray[] = $name;
      $path = implode("/", $currentNamespaceArray);
      $root = implode("\\", $currentNamespaceArray);
      $breadCrumb = new BreadCrumb($this->createUrl("$path.html"), $name);
      $this->insertDefaultsTo($breadCrumb);
      (new QtipAdapter($breadCrumb))->setQtip("$root Namespace")->setQtipPosition('bottom center', 'top center');
      //$breadCrumb->setTitle("$root Namespace");
      $breadGrumbs->append($breadCrumb);
    }
    return $breadGrumbs;
  }

}
