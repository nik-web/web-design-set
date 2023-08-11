<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    Rbac\Repository\Factory  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace Rbac\Repository\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\Db\Adapter\AdapterInterface;
use Laminas\Db\Sql\Sql;
use Rbac\Repository\LaminasDbSqlRole;


/**
 * LaminasDbSqlRoleFactory class
 *
 * @package Rbac\Repository\Factory
 */
class LaminasDbSqlRoleFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return LaminasDbSqlRole
     */
    public function __invoke(
        ContainerInterface $container,
        $requestedName,
        array $options = null
    ): LaminasDbSqlRole {
        
        $db = $container->get(AdapterInterface::class);
        $sql = new Sql($db);
        
        return new LaminasDbSqlRole($sql);
    }
}
