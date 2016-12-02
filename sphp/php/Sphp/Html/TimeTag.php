<?php

/**
 * TimeTag.php (UTF-8)
 * Copyright (c) 2012 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Html;

use DateTime;

/**
 * Class models an HTML &lt;time&gt; tag
 *
 * {@inheritdoc}
 * 
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2012-03-06
 * @link    http://www.w3schools.com/tags/tag_time.asp w3schools HTML API
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class TimeTag extends ContainerTag implements TimeTagInterface, AjaxLoaderInterface {

  use AjaxLoaderTrait;

  /**
   * the datetime object
   *
   * @var DateTime 
   */
  private $dateTime;

  /**
   * Constructs a new instance
   *
   * @param  DateTime $dateTime the datetime object
   * @param  mixed $content optional content of the component
   */
  public function __construct(DateTime $dateTime = null, $content = null) {
    parent::__construct('time', $content);
    if ($dateTime === null) {
      $dateTime = new DateTime();
    }
    $this->setDateTime($dateTime);
  }

  public function setDateTime(DateTime $dateTime) {
    $this->attrs()->set('datetime', $dateTime->format('Y-m-d H:i:s'));
    $this->dateTime = $dateTime;
    return $this;
  }
  
  public function getDateTime() {
    return $this->dateTime;
  }

}
