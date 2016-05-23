<?php

/**
 * User.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use DateTime;
use Sphp\Util\Permissions as Permissions;

/**
 * Description of SessionData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @version 1.0.0
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 */
class SessionData extends AbstractDbObject {

  use \Sphp\Objects\ToArrayTrait;

  /**
   * primary database key
   *
   * @var int 
   * @Id @Column(type="integer")
   * @GeneratedValue
   */
  private $id;

  /**
   * @var User 
   * @ManyToOne(targetEntity="User", cascade={"persist"})
   * @JoinColumn(name="user_id", referencedColumnName="id", nullable=true)
   */
  private $user;

  /**
   *
   * @var DateTime 
   * @Column(type="datetimetz")
   */
  private $lastUpdated;

  /**
   *
   * @var Permissions 
   */
  private $permissions;

  /**
   * {@inheritdoc}
   */
  public function getPrimaryKey() {
    return $this->id;
  }

  /**
   * {@inheritdoc}
   */
  public function setPrimaryKey($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * 
   * @return string
   */
  public function getSid() {
    return $this->sid;
  }

  /**
   * 
   * @param  string $sid
   * @return self for PHP Method Chaining
   */
  public function setSid($sid) {
    $this->sid = $sid;
    return $this;
  }

  /**
   * 
   * @return User|null
   */
  function getUser() {
    return $this->user;
  }

  /**
   * 
   * @return DateTime
   */
  function getLastUpdated() {
    return $this->lastUpdated;
  }

  /**
   * 
   * @param  User $user
   * @return self for PHP Method Chaining
   */
  function setUser(User $user) {
    $this->user = $user;
    return $this;
  }

  /**
   * 
   * @param  DateTime $lastUpdated
   * @return self for PHP Method Chaining
   */
  function setLastUpdated(DateTime $lastUpdated) {
    $this->lastUpdated = $lastUpdated;
    return $this;
  }

  public function getPermissions() {
    return $this->permissions;
  }

  public function setPermissions(Permissions $permissions) {
    $this->permissions = $permissions;
    return $this;
  }

  /**
   * 
   * @param array $data
   * @return self for PHP Method Chaining
   */
  public function fromArray(array $data = []) {
    $this->setPrimaryKey(Arrays::getValue($data, "id"))
            ->setSid(Arrays::getValue($data, "sid"))
            ->setUser(Arrays::getValue($data, "fname"))
            ->setLname(Arrays::getValue($data, "lname"))
            ->setEmail(Arrays::getValue($data, "email"))
            ->setPhonenumbers(Arrays::getValue($data, "phonenumbers"))
            ->setAddress(new Address($data))
            ->setPermissions(Arrays::getValue($data, "permissions"))
            ->setPassword(Arrays::getValue($data, "passworn"));
    return $this;
  }

}
