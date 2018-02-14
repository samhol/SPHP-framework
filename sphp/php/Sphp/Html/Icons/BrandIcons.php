<?php

/**
 * BrandIcons.php (UTF-8)
 * Copyright (c) 2017 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Icons;

use Sphp\Html\Content;
use Sphp\Html\Lists\Ul;
use Iterator;
use Sphp\Html\Navigation\Hyperlink;

/**
 * Description of BrandIcons
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class BrandIcons extends \Sphp\Html\AbstractComponent implements Content, Iterator {


  /**
   * @var Ul[] 
   */
  private $icons;

  /**
   * Constructs a new instance
   */
  public function __construct() {
    parent::__construct('div');
    $this->icons = new Ul();
    $this->addCssClass('brand-icons', 'rounded', 'logo');
  }

  /**
   * Destroys the instance
   *
   * The destructor method will be called as soon as there are no other references
   * to a particular object, or in any order during the shutdown sequence.
   */
  public function __destruct() {
    unset($this->icons);
  }

  /**
   * Appends a link pointing to a Github page
   * 
   * @param  string $url the URL of the link
   * @param  string $screenReaderLabel text visible for screen readers
   * @param  string|null $target optional target of the hyperlink
   * @return $this for a fluent interface
   */
  public function setGithub(string $url = 'https://www.github.com/', string $screenReaderLabel = 'Link to Github repository', string $target = null) {
    $this->appendIcon($url, Icons::fontAwesome('github', $screenReaderLabel), $target)->addCssClass('github');
    return $this;
  }

  /**
   * Appends a link pointing to a Facebook page
   * 
   * @param  string $url the URL of the link
   * @param  string $screenReaderLabel text visible for screen readers
   * @param  string|null $target optional target of the hyperlink
   * @return $this for a fluent interface
   */
  public function appendFacebook(string $url = 'https://www.facebook.com/', string $screenReaderLabel = 'Link to Facebook page', string $target = null) {
    $this->appendIcon($url, Icons::fontAwesome('facebook-square', $screenReaderLabel), $target)
            ->addCssClass('facebook');
    return $this;
  }

  /**
   * Appends a link pointing to a Twitter page
   * 
   * @param  string $url the URL of the link
   * @param  string $screenReaderText text visible for screen readers
   * @param  string|null $target optional target of the hyperlink
   * @return $this for a fluent interface
   */
  public function appendTwitter(string $url = 'https://twitter.com/', string $screenReaderText = 'Link to Twitter page', string $target = null) {
    $this->appendIcon($url, Icons::fontAwesome('twitter', $screenReaderText), $target)
            ->addCssClass('twitter');
    return $this;
  }

  /**
   * Appends a link pointing to a Google+ page
   * 
   * @param  string $url the URL of the link
   * @param  string $screenReaderText text visible for screen readers
   * @param  string|null $target optional target of the hyperlink
   * @return $this for a fluent interface
   */
  public function appendGooglePlus(string $url = 'https://plus.google.com/', string $screenReaderText = 'Link to Google plus page', string $target = null) {
    $this->appendIcon($url, Icons::fontAwesome('google-plus-square', $screenReaderText), $target)
            ->addCssClass('google-plus');
    return $this;
  }

  /**
   * Appends a link
   * 
   * @param  string $url the URL of the link
   * @param  Icon $icon the icon object acting as link
   * @param  string|null $target optional target of the hyperlink
   * @return Hyperlink
   */
  protected function appendIcon(string $url, Icon $icon, string $target = null): Hyperlink {
    $hyperlink = new Hyperlink($url, $icon, $target);
    $hyperlink->addCssClass('brand-icon');
    $this->icons[] = $hyperlink;
    return $hyperlink;
  }

  /*public function getHtml(): string {
    $ul = new Ul($this->icons);
    $ul->addCssClass('brand-icons', 'rounded', 'logo');
    return $ul->getHtml();
  }*/
  
  /**
   * 
   * @param  array $group
   * @param  string $value
   * @return $this for a fluent interface
   */
  protected function setOneOf(array $group, string $value = null) {
    if ($value === null) {
      $this->cssClasses()->remove($group);
    } else if (in_array($value, $group)) {
      $this->cssClasses()->remove($group)->add($value);
    }
    return $this;
  }

  /**
   * Returns the current element
   * 
   * @return mixed the current element
   */
  public function current() {
    return current($this->icons);
  }

  /**
   * Advance the internal pointer of the collection
   * 
   * @return void
   */
  public function next() {
    next($this->icons);
  }

  /**
   * Return the key of the current element
   * 
   * @return mixed the key of the current element
   */
  public function key() {
    return key($this->icons);
  }

  /**
   * Rewinds the Iterator to the first element
   * 
   * @return void
   */
  public function rewind() {
    reset($this->icons);
  }

  /**
   * Checks if current iterator position is valid
   * 
   * @return boolean current iterator position is valid
   */
  public function valid(): bool {
    return false !== current($this->icons);
  }

  public function contentToString(): string {
    return $this->icons->getHtml();
  }

}
