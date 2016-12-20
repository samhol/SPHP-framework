<?php

/**
 * User.php (UTF-8)
 * Copyright (c) 2013 Sami Holck <sami.holck@gmail.com>
 */

namespace Sphp\Db\Objects;

use DateTime;
use Sphp\Util\Permissions;

/**
 * Description of SessionData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @since   2016-05-20
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPLv3
 * @filesource
 * @Entity
 * @Table(name="sessions",uniqueConstraints={@UniqueConstraint(name="uniquePersonName", columns={"fname", "lname"})})
 */
class SessionData extends AbstractDbObject {

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
   * @ManyToOne(targetEntity="SessionUser", cascade={"persist"})
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
   * @Embedded(class = "Sphp\Core\Security\Permissions", columnPrefix = "permission_") 
   */
  private $permissions;

  public function getPrimaryKey() {
    return $this->id;
  }

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

  public function equals($object) {
    return $this == $object;
  }

  public function toArray() {
    $raw = get_object_vars($this);
    $result = [];
    foreach ($raw as $prop => $val) {
      if ($val instanceof DbObjectInterface) {
        $result[$prop] = $val->toArray();
      }
      if ($val instanceof ArrayableObjectInterface) {
        $result = array_merge($result, $val->toArray());
      } else {
        $result[$prop] = $val;
      }
    }
    return $result;
  }

}
