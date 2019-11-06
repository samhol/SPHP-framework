<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Manual\MVC;

use Sphp\Html\AbstractContent;
use Sphp\Html\Foundation\Sites\Core\ThrowableCalloutBuilder;
use Sphp\Html\Tags;
use Sphp\Html\Div;
use Sphp\Html\CssClassifiableContent;
use Sphp\Html\Attributes\ClassAttribute;

/**
 * Description of PageLoader
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class PageLoader extends AbstractContent implements CssClassifiableContent {

  use \Sphp\Html\CssClassifiableTrait;

  /**
   * @var Div
   */
  private $manual;

  /**
   * @var Div
   */
  private $container;

  public function __construct() {
    $this->tracker = \Sphp\Apps\Trackers\Controller::instance();
    $this->manual = Tags::div()->addCssClass('mainContent');
    $this->container = Tags::main()->addCssClass('container');
    $this->manual->append($this->container);
  }

  public function __destruct() {
    unset($this->manual, $this->container);
  }

  protected function load(string $path) {
    try {
      if (is_file($path)) {
        $this->tracker->run();
        $this->container->appendPhpFile($path);
      } else {
        http_response_code(404);
        $this->tracker->run();
        $this->addCssClass('error');
        $this->container->appendPhpFile('manual/templates/error.php');
      }
    } catch (\Throwable $e) {
      $this->container->append(ThrowableCalloutBuilder::build($e, true, true));
    }
    $this->printHtml();
  }

  public function loadNotFound(string $path = null) {
    http_response_code(404);
    $this->addCssClass('error');
    $this->load('manual/templates/error.php');
  }

  public function loadContactForm() {
    $this->load('./manual/form/form.php');
  }

  public function loadCalendar($par, $foo) {
    $this->load('manual/pages/calendar-app.php');
  }

  public function loadGettextFinder($par) {
    $this->load('manual/gettext/index.php');
  }

  public function loadPo($par) {
    $this->load('manual/po/poViewer.php');
  }

  public function loadPage($par, string $file = 'index') {
    $this->load("manual/pages/$file.php");
  }

  public function loadIndex() {
    $this->load('manual/pages/index.php');
  }

  public function loadVendorReadmes(string $path, string $vendorName) {
    $this->load("manual/pages/vendors/$vendorName.php");
  }

  public function loadIntros(string $path, string $introFor = null) {
    $this->container->appendPhpFile("manual/pages/intros/links.php");
    if ($introFor === null) {
      $introFor = 'main';
    } if (is_dir("manual/pages/intros/$introFor")) {
      $this->container->appendPhpFile("manual/pages/intros/$introFor/orbit.php");
      $this->printHtml();
    } else {
      $this->loadNotFound($path);
    }
  }

  public function cssClasses(): ClassAttribute {
    return $this->manual->cssClasses();
  }

  public function getHtml(): string {
    return $this->manual->getHtml();
  }

}
