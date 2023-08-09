<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\Command\Factory  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Command\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\Db\Sql\Insert;
use Laminas\Db\Sql\Update;
use Laminas\Db\Sql\Delete;
use Laminas\Db\Sql\Sql;
use Laminas\Db\Adapter\AdapterInterface;
use User\ValueObject\Data;
use User\Command\LaminasDbSqlSecuritytoken;

/**
 * LaminasDbSqlSecuritytokenFactory class
 *
 * @package User\Command\Factory
 */
class LaminasDbSqlSecuritytokenFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return LaminasDbSqlSecuritytoken
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): LaminasDbSqlSecuritytoken
    {
        $insert = new Insert(Data::SECURITYTOKENS_DB_TABLE_NAME);
        $update = new Update(Data::SECURITYTOKENS_DB_TABLE_NAME);
        $delete = new Delete(Data::SECURITYTOKENS_DB_TABLE_NAME);
        $sql = new Sql($container->get(AdapterInterface::class));
        
        return new LaminasDbSqlSecuritytoken($insert, $update, $delete, $sql);
    }
}
