<?php

/**
 * AbstractClassLinker.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\ApiTools;

use Sphp\Html\Navigation\Hyperlink as Hyperlink;
use Sphp\Core\Types\Strings as Strings;
use ReflectionClass;

/**
 * Link generator pointing to an exising ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
abstract class AbstractClassLinker extends AbstractLinker {

	/**
	 * Class Reflector
	 *
	 * @var ReflectionClass
	 */
	protected $ref;

	/**
	 * Constructs a new instance
	 *
	 * @param string $root the base url pointing to the documentation
	 * @param string|\object $class class name or object
	 * @param scalar[] $attrs the default value of the attributes used in the
	 *        generated links
	 */
	public function __construct($root, $class, $attrs = []) {
		parent::__construct($root, $attrs);
		$this->ref = new ReflectionClass($class);
	}

	/**
	 * {@inheritdoc}
	 */
	public function __destruct() {
		unset($this->ref);
		parent::__destruct();
	}

	/**
	 * {@inheritdoc}
	 */
	public function __clone() {
		$this->ref = new ReflectionClass($this->ref->getName());
		parent::__clone();
	}

	/**
	 * {@inheritdoc}
	 */
	public function __toString() {
		return "" . $this->getLink();
	}

	/**
	 * {@inheritdoc}
	 */
	public function getHyperlink($relativeUrl = null, $content = null, $title = null) {
		return parent::getHyperlink($relativeUrl, str_replace("\\", "\\<wbr>", $content), $title)
            ->addCssClass("bordered");
	}

	/**
	 *
	 * @param  string|\object $class class name or object
	 * @return self for PHP Method Chaining
	 */
	public function setClass($class) {
		$this->ref = new ReflectionClass($class);
		return $this;
	}

	/**
	 * Returns a hyperlink object pointing to an API class page
	 *
	 * @param  null|string $name optional alternative class link content
	 * @return Hyperlink hyperlink object pointing to an API class page
	 */
	public function getLink($name = null) {
		if (Strings::isEmpty($name)) {
			$name = $this->ref->getShortName();
		}
		if ($this->ref->isInterface()) {
			$title = $this->ref->getName() . " interface";
		} else if ($this->ref->isTrait()) {
			$title = $this->ref->getName() . " trait";
		} else if ($this->ref->isAbstract()) {
			$title = "abstract " . $this->ref->getName() . " class";
		} else {
			$title = $this->ref->getName() . " class";
		}
		return $this->getHyperlink($this->getClassPath(), $name, $title);
	}

	/**
	 * Returns a hyperlink object pointing to class method in the API documentation
	 *
	 * @param  string $method the method name
	 * @param  boolean $full true for `Class::method()` and false for `method()`
	 * @return Hyperlink object pointing to class method in the API documentation
	 */
	public function method($method, $full = false) {
		$this->ref->getMethod($method);
		$reflectedMethod = $this->ref->getMethod($method);
		if ($full) {
			$text = $this->ref->getShortName() . "::$reflectedMethod->name()" ;
		} else {
			$text = "$reflectedMethod->name()";
		}
		$fullClassName = $this->ref->getName();
		if ($reflectedMethod->isConstructor()) {
			//$name = $prefix . "$reflectedMethod->name()";
			$title = "The $fullClassName constructor";
		} else if ($reflectedMethod->isStatic()) {
			//$name = $this->ref->getShortName() . "::$reflectedMethod->name()";
			$title = "Static method: $fullClassName::$reflectedMethod->name()";
		} else {
			//$name = $this->ref->getShortName() . "::$reflectedMethod->name()";
			$title = "Instance method: $fullClassName::$reflectedMethod->name()";
		}
		return $this->getHyperlink($this->getMethodPath($method), $text, $title);
	}

	/**
	 * Returns a hyperlink object pointing to class constant in the API documentation
	 *
	 * @param  string $constName the constant name
	 * @return Hyperlink object pointing to class constant in the API documentation
	 */
	public function constant($constName) {
		$name = $this->ref->getShortName() . "::$constName";
		$title = $this->ref->getName() . "::$constName constant";
		return $this->getHyperlink($this->getConstantPath($constName), $name, $title);
	}

	/**
	 * Returns a hyperlink object pointing to the namespace of the class in the API documentation
	 *
	 * @param  string $constName the constant name
	 * @return Hyperlink object pointing to class constant in the API documentation
	 */
	public function namespaceLink() {
		$name = $this->ref->getNamespaceName();
		$title = "$name namespace";
		return $this->getHyperlink($this->getNamespacePath(), $name, $title);
	}

	/**
	 * Returns the relative API page path of the given class
	 *
	 * @return string the relative API page path of the given class
	 */
	abstract public function getClassPath();

	/**
	 * Returns the relative API page path of the given class method
	 *
	 * @param  string $method the method name
	 * @return string the relative API page path string pointing to the given class method
	 */
	abstract public function getMethodPath($method);

	/**
	 * Returns the relative API page path of the given class constant
	 *
	 * @param  string $constant the name of the constant
	 * @return string the relative API page path of the given class constant
	 */
	abstract public function getConstantPath($constant);

	/**
	 * Returns the relative API page path of the given namespace
	 *
	 * @return string the relative API page path of the given namespace
	 */
	abstract public function getNamespacePath();

}
