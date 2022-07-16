<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP;

use Sphp\Documentation\Linkers\PHP\PHPManual\LanguageReferenceLinker;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Documentation\Linkers\PHP\PHPManual\Books\ReferenceLinker;
/**
 * URL string generator pointing to an existing Sami documentation
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    https://github.com/FriendsOfPHP/Sami Sami: an API documentation generator
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
interface PhpApiLinkerInterface {

  /**
   * Returns a hyperlink object pointing to the PHP extension in the PHP documentation
   *
   * @param  string $extName the name of the PHP extension (case insensitive)
   * @return ReferenceLinker hyperlink object pointing to the PHP documentation
   */
  public function extensionLink(string $extName): ReferenceLinker;

  /**
   * Returns a hyperlink object pointing to the PHP control structure in the PHP documentation
   *
   * @param  string $controlName the name of the PHP control structure (case insensitive)
   * @return LanguageReferenceLinker hyperlink object pointing to the PHP control structure in the PHP
   *         documentation
   */
  public function languageReference(string $controlName): LanguageReferenceLinker;

  /**
   * Returns a new class linker instance for the given class
   * 
   * @param  string $class class name or object
   * @return ClassLinker instance
   * @throws InvalidArgumentException if the class name does not exist
   */
  public function classLinker(string $class): ClassLinker;

  /**
   * Returns a hyperlink object pointing to an API page describing PHP function 
   *
   * @param  string $function the name of the function
   * @return FunctionLinker hyperlink factory object pointing to the documentation
   */
  public function functionLink(string $function): FunctionLinker;

  /**
   * Returns a hyperlink object pointing to an API page describing PHP constant 
   * 
   * @param  string $constant the name of the constant
   * @return ConstantLinker hyperlink factory object pointing to the documentation
   */
  public function constantLink(string $constant): ConstantLinker;
}
