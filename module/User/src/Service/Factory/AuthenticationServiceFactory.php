<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User\Service\Factory
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */

declare(strict_types=1);

namespace User\Service\Factory;

use Interop\Container\ContainerInterface;
use User\Service\AuthAdapterInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;
use Laminas\Session\SessionManager;
use Laminas\Authentication\Storage\Session;
use Laminas\Authentication\AuthenticationService;

/**
 * AuthenticationServiceFactory
 *
 * @package User\Service\Factory
 */
class AuthenticationServiceFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return AuthenticationService
     */
    public function __invoke(ContainerInterface $container, 
                    $requestedName, array $options = null)
    {
        $sessionManager = $container->get(SessionManager::class);
        $authStorage = new Session('Laminas_Auth', 'session', $sessionManager);
        $authAdapter = $container->get(AuthAdapterInterface::class);

        // Create the service and inject dependencies into its constructor.
        return new AuthenticationService($authStorage, $authAdapter);
    }
}
