<?php

/**
 * This file is part of web-design-set with Laminas MVC framework
 *  
 * @see        https://docs.laminas.dev/laminas-session/manager/
 *
 * @package    Application
 * @author     Niklaus Höpfner <editor@nik-web.net>
 * @link       https://github.com/nik-web/web-design-set
 * @license    https://opensource.org/licenses/BSD-3-Clause The BSD-3-Clause License
 * @version    1.0.0
 * @since      1.0.0
 */
declare(strict_types=1);

namespace Application;

use Laminas\ModuleManager\Feature\ConfigProviderInterface;
use Laminas\ModuleManager\Feature\BootstrapListenerInterface;
use Laminas\EventManager\EventInterface; // Laminas\Mvc\MvcEvent
use Laminas\Mvc\ModuleRouteListener;
use Laminas\Session\SessionManager;
use Laminas\Session\Container;
use Laminas\Session\Exception\RuntimeException;
use Application\Listener\NewSessionListener;

use function session_reset;

/**
 * Moodule class
 * 
 * @package Application
 * @author  Niklaus Höpfner <editor@nik-web.net>
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
    public function onBootstrap(EventInterface $e): void
    {
        $eventManager = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);        
        try {
            $this->bootstrapSession($e);
        } catch (RuntimeException $exception) {
            if (strpos($exception->getMessage(), 'Session validation failed') === false) {
                throw $exception;
            }
            $this->resetSession($e);
            // attach module listener
            $newSessionListener = new NewSessionListener();
            $newSessionListener->attach($eventManager);
        }                                        
    }
    
    /**
     * Reset session
     * 
     * @link https://www.php.net/manual/de/function.session-reset.php
     * @param EventInterface $e
     * @return void
     */
    private function resetSession(EventInterface $e): void
    {
        $session = $e->getApplication()->getServiceManager()->get(SessionManager::class);
        $session->regenerateId(true);
        session_reset();
    }

    /**
     * Bootstrap the session
     * 
     * @param EventInterface $e
     * @return void
     */
    public function bootstrapSession(EventInterface $e): void
    {
        $session = $e->getApplication()->getServiceManager()->get(SessionManager::class);
        $session->start();
        $container = new Container('initialized');
        if (isset($container->init)) {
            return;
        }
        $serviceManager = $e->getApplication()->getServiceManager();
        $request = $serviceManager->get('Request');
        $session->regenerateId(true);
        $container->init = 1;
        $container->remoteAddr = $request->getServer()->get('REMOTE_ADDR');
        $container->httpUserAgent = $request->getServer()->get('HTTP_USER_AGENT');
        $config = $serviceManager->get('Config');
        if (! isset($config['session'])) {
            return;
        }
        $sessionConfig = $config['session'];
        if (! isset($sessionConfig['validators'])) {
            return;
        }
        $chain = $session->getValidatorChain();
        foreach ($sessionConfig['validators'] as $validator) {
            switch ($validator) {
                case Validator\HttpUserAgent::class:
                    $validator = new $validator($container->httpUserAgent);
                    break;
                case Validator\RemoteAddr::class:
                    $validator = new $validator($container->remoteAddr);
                    break;
                default:
                    $validator = new $validator();
                    break;
            }

            $chain->attach('session.validate', array($validator, 'isValid'));
        }
    }
}
