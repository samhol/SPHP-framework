<?php

/**
 * DocumentGetHyperlink.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\TagListing;
use Sphp\Html\TagInterface;
/**
 * Description of DocumentGetHyperlink
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2017-10-17
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class DocumentGetHyperlinkGenerator {

  /**
   *
   * @var TagInterface
   */
  private $data;

  public function __construct(TagInterface $tag) {
    $this->data = $tag;
  }

  public function getCall(): string {
    Apis::sami()->classLinker($info->getObjectType())->getLink($info->getDocumentCall() . ": " . $info->getObjectType(), "returns " . $info->getObjectType());
  }

  public function getW3schoolsLink(TagInterface $tag): string {
    Apis::w3schools()->tag($this->data->getTagName(), $linkText);
  }

}
