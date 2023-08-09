<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * This file is the module configuration for the user module.
 *
 * @see        https://docs.laminas.dev/laminas-mvc/services/#default-configuration-options
 * @package    User
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User;

use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\Router\Http\Literal;
use Laminas\Router\Http\Segment;
use Laminas\Authentication\AuthenticationService;
use Laminas\Authentication\AuthenticationServiceInterface;

return [
    'session_containers' => [
        'lastURLSessionContainer',
    ],
    'service_manager'    => [
        'aliases'   => [
            Repository\UserInterface::class          => Repository\LaminasDbSqlUser::class,
            Repository\SecuritytokenInterface::class => Repository\LaminasDbSqlSecuritytoken::class,
            Command\UserInterface::class             => Command\LaminasDbSqlUser::class,
            Command\SecuritytokenInterface::class    => Command\LaminasDbSqlSecuritytoken::class,
            Service\AuthAdapterInterface::class      => Service\AuthAdapter::class,
            AuthenticationServiceInterface::class    => AuthenticationService::class,
            Service\AuthManagerInterface::class      => Service\AuthManager::class,
        ],
        'factories'      => [
            Repository\LaminasDbSqlUser::class          => Repository\Factory\LaminasDbSqlUserFactory::class,
            Repository\LaminasDbSqlSecuritytoken::class => Repository\Factory\LaminasDbSqlSecuritytokenFactory::class,
            Form\UserAddForm::class                     => Form\Factory\UserAddFormFactory::class,
            Command\LaminasDbSqlUser::class             => Command\Factory\LaminasDbSqlUserFactory::class,
            Command\LaminasDbSqlSecuritytoken::class    => Command\Factory\LaminasDbSqlSecuritytokenFactory::class,
            Form\UserEditForm::class                    => InvokableFactory::class,
            Form\UserDeleteForm::class                  => InvokableFactory::class,
            Service\AuthAdapter::class                  => Service\Factory\AuthAdapterFactory::class,
            AuthenticationService::class                => Service\Factory\AuthenticationServiceFactory::class,
            Form\LoginForm::class                       => InvokableFactory::class,
            Service\AuthManager::class                  => Service\Factory\AuthManagerFactory::class,
            'sing_in_nav'                               => Service\Factory\SingInNavFactory::class,
            'account_nav'                               => Service\Factory\AccountNavFactory::class,
        ],
    ],  
    'controllers'       => [
        'factories' => [
            Controller\DisplayUsersController::class => Controller\Factory\DisplayUsersControllerFactory::class,
            Controller\AddUserController::class      => Controller\Factory\AddUserControllerFactory::class,
            Controller\EditUserController::class     => Controller\Factory\EditUserControllerFactory::class,
            Controller\DeleteUserController::class   => Controller\Factory\DeleteUserControllerFactory::class,
            Controller\AuthController::class         => Controller\Factory\AuthControllerFactory::class,
        ],
    ],
    'router'            => [
        'routes' => [
            'all-users' => [
                'type'    => Literal::class,
                'options' => [
                    'route'       => '/alle-nutzer',
                    'defaults'    => [
                        'controller' => Controller\DisplayUsersController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'all-users-paginated' => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/alle-nutzer/seite/:page',
                    'constraints' => [
                        'page' => '(?!0)\d+',
                    ],
                    'defaults'    => [
                        'controller' => Controller\DisplayUsersController::class,
                        'action'     => 'paginated',
                        'page'       => 1,
                    ],
                ],
            ],
            'user-detail'        => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/nutzer/:id',
                    'constraints' => [
                        'id' => '(?!0)\d+',
                    ],
                    'defaults'    => [
                        'controller' => Controller\DisplayUsersController::class,
                        'action'     => 'detail',
                    ],
                ],
            ],
            'user-login'          => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/anmelden',
                    'defaults' => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'login',
                    ],
                ],
            ],
            'user-logout'         => [
                'type'    => Literal::class,
                'options' => [
                    'route'       => '/abmelden',
                    'defaults'    => [
                        'controller' => Controller\AuthController::class,
                        'action'     => 'logout',
                    ],
                ],
            ],
            'add-user'         => [
                'type'    => Literal::class,
                'options' => [
                    'route'       => '/nutzer-anlegen',
                    'defaults'    => [
                        'controller' => Controller\AddUserController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'edit-user'        => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/nutzer-bearbeiten/:id',
                    'constraints' => [
                        'id' => '(?!0)\d+',
                    ],
                    'defaults'    => [
                        'controller' => Controller\EditUserController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'delete-user'          => [
                'type'    => Segment::class,
                'options' => [
                    'route'       => '/nutzer-entfernen/:id',
                    'constraints' => [
                        'id' => '(?!0)\d+',
                    ],
                    'defaults'    => [
                        'controller' => Controller\DeleteUserController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'navigation'      => [
        'sing_in_nav' => [
            [
                'label'         => 'Anmelden',
                'route'         => 'user-login',
                'useRouteMatch' => true,
                'order'         => 5,
            ],
        ],
    'account_nav' => [
        /*
        [
            'label'         => 'Meine Daten',
            'route'         => 'user-account',
            'useRouteMatch' => true,
            'order'         => 5,
        ],
        [
            'label'         => 'Konto löschen',
            'route'         => 'user-account-delete',
            'useRouteMatch' => true,
            'order'         => 50,
        ],
         * 
         */
        [
            'label'         => 'Abmelden',
            'route'         => 'user-logout',
            'useRouteMatch' => true,
            'order'         => 10,
        ],
    ], 
    ],
    'view_manager'    => [
        'template_map'        => [
            'user/display-users/index'      => __DIR__ . '/../view/user/display-users/index.phtml',
            'user/display-users/paginated'  => __DIR__ . '/../view/user/display-users/paginated.phtml',
            'user/display-users/detail'     => __DIR__ . '/../view/user/display-users/detail.phtml',
            'user/partial/list-entry-users' => __DIR__ . '/../view/user/partial/list-entry-users.phtml',
            'user/auth/login'               => __DIR__ . '/../view/user/auth/login.phtml',
            'user/add-user/index'           => __DIR__ . '/../view/user/add-user/index.phtml',
            'user/edit-user/index'          => __DIR__ . '/../view/user/edit-user/index.phtml',
            'user/delete-user/index'        => __DIR__ . '/../view/user/delete-user/index.phtml',
            'partials/nav-bars/sing_in'     => __DIR__ . '/../view/partials/nav-bars/sing_in.phtml',
            'partials/nav-bars/account'     => __DIR__ . '/../view/partials/nav-bars/account.phtml',
        ],
        'template_path_stack' => [
            //__DIR__ . '/../view',
        ],
    ],
];
