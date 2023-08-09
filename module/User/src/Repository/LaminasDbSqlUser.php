<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\Repository  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Repository;

use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Select;
use Laminas\Db\Adapter\Driver\ResultInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Paginator\Paginator;
use User\Entity\User;

/**
 * LaminasDbSqlUser class
 *
 * @package User\Repository
 */
class LaminasDbSqlUser implements UserInterface
{
    /**
     * @var Sql
     */
    private $sql;
    
    /**
     * 
     * @var Select
     */
    private $select;

    /**
     * @var HydratingResultSet
     */
    private $resultSet;
    
    /**
     * @var Paginator
     */
    private $paginator;

    /**
     * Construct the user repository
     * 
     * @param Sql $sql
     * @param Select $select
     * @param HydratingResultSet $resultSet
     * @param Paginator $paginator
     */
    public function __construct(
        Sql $sql,
        Select $select,
        HydratingResultSet $resultSet,
        Paginator $paginator
    ) {
        $this->sql = $sql;
        $this->select = $select;
        $this->resultSet = $resultSet;
        $this->paginator = $paginator;
        
    }
    
    /**
     * {@inheritDoc}
     */
    public function findAllUsers()
    {
        $statement = $this->sql->prepareStatementForSqlObject($this->select);
        $result = $statement->execute();        
        if (!$result instanceof ResultInterface || !$result->isQueryResult()) {
            
            return [];
        }        
        $this->resultSet->initialize($result);
            
            return $this->resultSet;                                                
    }
    
    /**
     * {@inheritDoc}
     */
    public function findAllUsersPaginated()
    {
        return $this->paginator;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findUserById($id): ?User
    {
        $this->select->where(['id = ?' => $id]);
        $statement = $this->sql->prepareStatementForSqlObject($this->select);
        $result = $statement->execute();
        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
             
            return null;
        }
        $this->resultSet->initialize($result);
        $user = $this->resultSet->current();
        if (! $user instanceof User) {
            
            return null;
        }
        
        return $user;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findByEmail($email): ?User
    {
        $this->select->where(['email = ?' => $email]);
        $statement = $this->sql->prepareStatementForSqlObject($this->select);
        $result = $statement->execute();
        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            
            return null;
        }
        $this->resultSet->initialize($result);
        $user = $this->resultSet->current();
        if (! $user instanceof User) {
            
            return null;
        }
        
        return $user;
    }
        
    /**
     * {@inheritDoc}
     */
    public function findByAlias($alias): ?User
    {
        $this->select->where(['alias = ?' => $alias]);
        $statement = $this->sql->prepareStatementForSqlObject($this->select);
        $result = $statement->execute();
        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
            
            return null;
        }
        $this->resultSet->initialize($result);
        $user = $this->resultSet->current();
        if (! $user) {
            
            return null;
        }
        
        return $user;
    }
}
