<?php

namespace GSB\DAO;

use GSB\Domain\Practitioner;

class PractitionerDAO extends DAO
{
    /**
     * @var \GSB\DAO\Practitioner_typeDAO
     */
    private $Practitioner_typeDAO;

    public function setPractitioner_typeDAO($Practitioner_typeDAO) {
        $this->Practitioner_typeDAO = $Practitioner_typeDAO;
    }

    /**
     * Returns the list of all Practitioners, sorted by trade name.
     *
     * @return array The list of all Practitioners.
     */
    public function findAll() {
        $sql = "select * from Practitioner order by trade_name";
        $result = $this->getDb()->fetchAll($sql);
        
        // Converts query result to an array of domain objects
        $Practitioners = array();
        foreach ($result as $row) {
            $PractitionerId = $row['Practitioner_id'];
            $Practitioners[$PractitionerId] = $this->buildDomainObject($row);
        }
        return $Practitioners;
    }

    /**
     * Returns the list of all Practitioners for a given Practitioner_type, sorted by trade name.
     *
     * @param integer $Practitioner_typeDd The Practitioner_type id.
     *
     * @return array The list of Practitioners.
     */
    public function findAllByPractitioner_type($Practitioner_typeId) {
        $sql = "select * from Practitioner where Practitioner_type_id=? order by trade_name";
        $result = $this->getDb()->fetchAll($sql, array($Practitioner_typeId));
        
        // Convert query result to an array of domain objects
        $Practitioners = array();
        foreach ($result as $row) {
            $PractitionerId = $row['Practitioner_id'];
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
        $sql = "select * from Practitioner where Practitioner_id=?";
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
        $Practitioner_typeId = $row['Practitioner_type_id'];
        $Practitioner_type = $this->Practitioner_typeDAO->find($Practitioner_typeId);

        $Practitioner = new Practitioner();
        $Practitioner->setId($row['Practitioner_id']);
        $Practitioner->setCopyrighting($row['copyrighting']);
        $Practitioner->setTradeName($row['trade_name']);
        $Practitioner->setContent($row['content']);
        $Practitioner->setEffects($row['effects']);
        $Practitioner->setContraindication($row['contraindication']);
        $Practitioner->setSamplePrice($row['sample_price']);
        $Practitioner->setPractitioner_type($Practitioner_type);
        return $Practitioner;
    }
}