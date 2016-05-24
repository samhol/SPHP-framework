<?php

namespace Sphp\Doctrine\Proxies\__CG__\Sphp\Db\Objects;

/**
 * DO NOT EDIT THIS FILE - IT WAS CREATED BY DOCTRINE'S PROXY GENERATOR
 */
class Address extends \Sphp\Db\Objects\Address implements \Doctrine\ORM\Proxy\Proxy
{
    /**
     * @var \Closure the callback responsible for loading properties in the proxy object. This callback is called with
     *      three parameters, being respectively the proxy object to be initialized, the method that triggered the
     *      initialization process and an array of ordered parameters that were passed to that method.
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setInitializer
     */
    public $__initializer__;

    /**
     * @var \Closure the callback responsible of loading properties that need to be copied in the cloned object
     *
     * @see \Doctrine\Common\Persistence\Proxy::__setCloner
     */
    public $__cloner__;

    /**
     * @var boolean flag indicating if this object was already initialized
     *
     * @see \Doctrine\Common\Persistence\Proxy::__isInitialized
     */
    public $__isInitialized__ = false;

    /**
     * @var array properties to be lazy loaded, with keys being the property
     *            names and values being their default values
     *
     * @see \Doctrine\Common\Persistence\Proxy::__getLazyProperties
     */
    public static $lazyPropertiesDefaults = [];



    /**
     * @param \Closure $initializer
     * @param \Closure $cloner
     */
    public function __construct($initializer = null, $cloner = null)
    {

        $this->__initializer__ = $initializer;
        $this->__cloner__      = $cloner;
    }







    /**
     * 
     * @return array
     */
    public function __sleep()
    {
        if ($this->__isInitialized__) {
            return ['__isInitialized__', '' . "\0" . 'Sphp\\Db\\Objects\\Address' . "\0" . 'id', '' . "\0" . 'Sphp\\Db\\Objects\\Address' . "\0" . 'street', '' . "\0" . 'Sphp\\Db\\Objects\\Address' . "\0" . 'zipcode', '' . "\0" . 'Sphp\\Db\\Objects\\Address' . "\0" . 'city', '' . "\0" . 'Sphp\\Db\\Objects\\Address' . "\0" . 'country'];
        }

        return ['__isInitialized__', '' . "\0" . 'Sphp\\Db\\Objects\\Address' . "\0" . 'id', '' . "\0" . 'Sphp\\Db\\Objects\\Address' . "\0" . 'street', '' . "\0" . 'Sphp\\Db\\Objects\\Address' . "\0" . 'zipcode', '' . "\0" . 'Sphp\\Db\\Objects\\Address' . "\0" . 'city', '' . "\0" . 'Sphp\\Db\\Objects\\Address' . "\0" . 'country'];
    }

    /**
     * 
     */
    public function __wakeup()
    {
        if ( ! $this->__isInitialized__) {
            $this->__initializer__ = function (Address $proxy) {
                $proxy->__setInitializer(null);
                $proxy->__setCloner(null);

                $existingProperties = get_object_vars($proxy);

                foreach ($proxy->__getLazyProperties() as $property => $defaultValue) {
                    if ( ! array_key_exists($property, $existingProperties)) {
                        $proxy->$property = $defaultValue;
                    }
                }
            };

        }
    }

    /**
     * 
     */
    public function __clone()
    {
        $this->__cloner__ && $this->__cloner__->__invoke($this, '__clone', []);
    }

    /**
     * Forces initialization of the proxy
     */
    public function __load()
    {
        $this->__initializer__ && $this->__initializer__->__invoke($this, '__load', []);
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitialized($initialized)
    {
        $this->__isInitialized__ = $initialized;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setInitializer(\Closure $initializer = null)
    {
        $this->__initializer__ = $initializer;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __getInitializer()
    {
        return $this->__initializer__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     */
    public function __setCloner(\Closure $cloner = null)
    {
        $this->__cloner__ = $cloner;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific cloning logic
     */
    public function __getCloner()
    {
        return $this->__cloner__;
    }

    /**
     * {@inheritDoc}
     * @internal generated method: use only when explicitly handling proxy specific loading logic
     * @static
     */
    public function __getLazyProperties()
    {
        return self::$lazyPropertiesDefaults;
    }

    
    /**
     * {@inheritDoc}
     */
    public function getStreet()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getStreet', []);

        return parent::getStreet();
    }

    /**
     * {@inheritDoc}
     */
    public function setStreet($streetaddress)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setStreet', [$streetaddress]);

        return parent::setStreet($streetaddress);
    }

    /**
     * {@inheritDoc}
     */
    public function getZipcode()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getZipcode', []);

        return parent::getZipcode();
    }

    /**
     * {@inheritDoc}
     */
    public function setZipcode($zipcode)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setZipcode', [$zipcode]);

        return parent::setZipcode($zipcode);
    }

    /**
     * {@inheritDoc}
     */
    public function getCity()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCity', []);

        return parent::getCity();
    }

    /**
     * {@inheritDoc}
     */
    public function setCity($city)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCity', [$city]);

        return parent::setCity($city);
    }

    /**
     * {@inheritDoc}
     */
    public function getCountry()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getCountry', []);

        return parent::getCountry();
    }

    /**
     * {@inheritDoc}
     */
    public function setCountry($country)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setCountry', [$country]);

        return parent::setCountry($country);
    }

    /**
     * {@inheritDoc}
     */
    public function fromArray(array $data = array (
))
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'fromArray', [$data]);

        return parent::fromArray($data);
    }

    /**
     * {@inheritDoc}
     */
    public function __toString()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, '__toString', []);

        return parent::__toString();
    }

    /**
     * {@inheritDoc}
     */
    public function getPrimaryKey()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'getPrimaryKey', []);

        return parent::getPrimaryKey();
    }

    /**
     * {@inheritDoc}
     */
    public function setPrimaryKey($id)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'setPrimaryKey', [$id]);

        return parent::setPrimaryKey($id);
    }

    /**
     * {@inheritDoc}
     */
    public function insertInto(\Doctrine\ORM\EntityManagerInterface $em)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'insertInto', [$em]);

        return parent::insertInto($em);
    }

    /**
     * {@inheritDoc}
     */
    public function isManagedBy(\Doctrine\ORM\EntityManagerInterface $em)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'isManagedBy', [$em]);

        return parent::isManagedBy($em);
    }

    /**
     * {@inheritDoc}
     */
    public function deleteFrom(\Doctrine\ORM\EntityManagerInterface $em)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'deleteFrom', [$em]);

        return parent::deleteFrom($em);
    }

    /**
     * {@inheritDoc}
     */
    public function toArray()
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'toArray', []);

        return parent::toArray();
    }

    /**
     * {@inheritDoc}
     */
    public function equals($object)
    {

        $this->__initializer__ && $this->__initializer__->__invoke($this, 'equals', [$object]);

        return parent::equals($object);
    }

}
