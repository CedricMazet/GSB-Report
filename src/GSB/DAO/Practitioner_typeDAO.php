<?php

namespace GSB\DAO;

use GSB\Domain\Practitioner_type;

class Practitioner_typeDAO extends DAO
{
    /**
     * Returns the list of all families, sorted by name.
     *
     * @return array The list of all families.
     */
    public function findAll() {
        $sql = "select * from Practitioner_type order by Practitioner_type_name";
        $result = $this->getDb()->fetchAll($sql);
        
        // Converts query result to an array of domain objects
        $families = array();
        foreach ($result as $row) {
            $Practitioner_typeId = $row['Practitioner_type_id'];
            $families[$Practitioner_typeId] = $this->buildDomainObject($row);
        }
        return $families;
    }

    /**
     * Returns the Practitioner_type matching the given id.
     *
     * @param integer $id The Practitioner_type id.
     *
     * @return \GSB\Domain\Practitioner_type|throws an exception if no Practitioner_type is found.
     */
    public function find($id) {
        $sql = "select * from Practitioner_type where Practitioner_type_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No Practitioner_type found for id " . $id);
    }

    /**
     * Creates a Practitioner_type instance from a DB query result row.
     *
     * @param array $row The DB query result row.
     *
     * @return \GSB\Domain\Practitioner_type
     */
    protected function buildDomainObject($row) {
        $Practitioner_type = new Practitioner_type();
        $Practitioner_type->setId($row['Practitioner_type_id']);
        $Practitioner_type->setName($row['Practitioner_type_name']);
        return $Practitioner_type;
    }
}