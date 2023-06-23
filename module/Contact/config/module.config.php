<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 * 
 * This file is the module configuration for the contact module.
 *
 * @see        https://docs.laminas.dev/laminas-mvc/services/#default-configuration-options
 * @package    Contact
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Contact;

use Laminas\Router\Http\Literal;
use Laminas\ServiceManager\Factory\InvokableFactory;
use Contact\Controller\Factory\IndexControllerFactory;
use Contact\Service\Factory\MailSenderFactory;

return [   
    'controllers' => [
        'factories' => [
            Controller\IndexController::class => IndexControllerFactory::class,
        ],
    ],
    'router'      => [
        'routes' => [
            'contact' => [
                'type' => Literal::class,
                'options' => [
                    'route'    => '/kontakt',
                    'defaults' => [
                        'controller' => Controller\IndexController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'navigation'   => [
        'main_nav' => [
            [
                'label'         => 'Kontakt',
                'route'         => 'contact',
                'useRouteMatch' => true,
                'order'         => 15,
            ],
        ],
    ],
    'service_manager' => [
        'factories' => [
            Form\ContactForm::class            => InvokableFactory::class,
            Service\MailSenderInterface::class => MailSenderFactory::class,
        ],
    ],
    'view_manager'    => [
        'template_map'        => [
            'contact/index/index' => __DIR__ . '/../view/contact/index/index.phtml',
        ],
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
