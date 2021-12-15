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

/**
 * The SingularEntryView class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SingularEntryView extends EntryView {

  public function getHtml(): string {
    $out = new Container();
    $out->appendDiv('Singular form')->addCssClass('type mb-2');
    $out->append($this->parseCommentView());
    $row = $out->appendRow();
    $row->setGutters('gx-2');
    $row->appendColumn($this->parseHtmlContent('msgid', $this->entry->getMsgId())->addCssClass('msgid'))->default(12)->md(6);
    $row->appendColumn($this->parseHtmlContent('msgstr', $this->entry->getMsgStr())->addCssClass('msgstr'))->default(12)->md(6);
    $out->addCssClass('singular');
    return $out->getHtml();
  }

}
