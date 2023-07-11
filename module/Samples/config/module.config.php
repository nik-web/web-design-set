<?php

/**
 * Samples module with Laminsas MVC framework
 * 
 * This file is the module configuration for the samples module.
 *
 * @package    Samples
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace Samples;

use Laminas\ServiceManager\Factory\InvokableFactory;
use Laminas\Router\Http\Literal;

return [
    'controllers' => [
        'factories' => [
            Controller\FlashController::class     => Controller\Factory\FlashControllerFactory::class,
            Controller\FlashShowController::class => InvokableFactory::class,
            Controller\RedirectController::class  => Controller\Factory\RedirectControllerFactory::class,
        ],
    ],
    'router' => [
        'routes' => [
            'sample-flash'     => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/flash-test',
                    'defaults' => [
                        'controller' => Controller\FlashController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'sample-flash-show' => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/flash-nachrichten/anzeigen',
                    'defaults' => [
                        'controller' => Controller\FlashShowController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
            'sample-redirect'  => [
                'type'    => Literal::class,
                'options' => [
                    'route'    => '/umleiten-test',
                    'defaults' => [
                        'controller' => Controller\RedirectController::class,
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'navigation'   => [
        'main_nav' => [
            'samples' => [
                'label' => 'Samples',
                'id'    => 'samples_dropdown',
                'uri'   => '#',
                'order' => 15,
                'pages' => [
                    'flash'    => [
                        'label'  => 'FlashMessenger',
                        'route'  => 'sample-flash',
                        'target' => '_self',
                    ],
                    'redirect' => [
                        'label'  => 'Umleitung',
                        'route'  => 'sample-redirect',
                        'target' => '_self',
                    ]
                ],
            ],
        ],
    ],
    // This lines opens the configuration for the ServiceManager
    'service_manager' => [
        'factories' => [
            Form\FlashTestForm::class => InvokableFactory::class,
            Form\TestForm::class      => InvokableFactory::class,
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [
            __DIR__ . '/../view',
        ],
    ],
];
