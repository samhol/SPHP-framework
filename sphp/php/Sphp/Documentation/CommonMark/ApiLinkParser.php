<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\CommonMark;

use League\CommonMark\Parser\Inline\InlineParserInterface;
use Sphp\Documentation\Linkers\PHP\PhpApiLinker;
use League\CommonMark\Parser\Inline\InlineParserMatch;
use League\CommonMark\Parser\InlineParserContext;

/**
 * Description of PHPApiLinkParser
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class ApiLinkParser implements InlineParserInterface {

  private PhpApiLinker $linker;

  /**
   * Constructor
   * 
   * @param PhpApiLinker|null $apiLinker 
   */
  public function __construct(?PhpApiLinker $apiLinker = null) {
    if ($apiLinker === null) {
      $apiLinker = new PhpApiLinker();
    }
    $this->linker = $apiLinker;
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->linker);
  }

  public function getMatchDefinition(): InlineParserMatch {
    return InlineParserMatch::regex('({@php (.+)})');
  }

  public function parse(InlineParserContext $inlineContext): bool {
    $cursor = $inlineContext->getCursor();
    $previousChar = $cursor->peek(-1);
    if ($previousChar !== null && $previousChar !== ' ') {
      return false;
    }
    $cursor->advanceBy($inlineContext->getFullMatchLength());
    $matches = $inlineContext->getSubMatches();
    try {
      $apilink = new ApiLink($this->linker->build($matches[1]));
      $inlineContext->getContainer()->appendChild($apilink);
    } catch (\Exception $ex) {
      return false;
    }
    return true;
  }

}
