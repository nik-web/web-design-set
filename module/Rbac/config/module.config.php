<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * This configuration of the rbac module is passed on to the
 * corresponding components by the ServiceManager.
 *
 * @see        https://docs.laminas.dev/laminas-mvc/services/#default-configuration-options
 * @package    Rbac  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Rbac;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;

return [   
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => InvokableFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'not-authorized'   => [
                'type'    => Literal::class,
                'options' => [
                    'route'       => '/keine-berechtigung',
                    'defaults'    => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'service_manager' => [
        'aliases'   => [
            Repository\RoleInterface::class     => Repository\LaminasDbSqlRole::class,
            Service\RbacManagerInterface::class => Service\RbacManager::class ,
        ],
        'factories' => [
            Repository\LaminasDbSqlRole::class => Repository\Factory\LaminasDbSqlRoleFactory::class,
            Service\RbacManager::class         => Service\Factory\RbacManagerFactory::class,
        ],
    ],
    'view_manager' => [
        'template_map'       => [
            'rbac/index/index' => __DIR__ . '/../view/rbac/index/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
