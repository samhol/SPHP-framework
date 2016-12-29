<?php

/**
 * Dl.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Lists;

use Sphp\Html\ContainerTag;
use Sphp\Html\Navigation\Hyperlink;

/**
 * Implements an HTML &lt;dl&gt; tag
 *
 * The {@link self} component is used in conjunction with &lt;dt&gt; (defines the item in the list)
 * and &lt;dd&gt; (describes the item in the list).
 *
 *
 * {@inheritdoc}
 *
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2013-05-23
 * @link    http://www.w3schools.com/tags/tag_dl.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class Dl extends ContainerTag {

  /**
   * the default type of the content wrapper
   *
   * @var string 
   */
  private $defaultWrapper = "dt";

  /**
   * Constructs a new instance
   *
   * **Notes:**
   *
   * * <var>$defaultWrapper</var> can have two case insensitive values 'dt' and 'dd'
   * * `$defaultWrapper == 'dt'` => non {@link DlContentInterface} elements of `$items` are wrapped with {@link Dt}
   * * `$defaultWrapper == 'dd'` => non {@link DlContentInterface} elements of `$items` are wrapped with {@link Dd}
   * 
   * @param  null|mixed $items list elements
   * @param  string $defaultWrapper the tag name of the inserted non {@link DlContentInterface} elements
   */
  public function __construct($items = null, $defaultWrapper = "dt") {
    parent::__construct("dl");
    $this->setWrapperType($defaultWrapper);
    if ($items !== null) {
      $this->append($items);
    }
  }

  /**
   * Sets the default type of the content wrapper
   * 
   * @param  string $defaultWrapper
   * @return self for PHP Method Chaining
   */
  public function setWrapperType($defaultWrapper) {
    if (is_a($defaultWrapper, DlContentInterface::class, true)) {
      $this->defaultWrapper = $defaultWrapper;
    } else if (strtolower($defaultWrapper) == "dt") {
      $this->defaultWrapper = Dt::class;
    } else if (strtolower($defaultWrapper) == "dd") {
      $this->defaultWrapper = Dd::class;
    } else {
      throw new \InvalidArgumentException("");
    }
    return $this;
  }

  /**
   * Returns the input as an array of components extending {@link DlContentInterface}
   *
   * @param  mixed|mixed[] $it list elements
   * @return DlContentInterface[] Dedfinition list components
   */
  protected function wrapContent($it) {
    $newOpts = [];
    foreach ((is_array($it)) ? $it : [$it] as $item) {
      if ($item instanceof DlContentInterface) {
        $newOpts[] = $item;
      } else {
        $newOpts[] = new $this->defaultWrapper($item);
      }
    }
    return $newOpts;
  }

  /**
   * Appends elements to the object
   *
   * @param  mixed $it list elements
   * @return self for PHP Method Chaining
   */
  public function append($it) {
    parent::append($this->wrapContent($it));
    return $this;
  }

  /**
   * Appends {@link Hyperlink} link object to the list component
   *
   * @param  string $href the URL of the link
   * @param  mixed $content link content
   * @param  string $target the value of the target attribute
   * @return self for PHP Method Chaining
   * @link   http://www.w3schools.com/tags/att_a_href.asp href attribute
   * @link   http://www.w3schools.com/tags/att_a_target.asp target attribute
   */
  public function appendLink($href, $content = "", $target = "_self") {
    return $this->append(new Hyperlink($href, $content, $target));
  }

  /**
   * Appends {@link Dt} term component to the list
   *
   * @param  mixed $terms the term component or its content
   * @return self for PHP Method Chaining
   */
  public function appendTerms($terms) {
    foreach ((is_array($terms)) ? $terms : [$terms] as $term) {
      if (!($term instanceof Dt)) {
        $term = new Dt($term);
      }
      $this[] = $term;
    }
    return $this;
  }

  /**
   * Appends {@link Dd} description component to the list
   *
   * @param  mixed $descriptions the description components or their content
   * @return self for PHP Method Chaining
   */
  public function appendDescriptions($descriptions) {
    foreach ((is_array($descriptions)) ? $descriptions : [$descriptions] as $description) {
      if (!($description instanceof Dd)) {
        $description = new Dd($description);
      }
      $this[] = $description;
    }
    return $this;
  }

  /**
   * Prepends elements to the object
   *
   * **Notes:**
   * 
   * **The keys of the object will be renumbered starting from zero**
   * 
   * @param  mixed $it list elements
   * @return self for PHP Method Chaining
   */
  public function prepend($it) {
    parent::prepend($this->wrapContent($it));
    return $this;
  }

  /**
   * Assigns a value to the specified offset
   *
   * **Notes:**
   *
   * * mixed $value can be of any type that converts to a string or to a string[]
   * * a mixed $value is wrapped to a DtTag object
   *
   * @param mixed $offset the offset to assign the value to
   * @param mixed $value the value to set
   * @link  http://php.net/manual/en/arrayaccess.offsetset.php ArrayAccess::offsetGet
   */
  public function offsetSet($offset, $value) {
    $value = ($value instanceof DlContentInterface) ? $value : new $this->defaultWrapper($value);
    parent::offsetSet($offset, $value);
  }

}
