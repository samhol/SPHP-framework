<?php

/**
 * PhotoAlbum.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html\Apps;

use Sphp\Html\AbstractContainerComponent;
use Sphp\Html\Div;
use Sphp\Stdlib\Strings;
use Sphp\Stdlib\Arrays;
use Sphp\Images\Images as ImageUtils;
use Sphp\Html\Navigation\Hyperlink;
use Sphp\Html\Foundation\Buttons\HyperlinkButton;
use Sphp\Html\Foundation\Structure\Row;
use Sphp\Html\Tables\Table;
use Sphp\Html\Tables\Th;
use Sphp\Html\Lists\Ul;
use Sphp\Html\Lists\Li;
use Sphp\Html\Media\Img;

/**
 * A photoalbum application
 *
 * {@inheritdoc}
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2011-03-06
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class PhotoAlbum extends AbstractContainerComponent {

  /**
   * the filelist
   *
   * @var \SplFileInfo[]
   */
  private $albumPaths = [];

  /**
   * The content of the opener button
   *
   * @var string 
   */
  private $buttonContent = "Photo album";

  /**
   * Constructs a new instance
   *
   * @param string $albumPaths the paths to the files/folders presented in this album
   * @param string $albumName the title of the albumo
   */
  public function __construct($albumPaths = ALBUM_PATH, $albumName = "Photo album") {
    parent::__construct('div');
    $this->setAlbumPaths($albumPaths)
            ->build()
            ->setHeading($albumName)
            ->identify();
    $this->cssClasses()->lock("sphp-photoAlbum reveal-modal full");
    $this->attrs()->demand("data-reveal");
    //->appendScriptPath("sph/js/vendor/jquery.js")
    //->appendScriptPath("sph/js/vendor/jquery.unveil.min.js")
    //->appendScriptPath("sph/js/sphp/PhotoAlbum.js");
  }

  public function setButtonContent($content) {
    $this->buttonContent;
  }

  /**
   * Builds the application
   *
   * @return self for a fluent interface
   */
  private function build() {
    $this->getInnerContainer()
            ->set("heading", (new Div())->addCssClass("header"))
            ->set("body", (new Row())->addCssClass("content sphp-photoalbum-row collapse"))
            ->set("footer", (new Div('<strong>&laquo; A:L:B:U:M:Z:T:&Euml;:R &raquo;</strong> COPYRIGHT &copy; Sami Holck 2007-' . date("Y")))->addCssClass("footer"));

    $this->getBody()
            ->appendColumn((new Div($this->getSubFolders($this->albumPaths)->removeCssClass("files")))
                    ->addCssClass("folderView"), 0, 3)
            ->appendColumn($this->getPreviewer($this->albumPaths), 12, 9)
            ->appendColumn($this->generateThumbnailBrowser($this->albumPaths), 12);
    return $this;
  }

  /**
   * Returns the head section of the album
   * 
   * @return Div the head section of the album
   */
  private function getHead() {
    return $this->getInnerContainer()->get("heading");
  }

  /**
   * Returns the body section of the album
   * 
   * @return Row the body section of the album
   */
  private function getBody() {
    return $this->getInnerContainer()->get("body");
  }

  /**
   * Returns the footer section of the album
   * 
   * @return Div the footer section of the album
   */
  private function getFoot() {
    return $this->getInnerContainer()->get("footer");
  }

  /**
   * Sets the paths of the viewed files an folders in thephoto album
   *
   * @param string|string[] $albumPaths the paths to the files/folders presented in this album
   * @return self for a fluent interface
   */
  public function setAlbumPaths($albumPaths) {
    if (!is_array($albumPaths)) {
      $albumPaths = [$albumPaths];
    }
    $this->albumPaths = [];
    foreach ($albumPaths as $path) {
      $iterator = new \RecursiveDirectoryIterator($path);
      $this->albumPaths = array_merge($this->albumPaths, [$path => self::generateFileListArray($iterator)]);
    }
    //echo "<pre>";
    //print_r($this->albumPaths);
    return $this;
  }

  /**
   * Generates the filesystem array from given iterator
   *
   * @param  \RecursiveDirectoryIterator $iterator
   * @return \SplFileInfo[]
   */
  private static function generateFileListArray(\RecursiveDirectoryIterator $iterator) {
    $filelist = array();
    $iterator->setFlags(\FilesystemIterator::SKIP_DOTS);
    $iterator->setFlags(\FilesystemIterator::CURRENT_AS_FILEINFO);
    $iterator->setFlags(\FilesystemIterator::KEY_AS_PATHNAME);
    foreach ($iterator as $pathName => $entry) {
      if ($entry->getBasename() != ".." && $entry->getBasename() != ".") {
        if ($entry->isFile() && ImageUtils::isImagineImage($entry)) {
          $filelist[$entry->getBasename()] = $entry;
        } else if ($entry->isDir()) {
          $filelist[$entry->getBasename()] = self::generateFileListArray(new \RecursiveDirectoryIterator($pathName));
        }
      }
    }
    ksort($filelist);
    return $filelist;
  }

  /**
   * Sets the heading content
   *
   * @param  mixed $headingText the heading content
   * @return self for a fluent interface
   */
  public function setHeading($headingText) {
    $this->getHead()->replaceContent($headingText);
    return $this;
  }

  /**
   * Generates a thumbnailBrowser
   *
   * @return Div thumbnailBrowser
   */
  private function generateThumbnailBrowser() {
    //echo "generateThumbnailBrowser";
    $thumbnailBrowser = (new Div())->addCssClass("thumbnailBrowser");
    $shiftLeft = (new Div())
            ->append(new Img("sph/pics/photoAlbum/arrLGray.png", "&lt;&lt;"))
            ->addCssClass("shiftLeft");
    $thumbnailBrowser[] = $shiftLeft;
    $files = Arrays::flatten($this->albumPaths);
    //echo "<pre>";
    //print_r($files);
    foreach ($files as $img_index => $file) {
      if (ImageUtils::isImagineImage($file)) {
        $img = (new Img("sph/pics/loader.gif", "Photo"))
                ->setAttr("data-src", \Sphp\Images\SCALER . '?w=91&amp;h=68&amp;src=' . $file);
        $thumbnailDiv = (new Div(array($img)))
                ->setAttr("data-dir-path", $file->getPath())
                ->setAttr("data-file-path", $file)
                ->setAttr("data-img_index", $img_index)
                ->addCssClass("thumbnail")
                ->setDocumentTitle("Preview picture");
        $thumbnailBrowser[] = $thumbnailDiv;
      }
    }
    $shiftRightDiv = (new Div(new Img("sph/pics/photoAlbum/arrRGray.png", "&gt;&gt;")))
            ->addCssClass("shiftRight");
    $thumbnailBrowser[] = $shiftRightDiv;
    return $thumbnailBrowser;
  }

  /**
   * Returns valokuvien esikatselunäkymän
   *
   * @return Div esikatselunäkymä
   */
  private function getPreviewer() {
    //echo "getPreviewer";
    $files = Arrays::flatten($this->albumPaths);
    $previewer = (new Div())->addCssClass("previewer");
    $photoArea = (new Div())->addCssClass("photo");
    $shiftLeft = (new Div())
            ->append(new Img("sph/pics/photoAlbum/arrLGray.png", "&lt;&lt;"))
            ->addCssClass("prevImg");
    foreach ($files as $img_index => $file) {
      if (ImageUtils::isImagineImage($file)) {
        $img = (new Img("sph/pics/loader.gif", "Photo"))
                ->setAttr("data-src", \Sphp\Images\SCALER . 'src=' . $file)
                ->setAttr("data-scaler-path", \Sphp\Images\SCALER . "?src=$file");
        $thumbnailDiv = (new Div(array($img)))
                ->setAttr("data-file-path", $file)
                ->setAttr("data-img_index", $img_index)
                ->addCssClass("thumbnail");
        $thumbnailDiv->inlineStyles()->setProperty('display', 'none');
        $photoArea[] = $thumbnailDiv;
      }
    }
    $shiftRightDiv = (new Div(new Img("sph/pics/photoAlbum/arrRGray.png", "&gt;&gt;")))
            ->addCssClass("nextImg");
    //$thumbnailBrowser[] = $shiftRightDiv;
    $previewer[] = $shiftLeft;
    $previewer[] = $photoArea;
    $previewer[] = $shiftRightDiv;
    $previewer[] = (new Div())->addCssClass("info");
    return $previewer;
  }

  /**
   * Returns info table about the givrn image
   *
   * @param string $imgSrc
   * @return Table|null
   */
  public static function getImageInfoTable($imgSrc) {
    if (ImageUtils::isImagineImage($imgSrc)) {
      $info = ImageUtils::getImageInfo($imgSrc);
      //echo "<pre>";
      //print_r($info);
      $table = new Table();
      $theadTh = new Th('&laquo; ' . self::stripIllegalChars($info["basename"]) . ' &raquo;', "colgroup", 2);
      $table->thead()->append($theadTh);
      $table->tbody()->append(array(
          new Th("Dimensions:"),
          "(" . $info["width"] . "x" . $info["height"] . ") px")
      );
      $table->tbody()->append(array(
          new Th("File size:"),
          Strings::generateFilesizeString($info["size_B"])));
      $table->tbody()->append(array(
          new Th("Modified:", 1, 1, "row"),
          $info["modified"]->format("d.m.Y k\l\o H:i.s")));
      //echo \Sphp\HTTP_ROOT . $imgSrc;
      $table->tfoot()->append(new Th(new Hyperlink(\Sphp\HTTP_ROOT . str_replace("../", "", $imgSrc), "Link to the original picture", "picture"), "row", 2));
      return $table;
    } else {
      return null;
    }
  }

  /**
   * Returns the subfolders recursively
   *
   * @param  array $dirTree directory tree
   * @param  string $dir already parsed path in the directory tree
   * @param  int $img_index already parsed path in the directory tree
   * @return lists\Ul[]
   */
  private function getSubFolders(array $dirTree, $dir = "", &$img_index = 0) {
    //echo "getSubFolders";
    $rootComponent = new Ul();
    $rootComponent->addCssClass("files");
    $currentDir = $dir;
    if ($dir !== "") {
      $dir .= "/";
    }
    //print_r($dirTree);
    foreach ($dirTree as $name => $file) {
      if (!is_array($file) && ImageUtils::isImage($dir . $name)) { //file (only images accepted)
        $li = new Li();
        $li->append([new Img("sph/pics/tree/photo.png"), $name])
                ->addCssClass("file")
                ->setAttr("data-file-dir-path", $currentDir)
                ->setAttr("data-file-path", $dir . $name)
                ->setAttr("data-img_index", $img_index);
        $img_index++;
        $rootComponent->append($li);
      } else if (count($file) > 0) { //directory (not empty)
        $li = new Li();
        $subComponent = $this->getSubFolders($file, $dir . $name, $img_index);
        $li[] = (new Div())
                ->append(new Img("sph/pics/tree/openedFolder.png"))
                ->append($name)
                ->addCssClass("folder")
                ->setAttr("data-dir-path", $dir . $name);
        $li[] = $subComponent;
        $rootComponent->append($li);
        //$li->addStyleName("folder");
      }
    }
    return $rootComponent;
  }

  /**
   * Changes the following charasters from input string to the output string
   *
   *   * "_" -> " "
   *   * "(a)" -> "ä"
   *   * "(o)" -> "ö"
   *   * "(ao)" -> "å"
   *   * "(A)" -> "Ä"
   *   * "(O)" -> "Ö"
   *   * "(AO) -> "Å"
   * 
   * @param  string $string the input string
   * @return string the output string
   */
  private static function stripIllegalChars($string) {
    $wrong = array("_", "(a)", "(o)", "(ao)", "(A)", "(O)", "(AO)");
    $correct = array(" ", "ä", "ö", "å", "Ä", "Ö", "Å");
    return str_replace($wrong, $correct, $string);
  }

  /**
   * Returns a link component pointing to the Modal component
   *
   * **Important!**
   *
   * Parameter `$content` can be of any type that converts to a
   * string or to an array of strings. So also an object of any class
   * that implements magic method `__toString()` is allowed.
   *
   * @param  mixed $content the content of the link component
   * @return HyperlinkButton a link component pointing to the Modal component
   */
  public function getOpeningButton($content) {
    $atag = new HyperlinkButton("#", $content);
    $atag->setAttr("data-reveal-id", $this->getId())
            ->setAttr("data-reveal", "");
    return $atag;
  }

  public function getHtml() {
    return $this->getOpeningButton($this->buttonContent) . parent::getHtml();
  }

}
