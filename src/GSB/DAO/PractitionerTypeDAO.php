<?php

namespace GSB\DAO;

use GSB\Domain\PractitionerType;

class PractitionerTypeDAO extends DAO
{
    /**
     * Returns the list of all families, sorted by name.
     *
     * @return array The list of all families.
     */
    public function findAll() {
        $sql = "select * from practitioner_type order by practitioner_type_name";
        $result = $this->getDb()->fetchAll($sql);
        
        // Converts query result to an array of domain objects
        $families = array();
        foreach ($result as $row) {
            $PractitionerTypeId = $row['practitioner_type_id'];
            $PractitionerType[$PractitionerTypeId] = $this->buildDomainObject($row);
        }
        return $PractitionerType;
    }

    /**
     * Returns the PractitionerType matching the given id.
     *
     * @param integer $id The PractitionerType id.
     *
     * @return \GSB\Domain\PractitionerType|throws an exception if no PractitionerType is found.
     */
    public function find($id) {
        $sql = "select * from practitioner_type where practitioner_type_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No PractitionerType found for id " . $id);
    }

    /**
     * Creates a PractitionerType instance from a DB query result row.
     *
     * @param array $row The DB query result row.
     *
     * @return \GSB\Domain\PractitionerType
     */
    protected function buildDomainObject($row) {
        $PractitionerType = new PractitionerType();
        $PractitionerType->setId($row['practitioner_type_id']);
        $PractitionerType->setName($row['practitioner_type_name']);
        return $PractitionerType;
    }
}