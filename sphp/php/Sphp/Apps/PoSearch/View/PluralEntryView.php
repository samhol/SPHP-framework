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

use Sphp\Bootstrap\Layout\Container;
use Sphp\Html\Tags;

/**
 * The PluralEntryView class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PluralEntryView extends EntryView {

  public function getHtml(): string {
    $out = new Container();
    $out->appendDiv('Plural form')->addCssClass('type mb-2');
    $out->append($this->parseCommentView());
    $row = $out->appendRow();
    $trs = $this->entry->getMsgStrPlurals();
    $row->appendColumn($this->parseHtmlContent('msgid', $this->entry->getMsgId())->addCssClass('msgstr'))->default(12)->md(6);
    $row->appendColumn($this->parseHtmlContent('msgstr[0]', $trs[0])->addCssClass('msgstr'))->default(12)->md(6);
    $row->appendColumn($this->parseHtmlContent('msgid_plural', $this->entry->getMsgIdPlural())->addCssClass('msgstr'))->default(12)->md(6);
    $row->appendColumn($this->parseHtmlContent('msgstr[1]', $trs[1])->addCssClass('msgstr'))->default(12)->md(6);
    $out->addCssClass('plural');
    return $out->getHtml();
  }

}
