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

use League\CommonMark\Parser\Block\AbstractBlockContinueParser;
use League\CommonMark\Parser\Block\BlockStartParserInterface;
use League\CommonMark\Parser\Cursor;
use League\CommonMark\Node\Block\AbstractBlock;
use League\CommonMark\Parser\Block\BlockContinueParserInterface;
use League\CommonMark\Parser\Block\BlockStart;
use League\CommonMark\Parser\Block\BlockContinue;
use League\CommonMark\Parser\MarkdownParserStateInterface;
use League\CommonMark\Util\LinkParserHelper;

/**
 * The CodeExampleBlockParser class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CodeExampleBlockParser extends AbstractBlockContinueParser {

  public static function createBlockStartParser(): BlockStartParserInterface {
    return new class implements BlockStartParserInterface {

      public function tryStart(Cursor $cursor, MarkdownParserStateInterface $parserState): ?BlockStart {
        if ($cursor->isIndented() || $parserState->getParagraphContent() !== null || !($parserState->getLastMatchedBlockParser()->getBlock() instanceof Document)) {
          return BlockStart::none();
        }

        // 0-3 leading spaces are okay
        $cursor->advanceToNextNonSpaceOrTab();

        // The line must begin with "https://"
        if (!str_starts_with($cursor->getRemainder(), '[@example:')) {
          return BlockStart::none();
        }

        // A valid link must be found next
        if (($dest = LinkParserHelper::parseLinkDestination($cursor)) === null) {
          return BlockStart::none();
        }

        // Skip any trailing whitespace
        $cursor->advanceToNextNonSpaceOrTab();

        // We must be at the end of the line; otherwise, this link was not by itself
        if (!$cursor->isAtEnd()) {
          return BlockStart::none();
        }

        return BlockStart::of(new EmbedParser($dest))->at($cursor);
      }
    };
  }

  public function getBlock(): AbstractBlock {
    return new class extends AbstractBlock {
      
    };
  }

  public function tryContinue(Cursor $cursor, BlockContinueParserInterface $activeBlockParser): ?BlockContinue {
    return BlockContinue::at($cursor);
  }

}
