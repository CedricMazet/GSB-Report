<?php

namespace GSB\DAO;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use GSB\Domain\Visitor;

class VisitorDAO extends DAO implements UserProviderInterface
{
    /**
     * Returns a user matching the supplied id.
     *
     * @param integer $id
     *
     * @return \MicroCMS\Domain\User|throws an exception if no matching user is found
     */
    public function find($id) {
        $sql = "select * from visitor where visitor_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No user matching id " . $id);
    }
    public function loadUserByUsername($userName)
    {
        $sql = "select * from visitor where user_name=?";
        $row = $this->getDb()->fetchAssoc($sql, array($userName));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new UsernameNotFoundException(sprintf('Visitor "%s" not found.', $userName));
    }
    /**
     * {@inheritDoc}
     */
    public function refreshUser(UserInterface $visitor)
    {
        $class = get_class($visitor);
        if (!$this->supportsClass($class)) {
            throw new UnsupportedUserException(sprintf('Instances of "%s" are not supported.', $class));
        }
        return $this->loadUserByUsername($visitor->getUserName());
    }
      /**
     * {@inheritDoc}
     */
    public function supportsClass($class)
    {
        return 'GSB\Domain\Visitor' === $class;
    }
    /**
     * Creates a visitor object based on a DB row.
     *
     * @param array $row The DB row containing User data.
     * @return \GSB\Domain\visitor
     */
    protected function buildDomainObject($row) {
        $visitor = new Visitor();
        $visitor->setId($row['visitor_id']);
        $visitor->setUserName($row['user_name']);
        $visitor->setPassword($row['password']);
        $visitor->setSalt($row['salt']);
        $visitor->setRole($row['role']);
        $visitor->setLastName($row['visitor_last_name']);
        $visitor->setfirstName($row['visitor_first_name']);
        $visitor->setAddress($row['visitor_address']);
        $visitor->setZipCode($row['visitor_zip_code']);
        $visitor->setCity($row['visitor_city']);
        $visitor->setHiringDate($row['hiring_date']);
        $visitor->setType($row['visitor_type']);
        return $visitor;
    }
}

