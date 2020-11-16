<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head\Links;

use Sphp\Html\AbstractContent;
use Sphp\Stdlib\Datastructures\Arrayable;
use Sphp\Html\Head\Exceptions\MetaDataException;

/**
 * Class Link
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ImmutableLinkData extends AbstractContent implements LinkInterface {

  private $attrs;

  /**
   * Constructor
   * 
   * @param  string[] $attrs
   * @throws MetaDataException
   */
  public function __construct(array $attrs) {
    $this->attrs = $attrs;
    if (!array_key_exists('rel', $attrs)) {
      throw new MetaDataException('rel attribute is required but not found from input');
    }if (!array_key_exists('href', $attrs)) {
      throw new MetaDataException('href attribute is required but not found from input');
    }
    ksort($this->attrs);
    settype($this->attrs['href'], 'string');
    settype($this->attrs['rel'], 'string');
  }

  public function toTag(): \Sphp\Html\Tag {
    return new LinkTag($this->toArray());
  }

  public function getHref(): string {
    return $this->attrs['href'];
  }

  public function getHtml(): string {
    return (string) $this->toTag();
  }

  public function getRel(): string {
    return $this->attrs['rel'];
  }

  public function toArray(): array {
    return $this->attrs;
  }

  public function getHash(): string {
    $data = ['link' => $this->attrs];
    return md5(json_encode($data));
  }

}
