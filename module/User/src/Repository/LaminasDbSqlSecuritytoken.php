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
use User\Entity\Securitytoken;

/**
 * LaminasDbSqlSecuritytoken class
 *
 * @package User\Repository
 */
class LaminasDbSqlSecuritytoken implements SecuritytokenInterface
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
     * Construct the user repository
     * 
     * @param Sql $sql
     * @param Select $select
     * @param HydratingResultSet $resultSet
     */
    public function __construct(
        Sql $sql,
        Select $select,
        HydratingResultSet $resultSet
    ) {
        $this->sql = $sql;
        $this->select = $select;
        $this->resultSet = $resultSet;
        
    }
    
    /**
     * {@inheritDoc}
     */
    public function findByIdentity($identity): ?Securitytoken
    {
        $this->select->where(['identity = ?' => $identity]);
        $statement = $this->sql->prepareStatementForSqlObject($this->select);
        $result = $statement->execute();
        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
             
            return null;
        }
        $this->resultSet->initialize($result);
        $securitytoken = $this->resultSet->current();
        if (! $securitytoken instanceof Securitytoken) {
            
            return null;
        }
        
        return $securitytoken;        
    }
    
    /**
     * {@inheritDoc}
     */
    public function findByIdentifier($identifier): ?Securitytoken
    {
        $this->select->where(['identifier = ?' => $identifier]);
        $statement = $this->sql->prepareStatementForSqlObject($this->select);
        $result = $statement->execute();
        if (! $result instanceof ResultInterface || ! $result->isQueryResult()) {
             
            return null;
        }
        $this->resultSet->initialize($result);
        $securitytoken = $this->resultSet->current();
        if (! $securitytoken instanceof Securitytoken) {
            
            return null;
        }
        
        return $securitytoken;
    }
}
