<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\Icons;

use Sphp\Html\AbstractComponent;
use Sphp\Html\Content;
use IteratorAggregate;
use Traversable;
use Sphp\Html\ContentIterator;
use Sphp\Html\Navigation\A;

/**
 * Implements brand icon links bar
 * 
 * @method \Sphp\Html\Navigation\A facebook(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\A twitter(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\A googlePlus(string $url, string $screenReaderLabel = null) creates a hyperlink new icon object
 * @method \Sphp\Html\Navigation\A github(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\A tumblr(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\A stumbleupon(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\A pinterest(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 * @method \Sphp\Html\Navigation\A blogger(string $url, string $screenReaderLabel = null) creates a new hyperlink icon object
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 */
class IconButtons extends AbstractComponent implements Content, IteratorAggregate {

  /**
   * list of Font Awesome icons and corresponding PHP calls
   *
   * @var string[]
   */
  private static $map = array(
      'archive' => 'far fa-file-archive',
      'pdf' => 'far fa-file-pdf',
      'video' => 'far fa-file-video',
      'audio' => 'far fa-file-audio',
      'powerpoint' => 'far fa-file-powerpoint',
      'word' => 'far fa-file-word',
      'excel' => 'far fa-file-excel',
      'css' => 'fab fa-css3-alt',
      'image' => 'far fa-file-image',
      'text' => 'far fa-file-alt',
      'html5' => 'fab fa-html5',
      'php' => 'fab fa-php',
      'js' => 'fab fa-js-square',
      'font' => 'far fa-file',
      'executable' => 'fas fa-cogs',
      'database' => 'fas fa-database',
      'windows' => 'fab fa-windows',
      'code' => 'far fa-file-code',
      'certificate' => 'fas fa-certificate',
      'html5' => 'fab fa-html5',
      'sass' => 'fab fa-sass',
      'css3' => 'fab fa-css3',
      'php' => 'fab fa-php',
      'java' => 'fab fa-java',
      'js' => 'fab fa-js-square',
      'python' => 'fab fa-python',
      'nodejs' => 'fab fa-node-js',
      'npm' => 'fab fa-npm',
      'gulp' => 'fab fa-gulp',
      /**
       * Social
       */
      'facebook' => 'fab fa-facebook-square',
      'facebookF' => 'fab fa-facebook-f',
      'twitter' => 'fab fa-twitter-square',
      'googlePlus' => 'fab fa-google-plus-square',
      'githubSquare' => 'fab fa-github-square',
      'github' => 'fab fa-github',
      'chevronCircleUp' => 'fas fa-chevron-circle-up',
      'tumblr' => 'fab fa-tumblr-square',
      'stumbleupon' => 'fab fa-stumbleupon-circle',
      'stackoverflow' => 'fab fa-stack-overflow ',
      'pinterest' => 'fab fa-pinterest-square',
      'blogger' => 'fab fa-blogger',
      'cc' => 'fab fa-creative-commons',
      /**
       * General
       */
      'phone' => 'fas fa-phone',
      'envelope' => 'far fa-envelope',
      'user' => 'far fa-user',
      'users' => 'fas fa-users',
      'book' => 'fas fa-book',
      'database' => 'fas fa-database',
      'search' => 'fas fa-search',
      'copy' => 'far fa-copy',
      'ban' => 'fas fa-ban',
      'eraser' => 'fas fa-eraser',
      'exclamation' => 'fas fa-exclamation-triangle',
      'tags' => 'fas fa-tags',
      'stethoscope' => 'fas fa-stethoscope',
      'terminal' => 'fas fa-terminal',
      'flag' => 'fas fa-flag',
      'compass' => 'far fa-compass',
      'asterisk' => 'fas fa-asterisk',
      'home' => 'fas fa-home',
      /**
       * Brands
       */
      'apple' => 'fab fa-apple',
      'android' => 'fab fa-android',
      'angular' => 'fab fa-angular',
      'apper' => 'fab fa-apper',
      'blogger' => 'fab fa-blogger',
      'cpanel' => 'fab fa-cpanel',
      'digg' => 'fab fa-digg',
      'dropbox' => 'fab fa-dropbox',
      'dribbble' => 'fab fa-dribbble',
      'eye' => 'far fa-eye',
  );

  /**
   * @var A[]
   */
  private $icons;

  /**
   *
   * @var FontAwesome
   */
  private $fa;

  /**
   * Constructor
   */
  public function __construct() {
    parent::__construct('div');
    $this->icons = [];
    $this->addCssClass('sphp ', 'icon-buttons');
    $this->fa = new FontAwesome();
    $this->fa->fixedWidth(true);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->icons);
  }

  public function __call(string $name, array $arguments): A {
    $url = array_shift($arguments);
    $screenReaderText = array_shift($arguments);
    $target = array_shift($arguments);
    $icon = $this->fa->i(self::$map[$name], $screenReaderText);
    return $this->appendIcon($url, $icon, $target)->addCssClass($name);
  }

  public function appendLink(string $url, string $icon, string $screenreaderText = null): A {
    $this->fa->get($icon, $screenreaderText);
    return new A($url, $icon);
  }

  /**
   * Appends a link
   * 
   * @param  string $url the URL of the link
   * @param  Icon $icon the icon object acting as link
   * @param  string|null $target optional target of the hyperlink
   * @return A
   */
  protected function appendIcon(string $url, Icon $icon, string $target = null): A {
    $hyperlink = new A($url, $icon, $target);
    $hyperlink->addCssClass('sphp', 'icon-button');
    $this->icons[] = $hyperlink;
    return $hyperlink;
  }

  public function contentToString(): string {
    return implode($this->icons);
  }

  /**
   * Returns an external iterator
   *
   * @return Traversable external iterator
   */
  public function getIterator(): Traversable {
    return new ContentIterator($this->rows);
  }

}
