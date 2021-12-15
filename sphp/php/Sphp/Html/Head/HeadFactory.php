<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Head;

use Sphp\Html\Head\Exceptions\MetaDataException;
use Sphp\Html\Head\Links\ImmutableLinkData;

/**
 * Factory for HTML &lt;head&gt; components
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class HeadFactory {

  /**
   * @var MetaFactory 
   */
  private MetaFactory $metaBuilder;

  public function __construct() {
    $this->metaBuilder = MetaFactory::build();
  }

  /**
   * 
   * @param  string $path
   * @return Head new instance
   * @throws MetaDataException
   */
  public function fromYamlFile(string $path): Head {
    try {
      $y = new \Sphp\Stdlib\Parsers\Yaml();
      $meta = $y->fileToArray($path);
    } catch (\Exception $ex) {
      throw new MetaDataException('Invalid metadata file', 0, $ex);
    }
    return $this->fromArray($meta);
  }

  /**
   * Creates an HTML &lt;head&gt; component from given array of data
   * 
   * @param  array $meta the data to insert into the head
   * @return Head new instance
   * @throws MetaDataException
   */
  public function fromArray(array $meta): Head {
    $head = new Head();
    $group = $head->meta();
    //$err = 0;
    foreach ($meta as $tag) {
      if (!is_array($tag)) {
        throw new MetaDataException('Malformed metadata given');
      }
      if (isset($tag['meta']) ||
              isset($tag['meta:name']) ||
              isset($tag['meta:property']) ||
              isset($tag['meta:http-equiv']) ||
              isset($tag['meta:charset'])) {
        $obj = $this->buildMeta($tag);
        $group->insert($obj);
      } else if (isset($tag['link'])) {
        $obj = $this->buildLink($tag);
        $group->insert($obj);
      } else if (isset($tag['title']) && is_string($tag['title'])) {
        $obj = new Title($tag['title']);
        $group->insert($obj);
      } else if (isset($tag['base'])) {
        $obj = $this->buildBase($tag);
        $group->insert($obj);
      } else {
        //print_r($tag);
        throw new MetaDataException('Malformed metadata given');

        //  $err++;
      }
    }
    //var_dump($err);
    return $head;
  }

  protected function buildBase(array $rawData): Base {
    if (is_array($rawData['base'])) {
      $data = $rawData['base'];
    } else if (isset($rawData['base']) && is_string($rawData['base'])) {
      $data = $rawData;
      $data['href'] = $rawData['base'];
    } if (!isset($data['href']) || !is_string($data['href'])) {
      throw new MetaDataException('Malformed Base address data given');
    }
    $obj = new Base($data['href']);
    if (isset($data['target'])) {
      if (!is_string($data['target'])) {
        throw new MetaDataException('Invalid base address target type given');
      }
      $obj->setTarget($data['target']);
    }
    return $obj;
  }

  protected function buildLink(array $rawData): ImmutableLinkData {
    if (is_array($rawData['link'])) {
      $data = $rawData['link'];
    } else {
      $data = $rawData;
    }
    if (is_string($rawData['link'])) {
      $data['rel'] = $rawData['link'];
      unset($data['link']);
    }
    return new ImmutableLinkData($data);
  }

  protected function buildMeta(array $rawData): MetaData {
    if (isset($rawData['meta']) && is_array($rawData['meta'])) {
      $data = $rawData['meta'];
    } else {
      $data = $rawData;
      if (isset($rawData['meta:name'])) {
        $data['name'] = $rawData['meta:name'];
        unset($data['meta:name']);
      } else if (isset($rawData['meta:http-equiv'])) {
        $data['http-equiv'] = $rawData['meta:http-equiv'];
        unset($data['meta:http-equiv']);
      } else if (isset($rawData['meta:property'])) {
        $data['property'] = $rawData['meta:property'];
        unset($data['meta:property']);
      } else if (isset($rawData['meta:charset'])) {
        $data['charset'] = $rawData['meta:charset'];
        unset($data['meta:charset']);
      }
    }
    return new ImmutableMeta($data);
  }

}
