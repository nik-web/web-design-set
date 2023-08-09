<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\Command  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Command;

use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Update;
use Laminas\Db\Sql\Delete;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Adapter\Driver\ResultInterface;
use User\Entity\User;


/**
 * LaminasDbSqlUser class
 *
 * @package User\Command
 */
class LaminasDbSqlUser implements UserInterface
{
    /**
     * @var Insert
     */
    private $insert;
    
    /**
     * @var Update
     */
    private $update;
    
    /**     
     * @var Delete
     */
    private $delete;

    /**
     * @var Sql
     */
    private $sql; 

    /**
     * Construct the user command
     * 
     * @param Insert $insert
     * @param Update $update
     * @param Sql $sql
     */
    public function __construct(Insert $insert, Update $update, Delete $delete, Sql $sql)
    {
        $this->insert = $insert;
        $this->update = $update;
        $this->delete = $delete;
        $this->sql = $sql;        
    }
    
    /**
     * {@inheritDoc}
     */
    public function insert(User $user): ?int
    {        
        $this->insert->values($user->getArrayCopy());
        $statement = $this->sql->prepareStatementForSqlObject($this->insert);
        $result = $statement->execute();
        if (! $result instanceof ResultInterface) {
            
            return null;
        }
        $id = intval($result->getGeneratedValue());
        
        return $id;
    }
    
    /**
     * {@inheritDoc}
     */
    public function update(User $user): ?User
    {
        if (! $user->getId()) {
            // Cannot update user; missing identifier
            return null;
        }
        $data = $user->getArrayCopy();
        unset($data['id']);        
        $this->update->set($data);        
        $this->update->where(['id = ?' => $user->getId()]);
        $statement = $this->sql->prepareStatementForSqlObject($this->update);
        $result = $statement->execute();        
        if (! $result instanceof ResultInterface) {
            
            return null;
        }
        
        return $user;
    }
    
    /**
     * {@inheritDoc}
     */
    public function delete(User $user): bool
    {
        if (! $user->getId()) {
            // Cannot delete user; missing identifier
            return false;
        }
        $this->delete->where(['id = ?' => $user->getId()]);
        $statement = $this->sql->prepareStatementForSqlObject($this->delete);
        $result = $statement->execute();
        if (! $result instanceof ResultInterface) {
            
            return false;
        }

        return true;
    }    
}
