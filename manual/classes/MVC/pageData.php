<?php

namespace Sphp\Manual\MVC;

use Sphp\Core\Path;

class pageData {

  private $currentPage;
  private $errorCode;

  /**
   *
   * @var self 
   */
  private static $instance;

  public function __construct() {
    $this->parseCurrentPage();
  }

  public static function instance() {
    if (self::$instance === null) {
      self::$instance = new static();
    }
    return self::$instance;
  }

  private function parseCurrentPage() {
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_SPECIAL_CHARS);
    $page = str_replace(['/', '\\', '..', '..'], '', $page);
    echo $page."\nmanual/pages/.$page.php\n";
    if (!Path::get()->isPathFromRoot("manual/pages/$page.php")) {
      $this->currentPage = 'error';
    } else if($page != ''){
      $this->currentPage = Path::get()->local("manual/pages/$page.php");
    } else {
      $this->currentPage = Path::get()->local("manual/pages/index.php");
    }
    return $this;
  }

  private function parseErrorCode() {
    $errorCode = filter_input(INPUT_SERVER, 'REDIRECT_STATUS', FILTER_SANITIZE_NUMBER_INT);
    if ($errorCode === null) {
      $errorCode = filter_input(INPUT_GET, 'error_code', FILTER_SANITIZE_NUMBER_INT);
    }
  }

  public function hasErrors() {
    return $this->errorCode >= 400;
  }

  public function currentPage() {
    return $this->currentPage;
  }

}
