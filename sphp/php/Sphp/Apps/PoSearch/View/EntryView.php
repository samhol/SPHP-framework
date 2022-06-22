<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\PoSearch\View;

use Sphp\Html\AbstractContent;
use Sepia\PoParser\Catalog\Entry;
use Sphp\Documentation\SyntaxHighlighting\GeSHiSyntaxHighlighter;
use Sphp\Html\Layout\Div;
use Sphp\Html\Lists\Dl;

/**
 * The EntryView class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class EntryView extends AbstractContent {

  protected Entry $entry;

  public function __construct(Entry $entry) {
    $this->entry = $entry;
  }

  public function __destruct() {
    unset($this->entry);
  }

  public function parseHtmlContent(string $heading, string $content): Div {
    $div = new Div('<strong>' . $heading . ':</strong>');
    if ($content !== strip_tags($content)) {
      $msg = new GeSHiSyntaxHighlighter();
      $msgSstr = $msg->inlineFromString($content, 'html');
    } else {
      $msgSstr = '<var>' . $content . '</var>';
    }
    $div->appendDiv($msgSstr)->addCssClass('po-data p-2 mb-1');
    return $div;
  }

  public function parseCommentView(): ?Dl {
    $dl = new Dl;
    $dl->addCssClass('ps-3 px-1');
    if (!empty($this->entry->getDeveloperComments())) {
      $dl->appendTerm('Developer comments');
      $dl->appendDescriptions($this->entry->getDeveloperComments());
    }
    if (!empty($this->entry->getTranslatorComments())) {
      $dl->appendTerm('Translator comments');
      $dl->appendDescriptions($this->entry->getTranslatorComments());
    }
    if (!empty($this->entry->getFlags())) {
      $dl->appendTerm('Flags');
      $dl->appendDescriptions($this->entry->getFlags());
    }
    if (!empty($this->entry->getReference())) {
      $dl->appendTerm('References');
      $dl->appendDescriptions($this->entry->getReference());
    }
    if (!empty($this->entry->getMsgCtxt())) {
      $dl->appendTerm('c-txt:');
      $dl->appendDescription($this->entry->getMsgCtxt());
    }
    if ($dl->count() === 0) {
      $dl = null;
    }
    return $dl;
  }

}
