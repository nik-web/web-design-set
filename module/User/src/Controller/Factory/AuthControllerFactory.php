<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\Controller\Factory  
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User\Controller\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use User\Form\LoginForm;
use User\Service\AuthManagerInterface;
use User\Controller\AuthController;

/**
 * AuthControllerFactory class
 *
 * @package User\Controller\Factory
 */
class AuthControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return 
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $form = $container->get(LoginForm::class);
        $service = $container->get(AuthManagerInterface::class);
        $sessionContainer = $container->get('lastURLSessionContainer');
        
        return new AuthController($form, $service, $sessionContainer);
    }
}
