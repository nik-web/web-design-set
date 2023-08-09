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
use User\ValueObject\Data;
use User\Repository\LaminasDbSqlSecuritytoken;
use User\Entity\Securitytoken;


/**
 * LaminasDbSqlSecuritytokenFactory class
 *
 * @package User\Repository\Factory
 */
class LaminasDbSqlSecuritytokenFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return LaminasDbSqlSecuritytoken
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): LaminasDbSqlSecuritytoken {        
        $sql = new Sql($container->get(AdapterInterface::class));        
        //\Laminas\Db\Sql\Select   
        $select = $sql->select(Data::SECURITYTOKENS_DB_TABLE_NAME);        
        $hydrator = new ReflectionHydrator();
        // This strategy converts snake case strings to camel-case strings and vice versa.
        $strategy = new UnderscoreNamingStrategy();
        $hydrator->setNamingStrategy($strategy);        
        $resultSet = new HydratingResultSet(
            $hydrator,
            new Securitytoken('', '', '', '', '')
        );
        
        return new LaminasDbSqlSecuritytoken($sql, $select, $resultSet);
    }
}
