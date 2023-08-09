<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\Repository\Factory  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Repository\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Hydrator\ReflectionHydrator;
use Laminas\Hydrator\NamingStrategy\UnderscoreNamingStrategy;
use User\Entity\User;
use User\ValueObject\Data;
use User\Repository\LaminasDbSqlUser;

use Laminas\Paginator\Adapter\LaminasDb\DbSelect;

use Laminas\Paginator\Paginator;


/**
 * LaminasDbSqlUserFactory class
 *
 * @package User\Repository\Factory
 */
class LaminasDbSqlUserFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return LaminasDbSqlUser
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): LaminasDbSqlUser {        
        $sql = new Sql($container->get(AdapterInterface::class));        
        //\Laminas\Db\Sql\Select   
        $select = $sql->select(Data::USERS_DB_TABLE_NAME);        
        $hydrator = new ReflectionHydrator();
        // This strategy converts snake case strings to camel-case strings and vice versa.
        $strategy = new UnderscoreNamingStrategy();
        $hydrator->setNamingStrategy($strategy);        
        $resultSet = new HydratingResultSet(
            $hydrator,
            new User('', '', '', '', '', '', '', '', '')
        );
        $paginatorAdapter = new DbSelect($select, $sql, $resultSet);
        $paginator = new Paginator($paginatorAdapter);
        
        return new LaminasDbSqlUser($sql, $select, $resultSet, $paginator);
    }
}
