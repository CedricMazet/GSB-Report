<?php

namespace GSB\Domain;

class Practitioner_type 
{
    /**
     * Practitioner_type id.
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
     * Code.
     *
     * @var integer
     */
	private $code;
	
	/**
     * Place.
     *
     * @var string
     */
	private $place;

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
	
	public function setCode($code) {
        $this->code = $code;
    }
	
	public function setPlace($place) {
        $this->place = $place;
    }
}