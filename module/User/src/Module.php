<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *
 * @package    User
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace User;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\BootstrapListenerInterface;
use Laminas\EventManager\EventInterface;
use User\Listener\UserListener;

/**
 * Module class
 *
 * @package User;
 */
class Module implements ConfigProviderInterface, BootstrapListenerInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfig(): array
    {
        return include __DIR__ . '/../config/module.config.php';
    }
    
    /**
     * {@inheritDoc}
     */
    public function onBootstrap(EventInterface $e)
    {
        $application = $e->getApplication();
        $eventManager = $application->getEventManager();
        // attach module listener
        $userListener = new UserListener();
        $userListener->attach($eventManager); 
    }
}
