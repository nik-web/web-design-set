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

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\Authentication\AuthenticationServiceInterface;
use User\Repository\SecuritytokenInterface as Repository;
use User\Command\SecuritytokenInterface as Command;
use User\Service\AuthManager;

/**
 * AuthManagerFactory class
 *
 * @package User\Service\Factory
 */
class AuthManagerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return AuthAdapter
     */
    public function __invoke(ContainerInterface $container, 
                    $requestedName, array $options = null)
    {
        $authService = $container->get(AuthenticationServiceInterface::class);
        $repository = $container->get(Repository::class);
        $command = $container->get(Command::class);
        
        return new AuthManager($authService, $repository, $command);
    }
}
