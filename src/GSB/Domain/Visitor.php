<?php

namespace GSB\Domain;

use Symfony\Component\Security\Core\User\UserInterface;

class Visitor implements UserInterface {

    /**
     * Practitioner id.
     *
     * @var integer
     */
    private $id;

    /**
     * Name.
     *
     * @var string
     */
    private $name;

    /**
     * First name.
     *
     * @var string
     */
    private $firstName;

    /**
     * last name.
     *
     * @var string
     */
    private $lastName;

    /**
     * Address.
     *
     * @var string
     */
    private $address;

    /**
     * Zip Code.
     *
     * @var string
     */
    private $zipCode;

    /**
     * City.
     *
     * @var string
     */
    private $city;

    /**
     * hiringDate.
     *
     * @var float
     */
    private $hiringDate;

    /**
     * username.
     *
     * @var String
     */
    private $username;

    /**
     * Type.
     *
     * @var String
     */
    private $password;

    /**
     * Salt.
     *
     * @var String
     */
    private $salt;

    /**
     * role.
     *
     * @var String
     */
    private $role;

    /**
     * Type.
     *
     * @var String
     */
    private $type;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getFirstName() {
        return $this->firstName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getZipCode() {
        return $this->zipCode;
    }

    public function setZipCode($zipCode) {
        $this->zipCode = $zipCode;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getHiringDate() {
        return $this->hiringDate;
    }

    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function getRole() {
        return $this->role;
    }

    public function setHiringDate($hiringDate) {
        $this->hiringDate = $hiringDate;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function setRole($role) {
        $this->role = $role;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getLastName() {
        return $this->lastName;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function eraseCredentials() {
        
    }
    
     public function getRoles()
    {
        return array($this->getRole());
    }


}
