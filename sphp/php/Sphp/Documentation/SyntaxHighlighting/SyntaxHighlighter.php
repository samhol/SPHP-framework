<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\SyntaxHighlighting;

use Sphp\Exceptions\RuntimeException;

/**
 * Defines default properties for a syntax highlighter component
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
interface SyntaxHighlighter {

  /**
   * Creates an inline codeblock from a code string
   * 
   * @param  string $source the source code to parse
   * @param  string $language name of the source code language
   * @return string
   */
  public function inlineFromString(string $source, string $language): string;

  /**
   * Creates a codeblock from a code string
   * 
   * @param  string $source the source code to parse
   * @param  string $language name of the source code language
   * @return string the code block
   */
  public function blockFromString(string $source, string $language): string;

  /**
   * Reads the source code from an file
   *
   * @param  string $filename name of the file to read
   * @return string the code block
   * @throws RuntimeException if the file was not found
   */
  public function blockFromFile(string $filename): string;
}
