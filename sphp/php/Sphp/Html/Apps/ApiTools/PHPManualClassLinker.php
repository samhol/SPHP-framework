<?php

/**
 * PHPManualClassLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\ApiTools;

/**
 * PHP class link generator pointing to an exising PHP Manual documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PHPManualClassLinker extends AbstractClassLinker {

	use PHPManualTrait;

	/**
	 * {@inheritdoc}
	 */
	public function __construct($root, $class, $attrs = ["target" => "apigen", "class" => "api phpman"]) {
		parent::__construct($root, $class, $attrs);
	}

	/**
	 * {@inheritdoc}
	 */
	public function getClassPath() {
		return "class." . $this->phpPathFixer($this->ref->getName()) . ".php";
	}

	/**
	 * {@inheritdoc}
	 */
	public function getMethodPath($method) {
		return $this->phpPathFixer($this->ref->getName()) . ".$method.php";
	}

	/**
	 * {@inheritdoc}
	 */
	public function getConstantPath($constant) {
		$className = $this->ref->getName();
		$constantName = $this->phpPathFixer($constant);
		return $this->getClassPath() . "#$className.constants.$constantName";
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
