<?php

namespace GSB\DAO;

use GSB\Domain\Practitioner;

class PractitionerDAO extends DAO
{
    /**
     * @var \GSB\DAO\PractitionerTypeDAO
     */
    private $PractitionerTypeDAO;

    public function setPractitionerTypeDAO($PractitionerTypeDAO) {
        $this->PractitionerTypeDAO = $PractitionerTypeDAO;
    }

    /**
     * Returns the list of all Practitioners, sorted by trade name.
     *
     * @return array The list of all Practitioners.
     */
    public function findAll() {
        $sql = "select * from practitioner order by practitioner_name";
        $result = $this->getDb()->fetchAll($sql);
        
        // Converts query result to an array of domain objects
        $Practitioners = array();
        foreach ($result as $row) {
            $PractitionerId = $row['practitioner_id'];
            $Practitioners[$PractitionerId] = $this->buildDomainObject($row);
        }
        return $Practitioners;
    }

    /**
     * Returns the list of all Practitioners for a given PractitionerType, sorted by trade name.
     *
     * @param integer $PractitionerTypeDd The PractitionerType id.
     *
     * @return array The list of Practitioners.
     */
    public function findAllByPractitionerType($PractitionerTypeId) {
        $sql = "select * from practitioner where practitioner_type_id=? order by practitioner_name";
        $result = $this->getDb()->fetchAll($sql, array($PractitionerTypeId));
        
        // Convert query result to an array of domain objects
        $Practitioners = array();
        foreach ($result as $row) {
            $PractitionerId = $row['practitioner_id'];
            $Practitioners[$PractitionerId] = $this->buildDomainObject($row);
        }
        return $Practitioners;
    }

    /**
     * Returns the Practitioner matching a given id.
     *
     * @param integer $id The Practitioner id.
     *
     * @return \GSB\Domain\Practitioner|throws an exception if no Practitioner is found.
     */
    public function find($id) {
        $sql = "select * from practitioner where practitioner_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No Practitioner found for id " . $id);
    }

    /**
     * Creates a Practitioner instance from a DB query result row.
     *
     * @param array $row The DB query result row.
     *
     * @return \GSB\Domain\Practitioner
     */
    protected function buildDomainObject($row) {
        $PractitionerTypeId = $row['practitioner_type_id'];
        $PractitionerType = $this->PractitionerTypeDAO->find($PractitionerTypeId);

        $Practitioner = new Practitioner();
        $Practitioner->setId($row['practitioner_id']);
        $Practitioner->setName($row['practitioner_name']);
        $Practitioner->setFirstName($row['practitioner_first_name']);
        $Practitioner->setAddress($row['practitioner_address']);
        $Practitioner->setZipCode($row['practitioner_zip_code']);
        $Practitioner->setCity($row['practitioner_city']);
        $Practitioner->setNotorietyCoefficient($row['notoriety_coefficient']);
        $Practitioner->setPractitionerType($PractitionerType);
        return $Practitioner;
    }
}