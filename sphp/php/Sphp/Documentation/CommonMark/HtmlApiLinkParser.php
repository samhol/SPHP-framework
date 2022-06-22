<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\CommonMark;

use League\CommonMark\Parser\Inline\InlineParserInterface;
use Sphp\Documentation\Linkers\Html\HtmlApiLinker;
use League\CommonMark\Parser\Inline\InlineParserMatch;
use League\CommonMark\Parser\InlineParserContext;

/**
 * The HtmlApiLinkParser class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class HtmlApiLinkParser implements InlineParserInterface {

  private HtmlApiLinker $linker;

  /**
   * Constructor
   * 
   * @param HtmlApiLinker|null $apiLinker 
   */
  public function __construct(?HtmlApiLinker $apiLinker = null) {
    if ($apiLinker === null) {
      $apiLinker = new HtmlApiLinker();
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
    return InlineParserMatch::regex('({@html (.+)})');
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
      $apilink = $this->parseTagsAndAttrs($matches[1]);
     // $apilink = new ApiLink($this->linker->build($matches[1]));
      $inlineContext->getContainer()->appendChild($apilink);
    } catch (\Exception $ex) {
      return false;
    }
    return true;
  }

  private function parseTagsAndAttrs(string $raw): ApiLink {
    $text = null;
    $parts = explode(' ', $raw);
    if($parts > 1) {
      $raw = $parts[0];
      $text = $parts[1];
    }
    if(str_starts_with($raw, '[') && str_ends_with($raw, ']')) {
      $itemLinker = $this->linker->createGlobalAttrLink(str_replace(['[',']'], '', $raw)); 
    } else if(str_contains($raw, '[') && str_ends_with($raw, ']')) {
      $p= explode(' ',str_replace(['[',']'], [' ', ''], $raw));
      $itemLinker = $this->linker->createTagAttrLink(...$p); 
    } else {
      $itemLinker = $this->linker->createTagLink($raw); 
    }
    return new ApiLink($itemLinker );
  }

}
