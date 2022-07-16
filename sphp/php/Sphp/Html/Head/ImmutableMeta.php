<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\AbstractContent;
use Sphp\Html\Head\Exceptions\MetaDataException;

/**
 * Class ImmutableMeta
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ImmutableMeta extends AbstractContent implements MetaData {

  private array $attrs;

  /**
   * Constructor
   * 
   * @param  string[] $attrs an array of attribute name value pairs
   * @throws MetaDataException
   */
  public function __construct(array $attrs) {
    $count = 0;
    $count += isset($attrs['name']) ? 1 : 0;
    $count += isset($attrs['http-equiv']) ? 1 : 0;
    $count += isset($attrs['charset']) ? 1 : 0;
    $count += isset($attrs['property']) ? 1 : 0;
    if ($count !== 1 || (!isset($attrs['charset']) && !isset($attrs['content']))) {
      throw new MetaDataException('Incomplete or incorrect metadata attributes provided');
    }
    /* if(isset($attrs['charset']) && !isset($attrs['content'])) {
      throw new MetaDataException('No metadata content attribute provided');
      }
      if(isset($attrs['charset']) && !is_string($attrs['charset'])) {
      throw new MetaDataException('Metadata charset attribute provided with no content');
      }
      if(!isset($attrs['content']) || !is_scalar($attrs['content'])) {
      throw new MetaDataException('No metadata content attribute provided');
      } */
    $this->attrs = $attrs;
    ksort($this->attrs);
  }

  /**
   * Returns the meta data as an array
   * 
   * @return string[] meta data as an array
   */
  public function toArray(): array {
    return $this->attrs;
  }

  public function toTag(): \Sphp\Html\Tag {
    return new MetaTag($this->toArray());
  }

  public function getHtml(): string {
    return (string) $this->toTag();
  }

  public function getHash(): string {
    $attrs = 'meta:';
    if (array_key_exists('name', $this->attrs)) {
      $attrs .= 'name=' . $this->attrs['name'];
    } else if (array_key_exists('charset', $this->attrs)) {
      $attrs .= 'charset';
    } else if (array_key_exists('http-equiv', $this->attrs)) {
      $attrs .= 'http-equiv=' . $this->attrs['http-equiv'];
    } else if (array_key_exists('property', $this->attrs)) {
      $attrs .= 'property=' . $this->attrs['property'];
    }
    return md5($attrs);
  }

}
