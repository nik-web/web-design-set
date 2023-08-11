<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    Rbac\Repository  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace Rbac\Repository;

use Laminas\Db\Sql\Sql;
use Laminas\Db\Sql\Select;

/**
 * LaminasDbSqlRole class
 *
 * @package Rbac\Repository
 */
class LaminasDbSqlRole implements RoleInterface
{
    /**
     * @var Sql
     */
    private $sql;
    
    /**
     * @param Sql $sql
     */
    public function __construct(Sql $sql)
    {
        $this->sql = $sql;
    }
    
    /**
     * {@inheritDoc}
     */
    public function findAllRoleNamesByUserId($userId)
    {                        
        $select = $this->sql->select()
            ->from(['rr' => 'rbac_roles'])
            ->columns(['name'])
            ->join(
                ['ur' => 'rbac_users_and_roles_relationships'],
                'ur.role_id = rr.id',
                [],
                Select::JOIN_INNER
            )
            ->join(
                ['uu' => 'user_users'],
                'ur.user_id = uu.id',
                [],
                Select::JOIN_INNER
            )
            ->where(['uu.id' => $userId]);        
        $statement = $this->sql->prepareStatementForSqlObject($select);
        $result = $statement->execute();
        $roleNames = [];
        foreach ($result as $row) {
            $roleNames[] = $row['name'];
        }
        
        return $roleNames;
    }    
}
