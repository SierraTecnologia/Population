<?php

namespace Population\Models\Entytys\Digital\Infra\Ci\Base;

use SiUtils\Tools\Model;
use SiUtils\Tools\Exception\InvalidArgumentException;

class User extends Base
{
    /**
     * @var array
     */
    protected $data = [
        'id'            => null,
        'email'         => null,
        'hash'          => null,
        'is_admin'      => 0,
        'name'          => null,
        'language'      => null,
        'per_page'      => null,
        'provider_key'  => 'internal',
        'provider_data' => null,
        'remember_key'  => null,
    ];

    /**
     * @return int
     */
    public function getId()
    {
        return (int)$this->data['id'];
    }

    /**
     * @param int $value
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    public function setId($value)
    {
        $this->validateNotNull('id', $value);
        $this->validateInt('id', $value);

        if ($this->data['id'] === $value) {
            return false;
        }

        $this->data['id'] = $value;

        return $this->setModified('id');
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->data['email'];
    }

    /**
     * @param string $value
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    public function setEmail($value)
    {
        $this->validateNotNull('email', $value);
        $this->validateString('email', $value);

        if ($this->data['email'] === $value) {
            return false;
        }

        $this->data['email'] = $value;

        return $this->setModified('email');
    }

    /**
     * @return string
     */
    public function getHash()
    {
        return $this->data['hash'];
    }

    /**
     * @param string $value
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    public function setHash($value)
    {
        $this->validateNotNull('hash', $value);
        $this->validateString('hash', $value);

        if ($this->data['hash'] === $value) {
            return false;
        }

        $this->data['hash'] = $value;

        return $this->setModified('hash');
    }

    /**
     * @return bool
     */
    public function getIsAdmin()
    {
        return (bool)$this->data['is_admin'];
    }

    /**
     * @param bool $value
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    public function setIsAdmin($value)
    {
        $this->validateNotNull('is_admin', $value);
        $this->validateBoolean('is_admin', $value);

        if ($this->data['is_admin'] === (int)$value) {
            return false;
        }

        $this->data['is_admin'] = (int)$value;

        return $this->setModified('is_admin');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->data['name'];
    }

    /**
     * @param string $value
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    public function setName($value)
    {
        $this->validateNotNull('name', $value);
        $this->validateString('name', $value);

        if ($this->data['name'] === $value) {
            return false;
        }

        $this->data['name'] = $value;

        return $this->setModified('name');
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->data['language'];
    }

    /**
     * @param string $value
     *
     * @return bool
     */
    public function setLanguage($value)
    {
        if ($this->data['language'] === $value) {
            return false;
        }

        $this->data['language'] = $value;

        return $this->setModified('language');
    }

    /**
     * @return int
     */
    public function getPerPage()
    {
        return (int)$this->data['per_page'];
    }

    /**
     * @param int $value
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    public function setPerPage($value)
    {
        $this->validateInt('per_page', $value);

        if ($this->data['per_page'] === $value) {
            return false;
        }

        $this->data['per_page'] = $value;

        return $this->setModified('per_page');
    }

    /**
     * @return string
     */
    public function getProviderKey()
    {
        return $this->data['provider_key'];
    }

    /**
     * @param string $value
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    public function setProviderKey($value)
    {
        $this->validateNotNull('provider_key', $value);
        $this->validateString('provider_key', $value);

        if ($this->data['provider_key'] === $value) {
            return false;
        }

        $this->data['provider_key'] = $value;

        return $this->setModified('provider_key');
    }

    /**
     * @param string|null $key
     *
     * @return array|string|null
     */
    public function getProviderData($key = null)
    {
        $data         = json_decode($this->data['provider_data'], true);
        $providerData = null;
        if (is_null($key)) {
            $providerData = $data;
        } elseif (isset($data[$key])) {
            $providerData = $data[$key];
        }

        return $providerData;
    }

    /**
     * @param array $value
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    public function setProviderData(array $value)
    {
        $this->validateNotNull('provider_data', $value);

        $providerData = json_encode($value);
        if ($this->data['provider_data'] === $providerData) {
            return false;
        }

        $this->data['provider_data'] = $providerData;

        return $this->setModified('provider_data');
    }

    /**
     * @return string
     */
    public function getRememberKey()
    {
        return $this->data['remember_key'];
    }

    /**
     * @param string $value
     *
     * @return bool
     *
     * @throws InvalidArgumentException
     */
    public function setRememberKey($value)
    {
        $this->validateString('remember_key', $value);

        if ($this->data['remember_key'] === $value) {
            return false;
        }

        $this->data['remember_key'] = $value;

        return $this->setModified('remember_key');
    }
}
