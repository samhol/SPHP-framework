<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Media\MediaSource;
use Sphp\Html\Media\SizeableMedia;
use IteratorAggregate;
use Sphp\Html\TraversableContent;
use Sphp\Html\Utils\Mime;
use Sphp\Html\ContentIterator;

/**
 * Implementation of an HTML object tag
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ObjectTag extends AbstractComponent implements MediaSource, SizeableMedia, IteratorAggregate, TraversableContent {

  use \Sphp\Html\TraversableTrait,
      \Sphp\Html\Media\SizeableMediaTrait;

  /**
   * @var Param[]
   */
  private array $params = [];

  /**
   * Constructor
   *
   * @param string $src specifies the address of the external file to embed
   * @param string|null $type specifies the MIME type of the embedded content
   * @link  https://www.w3schools.com/tags/att_embed_src.asp src attribute
   * @link  https://www.w3schools.com/tags/att_embed_type.asp type attribute
   */
  public function __construct(string $src, string $type = null) {
    parent::__construct('object');
    $this->setSrc($src, $type);
  }

  public function __destruct() {
    unset($this->params);
    parent::__destruct();
  }

  /**
   * Sets the MIME type of the embedded component
   *
   * **Note:** The type attribute specifies the MIME type of the
   * embedded content.
   *
   * @param  string $url the MIME type of the embedded component
   * @param  string|null $type the MIME type of the embedded component
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_embed_type.asp type attribute
   */
  public function setSrc(string $url, string $type = null) {
    $this->attributes()->setAttribute('data', $url);
    if ($type === null) {
      $type = Mime::getMime($url);
    }
    $this->setType($type);
    return $this;
  }

  public function getSrc(): string {
    return $this->getAttribute('data');
  }

  /**
   * Sets the MIME type of the embedded component
   *
   * **Note:** The type attribute specifies the MIME type of the
   * embedded content.
   *
   * @param  string|null $type the MIME type of the embedded component
   * @return $this for a fluent interface
   * @link   https://www.w3schools.com/tags/att_object_type.asp type attribute
   */
  public function setType(string $type = null) {
    $this->attributes()->setAttribute('type', $type);
    return $this;
  }

  /**
   * Returns the value of the type attribute (The MIME type)
   *
   * **Note:** The type attribute specifies the MIME type of the
   * embedded content.
   *
   * @return string|null The MIME type of the embedded component or null if the MIME type is not set
   * @link  https://www.w3schools.com/tags/att_embed_type.asp type attribute
   */
  public function getType(): ?string {
    return $this->attributes()->getValue('type');
  }

  public function contentToString(): string {
    return implode($this->params)
            . "Your browser does not support the "
            . $this->getTagName() . " tag!";
  }

  public function insertParam(Param $src) {
    $this->params[] = $src;
    return $this;
  }

  /**
   * Adds a new parameter to the object
   * 
   * @param  string $name the name of a parameter
   * @param  scalar|null $value the value of a parameter
   * @link   https://www.w3schools.com/tags/att_param_name.asp name attribute
   * @link   https://www.w3schools.com/tags/att_param_value.asp value attribute
   * @return Param
   */
  public function addParam(string $name, $value = null): Param {
    $param = new Param($name, $value);
    $this->insertParam($param);
    return $param;
  }

  /**
   * Create a new iterator to iterate through content
   *
   * @return ContentIterator<int, Param> iterator
   */
  public function getIterator(): ContentIterator {
    return new ContentIterator($this->params);
  }

}
