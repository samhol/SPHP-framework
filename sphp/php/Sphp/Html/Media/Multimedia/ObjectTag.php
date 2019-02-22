<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Multimedia;

use Sphp\Html\AbstractComponent;
use IteratorAggregate;
use Sphp\Html\Media\SizeableMedia;
use Sphp\Html\TraversableContent;

/**
 * Description of Object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class ObjectTag extends AbstractComponent implements IteratorAggregate, TraversableContent, SizeableMedia {

  use \Sphp\Html\TraversableTrait,
      \Sphp\Html\Media\SizeableMediaTrait;

  /**
   * @var Param[]
   */
  private $params = [];

  /**
   * Constructor
   *
   * @param string $src specifies the address of the external file to embed
   * @param string $type specifies the MIME type of the embedded content
   * @link  http://www.w3schools.com/tags/att_embed_src.asp src attribute
   * @link  http://www.w3schools.com/tags/att_embed_type.asp type attribute
   */
  public function __construct(string $src = null, string $type = null) {
    parent::__construct('object');
    if ($src !== null) {
      $this->setData($src);
    }
    if ($type !== null) {
      $this->setType($type);
    }
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
   * @param  string $type the MIME type of the embedded component
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_embed_type.asp type attribute
   */
  public function setData(string $type) {
    $this->attributes()->setAttribute('data', $type);
    return $this;
  }

  /**
   * Sets the MIME type of the embedded component
   *
   * **Note:** The type attribute specifies the MIME type of the
   * embedded content.
   *
   * @param  string $type the MIME type of the embedded component
   * @return $this for a fluent interface
   * @link   http://www.w3schools.com/tags/att_object_type.asp type attribute
   */
  public function setType(string $type) {
    $this->attributes()->setAttribute('type', $type);
    return $this;
  }

  /**
   * Returns the value of the type attribute (The MIME type)
   *
   * **Note:** The type attribute specifies the MIME type of the
   * embedded content.
   *
   * @return string The MIME type of the embedded component or null if the MIME type is not set
   * @link  http://www.w3schools.com/tags/att_embed_type.asp type attribute
   */
  public function getType(): string {
    return (string) $this->attributes()->getValue('type');
  }

  public function contentToString(): string {
    return implode($this->params)
            . "<p>Your browser does not support the &lt;"
            . $this->getTagName() . "&gt; tag!</p>";
  }

  public function insertParam(Param $src) {
    $this->params[] = $src;
    return $this;
  }

  public function addParam(string $src, string $type = null): Param {
    $param = new Param($src, $type);
    $this->insertParam($param);
    return $param;
  }

  /**
   * Create a new iterator to iterate through content
   *
   * @return Traversable iterator
   */
  public function getIterator(): Traversable {
    return new Iterator($this->params);
  }

}
