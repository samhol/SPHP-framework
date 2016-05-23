<?php

/**
 * ApiGenLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\ApiTools;

use Sphp\Html\Navigation\Hyperlink as Hyperlink;
use Sphp\Util\ReflectionClassExt as ReflectionClassExt;
use Sphp\Html\Foundation\F6\Navigation\BreadCrumb as BreadCrumb;
use Sphp\Html\Foundation\F6\Navigation\BreadCrumbs as BreadCrumbs;

/**
 * Link generator pointing to an exising ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class ApiGenLinker extends ApiLinker {

	/**
	 * Constructs a new instance
	 * 
	 * @param string $apiRoot the url pointing to the ApiGen documentation
	 * @param scalar[] $attrs the default value of the attributes used in the 
	 *        generated links
	 */
	public function __construct($apiRoot = "", array $attrs = ["target" => "apigen", "class" => "api apigen"]) {
		parent::__construct($apiRoot, $attrs);
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function classLinker($class) {
		return new ApiGenClassLinker($this->getApiRoot(), $class, $this->getDefaultAttributes());
	}

	/**
	 * Returns a hyperlink object pointing to PHP's predefined constants page
	 * 
	 * @param  string $constantName the name of the constant
	 * @return Hyperlink hyperlink object pointing to PHP's predefined constants page
	 */
	public function getConstantLink($constantName) {
		$path = str_replace('\\', '.', $constantName);
		return $this->getHyperlink("constant-$path.html", $constantName, "$constantName constant")->addCssClass("constant");
	}
  
  /**
   * 
   * @param  string $namespace
   * @return BreadCrumbs
   */
  public function getNamespaceBreadGrumbs($namespace) {
    $nsArr = ReflectionClassExt::parseNamespaceToArray($namespace);
    //$root = "";
    $bcs = (new BreadCrumbs())->addCssClass("namespace");
    $cuur = [];
    foreach ($nsArr as $name) {
      //$root .= "\\$name";
      $cuur[] = $name;
      $path = implode(".", $cuur);
      $bc =  new BreadCrumb($this->getApiRoot() . "namespace-" . $path . ".html", $name, "apigen");
      $bcs->append($bc);
    }
    return $bcs;
  }

}
