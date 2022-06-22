<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Documentation\Linkers\PHP\PHPManual\Books;

use Sphp\Documentation\Linkers\AbstractItemLinker;
use Sphp\Documentation\Linkers\HyperlinkFactory;
use Sphp\Html\Navigation\A;
use Sphp\Documentation\Linkers\Exceptions\NonDocumentedFeatureException;
use Sphp\Html\Text\Span;

/**
 * Description of BookLinker
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ReferenceLinker extends AbstractItemLinker {

  private static array $texts = [
      Book::INDEX => [
          'type' => 'index',
          'text' => '%s extension',
          'title' => 'Documentation of %1$s %2$s extension'
      ],
      Book::INTRO => [
          'type' => 'introduction',
          'text' => '%s introduction',
          'title' => 'Introduction of %1$s %2$s  extension'
      ],
      Book::SETUP => [
          'type' => 'setup',
          'text' => '%s setup',
          'title' => 'Documentation of %1$s %2$s extension setup'
      ],
      Book::INSTALLATION => [
          'type' => 'installation',
          'text' => '%s installation',
          'title' => 'Documentation of %1$s %2$s extension installation'
      ],
      Book::CONFIGURATION => [
          'type' => 'configuration',
          'text' => '%s configuration',
          'title' => 'Documentation of %2$s %1$s extension configuration'
      ],
      Book::RESOURCES => [
          'type' => 'resources',
          'text' => '%s resources',
          'title' => 'Documentation of %1$s %2$s extension resources'
      ],
      Book::CONSTANTS => [
          'type' => 'constants',
          'text' => '%s constants',
          'title' => 'Documentation of %1$s %2$s extension constants'
      ],
  ];
  private Reference $reference;

  /**
   * Constructor
   * 
   * @param Reference $book
   * @param HyperlinkFactory|null $hyperlinkFactory
   */
  public function __construct(Reference $book, ?HyperlinkFactory $hyperlinkFactory = null) {
    $this->reference = $book;
    parent::__construct($hyperlinkFactory);
    $this->getHyperlinkFactory()->useCssClass('php', 'api', 'book', 'php-manual');
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->reference);
    parent::__destruct();
  }

  public function getReference(): Reference {
    return $this->reference;
  }

  /**
   * Returns a hyperlink object pointing to an API page describing PHP function 
   *
   * @param  string $linkText optional link text
   * @return A hyperlink object pointing to the documentation
   */
  public function toHyperlink(string $linkText = null): A {
    return $this->getHyperlinkFor(Book::INDEX, $linkText);
  }

  /**
   * Returns a hyperlink object pointing to an API page describing PHP function 
   *
   * @param  string $type
   * @param  string $linkText optional link text
   * @return A hyperlink object pointing to the documentation
   */
  public function getHyperlinkFor(string $type = Book::INDEX, string $linkText = null): A {
    $this->getHyperlinkFactory()->useCssClass($type);
    if ($linkText === null) {
      $linkText = $this->getDefaultContent($type);
    }
    return $this->getHyperlinkFactory()
                    ->buildHyperlink($this->getUrl($type), $linkText);
  }

  public function toArray(): array {
    $out = [];
    foreach (self::$texts as $type => $data) {
      $out [] = $this->getHyperlinkFor($type, $data['type']);
    }
    return $out;
  }

  /**
   * Creates a new BreadCrumbs component showing the class and the trail of nested namespaces leading to it
   * 
   * @return Span new instance
   */
  public function toInlineNavBar(): Span {
    $output = \implode(' <strong>&#92;</strong> ', $this->toArray());
    $container = new Span($this->reference->getDescription() . ': ' . $output);
    return $container->addCssClass('api', 'namespace');
  }

  public function getDefaultContent(string $type = Book::INDEX): string {
    if ($type === Book::INDEX) {
      $text = $this->getReference()->getDescription();
    } else {
      $text = $this->getReference()->getDescription() . ' ' . $type;
    }
    return $text;
  }

  public function getDefaultTitle(string $type = Book::INDEX): string {
    if ($type === Book::INDEX) {
      $text = $this->getReference()->getDescription();
    } else {
      $text = $this->getReference()->getDescription() . ' ' . $type;
    }
    return $text;
  }

  /**
   * 
   * 
   * @param  string|null $type
   * @return string
   */
  public function getUrl(string $type = null): string {
    $ref = $this->getReference();
    if ($ref instanceof Book && $type !== null) {
      $url = $ref->getURL($type);
    } else {
      $url = $ref->getURL();
    }
    return $url;
  }

  /**
   * 
   * @param  string $referenceName
   * @param  HyperlinkFactory $hyperlinkFactory
   * @return ReferenceLinker
   * @throws NonDocumentedFeatureException if the Reference or the Book is not documented
   */
  public static function create(string $referenceName, HyperlinkFactory $hyperlinkFactory = null): ReferenceLinker {
    $data = ExtensionDataManager::instance()->getReference($referenceName);
    if ($data === null) {
      throw new NonDocumentedFeatureException("Reference or book $referenceName is not documented");
    }
    return new static($data, $hyperlinkFactory);
  }

}
