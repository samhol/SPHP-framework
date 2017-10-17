<?php

/**
 * DocumentGetHyperlink.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Manual\MVC\TagListing;

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
   * @var TagComponentData
   */
  private $data;

  public function __construct(TagComponentData $data) {
    $this->data = $data;
  }

  public function getCall(): string {
    Apis::w3schools()->tag($this->data->getTagName(), $linkText);
  }

  public function getW3schoolsLink(): string {
    Apis::w3schools()->tag($this->data->getTagName(), $linkText);
  }

}
