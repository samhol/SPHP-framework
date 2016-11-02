<?php

/**
 * ClassLinkPathParser.php (UTF-8)
 * Copyright (c) 2014 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps\Manual;

/**
 * Link generator pointing to an exising ApiGen documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2014-11-29
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
interface ClassUrlGeneratorInterface extends UrlGeneratorInterface {

  /**
   * Returns the relative API page path of the given class
   *
   * @return string the relative API page path of the given class
   */
  public function getClassPath($className);

  /**
   * Returns the relative API page path of the given class method
   *
   * @param  string $method the method name
   * @return string the relative API page path string pointing to the given class method
   */
  public function getMethodPath($className, $method);

  /**
   * Returns the relative API page path of the given class constant
   *
   * @param  string $constant the name of the constant
   * @return string the relative API page path of the given class constant
   */
  public function getConstantPath($className, $constant);

  /**
   * Returns the relative API page path of the given namespace
   *
   * @return string the relative API page path of the given namespace
   */
  public function getNamespacePath($namespaceName);
}
