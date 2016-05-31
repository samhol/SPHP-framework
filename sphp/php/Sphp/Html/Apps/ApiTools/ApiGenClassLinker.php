<?php

/**
 * ApiGenClassLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\ApiTools;

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
	 * {@inheritdoc}
	 */
	public function __construct($root, $class, $attrs = ["target" => "apigen", "class" => "api apigen"]) {
		parent::__construct($root, $class, $attrs);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getClassPath() {
		$path = str_replace('\\', '.', $this->ref->getName());
		return "class-" . $path . ".html";
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMethodPath($method) {
		return $this->getClassPath() . "#_" . $method;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getConstantPath($constant) {
		return $this->getClassPath() . "#_" . $constant;
	}

	/**
	 * {@inheritdoc}
	 */
	public function getNamespacePath() {
		$ns = $this->ref->getNamespaceName();
		$path = str_replace('\\', '.', $ns);
		return "namespace-" . $path . ".html";
	}

}
