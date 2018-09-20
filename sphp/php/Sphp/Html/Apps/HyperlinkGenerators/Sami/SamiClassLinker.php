<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators\Sami;

use Sphp\Html\Apps\HyperlinkGenerators\AbstractClassLinker;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumbs;
use Sphp\Html\Foundation\Sites\Navigation\BreadCrumb;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Exceptions\SphpException;

/**
 * Hyperlink object generator pointing to an existing Sami documentation about a class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class SamiClassLinker extends AbstractClassLinker {

  /**
   * Constructor
   * 
   * @param string $class the name of the class
   * @param SamiUrlGenerator|null $urlGenerator
   */
  public function __construct(string $class, SamiUrlGenerator $urlGenerator = null) {
    if ($urlGenerator === null) {
      $urlGenerator = new SamiUrlGenerator();
    }
    parent::__construct($class, $urlGenerator);
  }

  /**
   * Returns a hyperlink object pointing to the API documentation of the given property or method
   * 
   * @param  string $name
   * @return Hyperlink
   * @throws SphpException
   */
  public function __get(string $name): Hyperlink {
    if ($this->ref->hasMethod($name)) {
      return $this->methodLink($name);
    } else if ($this->ref->hasProperty($name)) {
      return $this->methodLink($name);
    } else {
      throw new SphpException("$name in not valid method, constat or variable name for " . $this->ref->getName());
    }
  }

  /**
   * Creates a new BreadCrumbs component showing the class and the trail of nested namespaces leading to it
   * 
   * @return BreadCrumbs new instance
   */
  public function classBreadGrumbs(): BreadCrumbs {
    $namespace = $this->ref->getNamespaceName();
    $namespaceArray = explode('\\', $namespace);
    $breadCrumbs = new BreadCrumbs();
    $breadCrumbs->addCssClass('sami', 'class');
    $currentNamespace = [];
    foreach ($namespaceArray as $name) {
      $currentNamespace[] = $name;
      $path = implode("/", $currentNamespace);
      $bc = new BreadCrumb($this->createUrl("$path.html"), $name);
      $breadCrumbs->append($bc);
    }
    $breadCrumbs->appendLink($this->urls()->getClassUrl($this->ref->getName()), $this->ref->getShortName());
    return $breadCrumbs;
  }

}
