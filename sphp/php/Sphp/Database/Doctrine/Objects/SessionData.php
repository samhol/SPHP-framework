<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */
namespace Sphp\Database\Doctrine\Objects;

use DateTime;
use Sphp\Util\Permissions;

/**
 * Description of SessionData
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @filesource
 * @Entity
 * @Table(name="sessions",uniqueConstraints={@UniqueConstraint(name="uniquePersonName", columns={"fname", "lname"})})
 */
class SessionData extends AbstractArrayableObject {

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
   * @return $this for a fluent interface
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
   * @return $this for a fluent interface
   */
  function setUser(User $user) {
    $this->user = $user;
    return $this;
  }

  /**
   * 
   * @param  DateTime $lastUpdated
   * @return $this for a fluent interface
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
   * @return $this for a fluent interface
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

  public function toArray(): array {
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
