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
use User\Form\UserAddForm;
use User\Command\UserInterface;
use User\Controller\AddUserController;

/**
 * ListAllUsersControllerFactory class
 *
 * @package User\Controller\Factory
 */
class AddUserControllerFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     *
     * @return LaminasDbSqlUser
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        $form = $container->get(UserAddForm::class);
        $command = $container->get(UserInterface::class);
        
        return new AddUserController($form, $command);
    }
}
