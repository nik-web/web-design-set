<?php
/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    Rbac\Service\Factory
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace Rbac\Service\Factory;

use Laminas\ServiceManager\Factory\FactoryInterface;
use Interop\Container\ContainerInterface;
use Laminas\Permissions\Rbac\Rbac;
use User\Repository\UserInterface;
use Rbac\Repository\RoleInterface;
use Rbac\Service\RbacManager;

/**
 * RbacManagerFactory class
 *
 * @package Rbac\Service\Factory
 */
class RbacManagerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     * @return RbacManager
     */
    public function __invoke(
        ContainerInterface $container, 
        $requestedName,
        array $options = null
    ) {
        $rbac = new Rbac();
        $userRepository = $container->get(UserInterface::class);
        $roleRepository = $container->get(RoleInterface::class);
        
        return new RbacManager($rbac, $userRepository, $roleRepository);
    }
}