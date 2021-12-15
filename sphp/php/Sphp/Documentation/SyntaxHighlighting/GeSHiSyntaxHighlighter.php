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

use GeSHi;
use Sphp\Exceptions\RuntimeException;

/**
 * Class wraps the GeSHi (a Generic Syntax Highlighter)
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @link    http://qbnz.com/highlighter/ GeSHi - Generic Syntax Highlighter
 * @license https://opensource.org/licenses/MIT The MIT License
 * @license https://www.gnu.org/licenses/gpl-2.0.html GPLv2 for GeSHi - Generic Syntax Highlighter
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class GeSHiSyntaxHighlighter implements SyntaxHighlighter {

  /**
   * the GeSHi component
   *
   * @var GeSHi
   */
  private GeSHi $geshi;

  /**
   * Constructor
   */
  public function __construct() {
    $this->initGeshi();
  }

  public function __destruct() {
    unset($this->geshi);
  }

  public function __clone() {
    throw new Exception();
  }

  /**
   * 
   * @return $this for a fluent interface
   */
  private function initGeshi() {
    $this->geshi = new GeSHi();
    //$this->geshi->enable_classes();
    // $this->geshi->set_overall_class('syntax');
    $this->geshi->set_header_type(GESHI_HEADER_DIV);
    //$this->geshi->enable_line_numbers(\GESHI_FANCY_LINE_NUMBERS, 2);
    //$this->geshi->set_overall_id(\Sphp\Stdlib\Strings::random());
    return $this;
  }

  /**
   * 
   * @return string
   */
  public function getSyntaxBlockId() {
    return $this->geshiId;
  }

  /**
   * 
   * @return $this for a fluent interface
   */
  public function useSyntaxBlockId(string $id) {
    $this->geshiId = $id;
    $this->geshi->set_overall_id($id);
    return $this;
  }

  public function loadFromFile(string $filename) {
    try {
      $this->geshi->load_from_file($filename);
      return $this;
    } catch (\Exception $ex) {
      throw new RuntimeException("The file '$filename' does not exist!", $ex->getCode(), $ex);
    }
  }

  /**
   * Sets the line number visibility
   * 
   * @param  bool $show true for visible line numbers and false otherwise
   * @return $this for a fluent interface
   */
  public function showLineNumbers(bool $show = true) {
    if ($show) {
      $this->geshi->enable_line_numbers(\GESHI_FANCY_LINE_NUMBERS, 2);
    } else {
      $this->geshi->enable_line_numbers(\GESHI_NO_LINE_NUMBERS);
    }
    return $this;
  }

  public function inlineFromString(string $source, string $language): string {
    $geshi = clone $this->geshi;
    //$this->geshi = new GeSHi();
    // $this->geshi->set_header_type(GESHI_HEADER_DIV);
    $geshi->set_source($source);
    $geshi->set_language($language);
    $geshi->set_overall_style('display:inline-block;word-wrap: break-word;word-break: break-word;');
    $geshi->enable_line_numbers(\GESHI_NO_LINE_NUMBERS);
    return $geshi->parse_code();
  }

  public function blockFromString(string $source, string $language): string {
    $geshi = clone $this->geshi;
    $geshi->set_source($source);
    $geshi->set_language($language);
    $geshi->enable_classes();
    //$this->geshi->set_overall_class('syntax');
    //$this->geshi->set_header_type(GESHI_HEADER_DIV);
    //$this->geshi->enable_line_numbers(\GESHI_FANCY_LINE_NUMBERS, 2);
    return $geshi->parse_code();
  }

  public function blockFromFile(string $path): string {
    $geshi = clone $this->geshi;
    try {
      $geshi->load_from_file($path);
    } catch (\Exception $ex) {
      throw new RuntimeException("The file '$path' does not exist!", $ex->getCode(), $ex);
    }
    $geshi->enable_classes();
    $geshi->set_overall_class('GeSHi');
    // $this->geshi->enable_line_numbers(\GESHI_FANCY_LINE_NUMBERS, 2);
    return $geshi->parse_code();
  }

}
